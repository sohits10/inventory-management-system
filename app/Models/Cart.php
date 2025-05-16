<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'session_id',
        'status',
    ];

    /**
     * A cart has many cart items.
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Belongs to a user (nullable).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get total cart value.
     */
    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->unit_price * $item->quantity;
        });
    }
}
