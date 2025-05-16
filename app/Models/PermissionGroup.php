<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids; // Make sure this line is present

class PermissionGroup extends Model
{
    use HasFactory, SoftDeletes;
    use Uuids; // Use the trait

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'category'];

    // Relationship with Permissions (Many-to-Many)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_permission_groups', 'permission_group_id', 'permission_id')->withTimestamps();
    }
}
