<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Validator;

class CartController extends BaseController
{
    public function getCart()
    {
        $user = Auth::user(); 

        $cart = Cart::where([
            'user_id' => $user->id,
        ])->get();
        
        return $this->sendResponse($cart, 'Cart fetched successfully.');
    } 

    public function addToCart(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'product_id' => 'required',
            'quantity' => 'required|integer'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product = Product::find($input['product_id']);
        $user = Auth::user(); 

        $cart = Cart::where([
            'user_id' => $user->id,
            'product_id' => $input['product_id'],
        ])->first();

        if ($cart) {
            $cart->quantity = $input['quantity'];
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $input['product_id'],
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $input['quantity'],
            ]);
        }

        $cart = Cart::where([
            'user_id' => $user->id,
        ])->get();
   
        return $this->sendResponse($cart, 'Product added to cart successfully.', 201);
    } 

    public function removeFromCart(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'product_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product = Product::find($input['product_id']);
        $user = Auth::user(); 

        $cart = Cart::where([
            'user_id' => $user->id,
            'product_id' => $input['product_id'],
        ])->first();

        if ($cart) {
            $cart->delete();
        } else {
            return $this->sendError('Product not found in cart.');
        }

        $cart = Cart::where([
            'user_id' => $user->id,
        ])->get();
   
        return $this->sendResponse($cart, 'Product removed from cart successfully.');
    } 

    public function clearCart()
    {
        $user = Auth::user(); 

        Cart::where([
            'user_id' => $user->id,
        ])->delete();

        $cart = Cart::where([
            'user_id' => $user->id,
        ])->get();
        
        return $this->sendResponse($cart, 'Cart cleared successfully.');
    }
}
