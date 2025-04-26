<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\ReadRfidEvent;
use App\Models\Attendance;

class RfidController extends Controller
{
    public function read(Request $request)
    {
        if(User::where('uid', $request->uid)->exists()){
            event(new ReadRfidEvent($request->uid,'EXISTS','RFID data already exists'));
            return response()->json([
                'message' => 'RFID data already exists',
                'code' => 'EXISTS',
                'UID' => $request->uid,
            ]);
        }else{
            event(new ReadRfidEvent($request->uid,'SUCCESS','RFID read successfully'));
            return response()->json([
                'message' => 'RFID read successfully',
                'code' => 'SUCCESS',
                'UID' => $request->uid,
            ]);
        }
    }

    public function attend(Request $request)
    {
        // Logic to handle attendance submission
        $request->validate([
            'uid' => 'required',
        ]);
        $user = User::where('uid', $request->uid)->first();

        if(!$user){
            return response()->json([
                'message' => 'RFID not found',
                'code' => 'NOT_FOUND',
                'UID' => $request->uid,
            ],404);
        }else{
            Attendance::create([
                'user_id' => $user->id,
                'status' => "attend",
                'description' => "rfid",
                'latitude' => "",
                'longitude' => "",
            ]);
    
            return response()->json([
                'message' => 'RFID Attendance submitted successfully',
                'code' => 'SUCCESS',
                'UID' => $request->uid,
            ]);
        }

        

        // Logic to save attendance record

    }
}
