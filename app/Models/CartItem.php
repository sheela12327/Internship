<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // Relation to the Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relation to the Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
