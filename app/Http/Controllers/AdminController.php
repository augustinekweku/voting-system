<?php

namespace App\Http\Controllers;

use App\Models\Aspiring_position;
use App\Models\Role;
use App\Models\User;
use Twilio\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function createRole(Request $request, $roleName)
    {
        $role = Role::create([
            'roleName' => $roleName
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

    public function getPositions()
    {
        return Aspiring_position::orderBy('id', 'desc')->get();
    }

    public function createPosition(Request $request)
    {
        $aspiring_position = Aspiring_position::create([
            'position_name' => $request->position_name
        ]);
        return $aspiring_position;
    }

    public function editPosition(Request $request)
    {
        //validate request
        $this->validate($request, [
            'position_name' => 'required'
        ]);
        return Aspiring_position::where('id', $request->id)->update([
            'position_name' => $request->position_name
        ]);
    }

    public function deletePosition(Request $request)
    {
        //validate request
        $this->validate($request, [
            'id' => 'required'
        ]);
        return Aspiring_position::where('id', $request->id)->delete();
    }
}
