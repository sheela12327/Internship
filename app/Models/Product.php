<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','price','old_price','stock',
        'category_id','image','status',
        'is_featured','is_hot_deal','is_top_selling','is_active',
    ];

     protected $casts = [
        'price'          => 'float',
        'old_price'      => 'float',
        'stock'          => 'integer',
        'status'         => 'boolean',
        'is_featured'    => 'boolean',
        'is_hot_deal'    => 'boolean',
        'is_top_selling' => 'boolean',
        'is_active'      => 'boolean',
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
        return $query->where('is_active', 1);
    }

   public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeTopSelling($query)
    {
        return $query->where('is_top_selling', 1);
    }

    /* =========================
       HELPERS
    ==========================*/

    public function isInStock($qty = 1): bool
    {
        return $this->stock >= $qty;
    }

    /**
     * Final selling price (used everywhere)
     */
    public function getFinalPriceAttribute(): float
    {
        return $this->price;
    }
}
