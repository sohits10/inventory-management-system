<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid; // Import the UUID class
use Illuminate\Support\Str;


class Special extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "specials";
    protected $guarded = [];

      
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['item_id_id', 'name', 'description', 'price', 'start_date', 'end_date', 'image', 'is_active'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }


    public function getRouteKeyName()
    {
        return 'uuid';  // Ensure this matches the column storing the UUID
    }

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID before creating a record
        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });


    }
}

