<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cart_id',
        'item_id',
        'size',
        'crust',
        'quantity',
        'unit_price',
    ];

    /**
     * Each item belongs to a cart.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * The actual food/menu item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Subtotal per item.
     */
    public function getSubtotalAttribute()
    {
        return $this->unit_price * $this->quantity;
    }
}
