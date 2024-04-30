<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Toastr;
class LoginController extends Controller
{
    function LOGIN(Request $req)
    {

        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $remember_me = $req->has('remember_me') ? true : false;
        if (Auth::attempt(array('email' => $req->email, 'password' => $req->password), $remember_me)) {

            if(Auth::user()->hasRole('admin')){
                Toastr::success('Login Successfully');
                return redirect()->route('admin_dashboard');
            }else if(Auth::user()->hasRole('employee')){

                $user = Auth::user();
                if($user->account_approval == false)
                {
                    Auth::logout();
                    return back()->with('error', "Your account is blocked or in approval status, please contact admin");
                }
                return redirect()->route('admin_dashboard');

            }


        } else {
            return back()->with('error', "These credentials doesn't match with our records");
        }
    }



    function LOGOUT()
    {
        Auth::logout();
        return redirect()->route('adminlogin');
    }

   
}
