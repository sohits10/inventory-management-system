<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_name',
        'description',
        'price',
        'image_path',
        'category_id',
        'is_available',
        'special_instruction',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->updated_at = null;
        });
    }
}
