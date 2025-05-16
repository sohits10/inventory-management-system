<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'datetime',
        'guest_count',
        'special_requests',
        'reservation_reference',
    ];

    // Relationship with User (A Reservation belongs to a User)
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function scopeForAdmin($query)
    {
        return $query;
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

}
