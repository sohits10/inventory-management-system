<?php

use App\Models\User;




function hasPermission($permission=array(),$booleanResult=true)
    {
        dd($permission);
        if(!is_array($permission))
        {
            $permission=[$permission];
        }
        $user=auth()->user();
        if($user)
        {
            return (new User())->userPermissionsCheck($user->id,$permission,$booleanResult);
        }
    }


    if (!function_exists('getReservationsForAdmin')) {
        function getReservationsForAdmin()
        {
            // Fetch reservations for users with the admin role and include the user who created each reservation.
            return Reservation::with('user') // Assuming there's a `user` relationship in Reservation model
                ->whereHas('user', function($query) {
                    $query->where('role', 'admin'); // Assuming 'role' column is available in users table
                })
                ->get();
        }
    }