<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeaveApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;
use App\Mail\ApplicationApproved;
use App\Mail\ApplicationRejected;
use App\Mail\ApplicationSubmitted;
use Illuminate\Support\Facades\Mail;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = LeaveApplication::where('user_id', Auth::id())->latest()->get();

        return view('employeepanel.application.index', compact('applications'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employeepanel.application.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required',
        ]);

        $application = new LeaveApplication();
        $application->user_id = Auth::id();
        $application->type = $request->type;
        $application->start_date = $request->start_date;
        $application->end_date = $request->end_date;
        $application->reason = $request->reason;
        $application->save();

        if($application)
        {
            $user = Auth::user();
            Mail::to($user->email)->send(new ApplicationSubmitted($application));
        }
        Toastr::success("Application submited Successfully");
        return back();       
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveApplication $leaveApplication)
    {
        return view('employeepanel.application.show', compact('leaveApplication'));

    }

    public function getApplicationList()
    {
        $applications = LeaveApplication::with('user')->latest()->get();
        return view('adminpanel.application.index', compact('applications'));
    }

    public function getApplicationEdit(LeaveApplication $leaveApplication)
    {
        return view('adminpanel.application.edit', compact('leaveApplication'));
    }

    public function applicationEditForm(Request $request, LeaveApplication $leaveApplication)
    {
        $request->validate([
            'comment' => 'required',
            'status' => 'required',
        ]);

        $leaveApplication->comment = $request->comment;
        $leaveApplication->status = $request->status;
        $leaveApplication->save();

        if ($leaveApplication->status == 1) {
            $user = $leaveApplication->user;
            Mail::to($user->email)->send(new ApplicationApproved($leaveApplication));
        }else if($leaveApplication->status == -1){
            $user = $leaveApplication->user;
            Mail::to($user->email)->send(new ApplicationRejected($leaveApplication));
        }

        Toastr::success("Application updated Successfully");
        return back();   

    }
}
