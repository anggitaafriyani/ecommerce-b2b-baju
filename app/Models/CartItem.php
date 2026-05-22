<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'unit',
        'price'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}