<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'invoice_code', 'grand_total', 'address', 'payment_status'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'invoice_code', 'invoice_code');
    }
}
