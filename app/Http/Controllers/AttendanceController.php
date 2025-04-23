<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AttendanceController extends Controller
{
    //
     static function isTodayAttendanceSubmitted(): bool
    {
        // Logic to fetch and display attendance records
        return Attendance::where('user_id',  Auth::user()->id)->whereDate('created_at', now()->toDateString())->exists();
    }


    public function index(): Response
    {
        $attendances = Attendance::with('user')->paginate(1);
        return Inertia::render('Attendance/Index', [
            'attendances' => $attendances,
        ]);
    }

    public function submit(Request $request)
    {
        // Logic to handle attendance submission
        $request->validate([
            'status' => 'required',
            'description' => 'required_if:status,sick,leave,permit,business_trip,remote|max:500',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        Attendance::create([
            'user_id' => auth()->id(),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // Logic to save attendance record

    }
    
}
