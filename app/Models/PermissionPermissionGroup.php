<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionPermissionGroup extends Pivot
{
    protected $table = 'permission_permission_groups';

    // Enable SoftDeletes if needed for the pivot
    use SoftDeletes;
}
