<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Toastr;

class RegistrationController extends Controller
{
    public function REGISTER(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string', 
        ]);

        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->account_approval = false;
        $user->save();

        $role = 'employee';
        
        $user->assignRole($role);
        Toastr::success("User Created Successfully");
        return back();       
    }

   
}
