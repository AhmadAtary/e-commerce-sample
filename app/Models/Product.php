<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'is_active',
        'image_path',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get the cart items for this product.
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the order items for this product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        return asset($this->image_path);
    }
}


