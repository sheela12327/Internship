<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','price','old_price','stock', 'category_id','image','status', 'is_featured','is_hot_deal','is_top_selling'
    ];

     protected $casts = [
        'price'          => 'float',
        'old_price'      => 'float',
        'stock'          => 'integer',
        'status'         => 'boolean',
        'is_featured'    => 'boolean',
        'is_hot_deal'    => 'boolean',
        'is_top_selling' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Helper: Check stock availability
     * Used during cart & checkout
     */
    public function isInStock($qty = 1)
    {
        return $this->stock >= $qty;
    }

    /**
     * Helper: Final selling price
     * Used in cart & checkout
     */
    public function getFinalPriceAttribute()
    {
        return $this->old_price && $this->old_price > $this->price
            ? $this->price
            : $this->price;
    }
}
