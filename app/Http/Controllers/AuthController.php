<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Laundryschedule;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Maintenancelist;
use App\Models\User;
use App\Models\Comment;


class AuthController extends Controller
{
    public function signin(Request $request)
{
    try {
        // Validate request input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve the user by email
        $user = User::where('email', $credentials['email'])->first();

        // Check if the user exists
        if ($user) {
            // Check if the user is active
            if ($user->status === "Applicant") {
                return response()->json([
                    'success' => false,
                    'message' => 'Please wait for confirmation of your Application'
                ], 401);
            }

            // Attempt authentication
            if (Auth::attempt($credentials)) {
                $user = Auth::user(); 

                // Create a Personal Access Token
                $token = $user->createToken('Personal Access Token')->plainTextToken;

                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'Type' => 'Bearer',
                    'user' => $user,
                    'email' => $user->email,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong credentials'
                ], 401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

    } catch (\Exception $e) {
        // Log any other exceptions that may occur
        return response()->json([
            'success' => false,
            'message' => 'An error occurred during login.'
        ], 500);
    }
}

    public function getAuthUser()
    {
        $user = Auth::user();
        return response()->json($user);
    }




    public function signout(Request $request)
    {
        try {
            $user = $request->user(); // Get the currently authenticated user

            // Ensure the user has a current access token
            $currentToken = $user->currentAccessToken();
            
            if ($currentToken) {
                // Delete the current access token
                $currentToken->delete();
            }
            
            // Optionally, log out from the web guard and invalidate the session
            Auth::guard('web')->logout();
            $request->session()->invalidate();

            // Return a successful response
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out',
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during logout.',
            ], 500);
        }
    }



    public function getAnnouncements()
    {

        $announcements = Announcement::with('comments')->where('branch', 'Dormitory')->get();

        return response()->json(['announcements' => $announcements]);
    }

    public function getComments(Request $request)
    {

        $comments = Comment::where('announcement_id', $request->input('announcement_id'))->get();

        return response()->json(['comments' => $comments]);
    }

    public function notificationRead()
    {
        $user = Auth::user()->id;

        $notifications = Notification::where('receiver_id', $user)->get();
        foreach ($notifications as $notification) {
            $notification->status="Read";
            $notification->save();
        }
        return response()->json(['notifications' => $notifications]);
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