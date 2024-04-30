<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LeaveApplication;

class AdminController extends Controller
{
    function dashboard()
    {
        if(Auth::user()->getRoleNames()[0] == 'admin')
        {
            $query = LeaveApplication::get();
            $dashboardData = [
                'pendingApplication' => $query->where('status', 0)->count(),
                'approvedApplication' => $query->where('status', 1)->count(),
                'rejectedApplication' => $query->where('status', -1)->count()
            ];

            return view('adminpanel.dashboard.index', compact('dashboardData'));
        }
        
        return view('adminpanel.dashboard.index');
    }

}
