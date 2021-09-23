<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Twilio\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function createRole(Request $request, $roleName){
        $role = Role::create([
            'roleName' =>$roleName
        ]);
        return $role;
    }
    public function getRoles()
    {
        return Role::orderBy('id')->get();
    }

    public function getUsers()
    {
        return User::orderBy('id', 'desc')->get();
    }

}
