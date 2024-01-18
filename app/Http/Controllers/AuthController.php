<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Log;
use App\Models\Laundryschedule;
use App\Models\Announcement;
class AuthController extends Controller
{
    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Retrieve the authenticated user
            // Add some logging here to confirm the user is successfully logged in.
            \Log::info('User successfully logged in:', ['user' => $user]);
            
            $token = $user->createToken('remember_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'token' => $token,
                'Type' => 'Bearer',
                'user' => $user,
            ]);
        }
    
        return response([
            'message' => 'Wrong credentials'
        ]);
    }

    public function signout()
    {
        // Invalidate the current user's token
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getAnnouncements()
    {
        $branch = Auth::user()->branch;

        $announcements = Announcement::with('user')->where('branch', $branch)->get();

        return response()->json(['announcements' => $announcements]);
    }

    public function getLaundry()
    {
       
        if (Auth::user()->branch === "Dormitory") {
            $schedules = Laundryschedule::where('branch', 'Dormitory')->get();
        } else {
            $schedules = Laundryschedule::where('branch', 'Hostel')->get();
        }
        $events = [];

        foreach ($schedules as $schedule) {
            // Customize the event data based on your Schedule model fields
            $user = $schedule->user;
            $events[] = [
                'title' => $user->Tuptnum,
                'start' => $schedule->laundrydate, // Assuming your Schedule model has a 'scheduled_date' field
                // Add other relevant fields as needed
            ];
        }

        return response()->json($events);
    }
    
}
