<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid; // Import the UUID class
use Illuminate\Support\Str;



class AboutUs extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "about_us";
    protected $guarded = [];


    
    protected $keyType = 'string';
    public $incrementing = false;



    protected $fillable = ['title', 'content', 'image'];




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
