<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    public static function create(array $attributes = [])
    {
        $attributes['id'] = Str::uuid()->toString();
        return static::query()->create($attributes);
    }

    // Relationship with Roles (Many-to-Many)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id')->withTimestamps();
    }

    // Relationship with Users (Many-to-Many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions', 'permission_id', 'user_id')->withTimestamps();
    }

    // Relationship with Permission Groups (Many-to-Many)
    public function permissionGroups()
    {
        return $this->belongsToMany(PermissionGroup::class, 'permission_permission_groups', 'permission_id', 'permission_group_id')->withTimestamps();
    }
}
