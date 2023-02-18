<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends BaseController
{
    public function getAllOrders()
    {
        $user = Auth::user(); 

        $order = Order::with('details')->where([
            'user_id' => $user->id,
        ])->get();
        
        return $this->sendResponse($order, 'Order fetched successfully.');
    } 

    public function checkout(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'address' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $user = Auth::user(); 

        $cart = Cart::where([
            'user_id' => $user->id,
        ])->get();

        if (count((array)$cart) <= 0) {
            return $this->sendError('Cannot checkout because cart is empty');
        }

        date_default_timezone_set('Asia/Jakarta');
        $invoice_code = 'ORD-' . date('ymdhis');
        $total_price = 0;

        foreach($cart as $item) {
            $subtotal = intval($item->price) * intval($item->quantity);
            $total_price += $subtotal;

            OrderDetail::create([
                'user_id' => $user->id,
                'product_id' => $item->product_id,
                'invoice_code' => $invoice_code,
                'name' => $item->name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total_price' => $subtotal
            ]);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'invoice_code' => $invoice_code,
            'grand_total' => $total_price,
            'address' => $input['address'],
            'payment_status' => 'unpaid'
        ]);

        if ($order) {
            Cart::where([
                'user_id' => $user->id,
            ])->delete();
        } else {
            return $this->sendError('Failed to create order');
        }
   
        return $this->sendResponse($order, 'Order created successfully.', 201);
    } 
}
