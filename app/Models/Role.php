<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Role extends Model
{

    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $table="roles";


    protected $keyType = 'string';
    public $incrementing = false;

    public static function create(array $attributes = [])
    {
        $attributes['id'] = Str::uuid()->toString();
        return static::query()->create($attributes);
    }
    protected $fillable = ['name','slug', 'description'];

   
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    // Relationship with Users (Many-to-Many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id')->withTimestamps();
    }

    // Relationship with Permissions (Many-to-Many)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id')->withTimestamps();
    }
}
