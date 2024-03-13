<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Log;
use App\Models\Laundryschedule;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Maintenancelist;


use Socialite;
class AuthController extends Controller
{
    public function signin(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user(); 
                \Log::info('User successfully logged in:', ['user' => $user]);

                $token = $user->createToken('remember_token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'Type' => 'Bearer',
                    'user' => $user,
                    'name' => $user->name,
                ]);
            }

            // Log an error if authentication fails
            \Log::error('Authentication failed: Wrong credentials');

            return response([
                'message' => 'Wrong credentials'
            ]);
        } catch (\Exception $e) {
            // Log any other exceptions that may occur
            \Log::error('Error during login: ' . $e->getMessage());

            return response([
                'message' => 'An error occurred during login.'
            ], 500);
        }
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

        $announcements = Announcement::with('comments')->where('branch', $branch)->get();

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
            $user = $schedule->user;
            $events[] = [
                'title' => $user->Tuptnum,
                'start' => $schedule->laundrydate, 
                'laundrydate' => $schedule->laundrydate, 
                'laundrytime' => $schedule->laundrytime, 
            ];
        }
        return response()->json($events);
    }

    public function getNotifications(){
        $notifications = Notification::where('receiver_id', Auth::user()->id)
                                      ->orderBy('created_at', 'desc')
                                      ->limit(5)
                                      ->get();
        return response()->json(['notifications' => $notifications]);
    }
    

    public function getMaintenanceList(){
        $maintenancelist = Maintenancelist::all();
        return response()->json($maintenancelist);
    }
    
}