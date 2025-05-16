<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid; // Import the UUID class
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;


    protected $keyType = 'string'; // Indicates that the primary key is a string (UUID)
    public $incrementing = false; // Disable auto-incrementing

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'phone_number',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4(); // Generate UUID when creating a user
        });
    }



    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }



    // Relationship with Roles (Many-to-Many)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')->withTimestamps();
    }

    // Relationship with Permissions (Many-to-Many)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions', 'user_id', 'permission_id')->withTimestamps();
    }





    public function userPermissionsCheck($userid, $permissions = array(), $booleanResult = true)
    {
        $flag = true;
        $has_all = false;
        $intersected_permission = array();

        if (is_array($permissions)) {
            if (count($permissions)) {
                $user = auth()->user();

                $checkPermissionCount = $this->getUserPermission($user->id, $permissions);

                if (count($checkPermissionCount)) {

                    foreach ($checkPermissionCount as $uperm) {
                        array_push($intersected_permission, $uperm->name);
                    }
                    if (count($checkPermissionCount) == count($permissions)) {
                        $flag = true;
                        $has_all = true;
                    } else {
                        $flag = true;
                        $has_all = false;
                    }
                } else {
                    $flag = false;
                    $has_all = false;
                }
                // check if

            }
        }

        if ($booleanResult) {
            return $flag;
        }

        return [
            'flag' => $flag,
            'has_all' => $has_all,
            'permissions' => $intersected_permission
        ];
    }





    
}
