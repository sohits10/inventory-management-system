<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserRole extends Pivot
{
    protected $table = 'user_roles';

    // Enable SoftDeletes if needed for the pivot
    use SoftDeletes;
    use HasFactory,Uuids;


    protected $dates = ['deleted_at'];
    protected $fillable=['id','user_id','role_id'];
    protected $guarded = [];

}



