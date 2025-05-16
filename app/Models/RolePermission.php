<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RolePermission extends Pivot
{

    use softDeletes;
    use HasFactory,Uuids;
    use SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $table = 'role_permissions';
    protected $guarded = [];

}
