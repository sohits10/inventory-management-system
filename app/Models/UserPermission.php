<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserPermission extends Pivot
{
    protected $table = 'user_permissions';

    // Enable SoftDeletes if needed for the pivot
    use SoftDeletes;
}
