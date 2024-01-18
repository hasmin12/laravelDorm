<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laundryschedule;
use App\Models\Dormitoryroom;
use App\Models\Hostelroom;
use App\Models\Dormitorybed;
use App\Models\Hostelbed;
use App\Models\Announcement;
use App\Models\Lostitem;

use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

use Auth; 
use Carbon\Carbon;
use Log;


class AdminController extends Controller
{
    //
    public function getResidents(Request $request)
    {
        try {
            if (Auth::check()) {
                $searchQuery = $request->input('search_query');
                $residentType = $request->input('resident_type');

                $query = Auth::user()->branch === "Dormitory" ? Dormitorybed::with(['resident', 'room']) : Hostelbed::with(['resident', 'room']);

                if ($searchQuery) {
                    $query->whereHas('resident', function ($q) use ($searchQuery) {
                        $q->where('name', 'LIKE', '%' . $searchQuery . '%');
                    });
                }

                if ($residentType) {
                    $query->whereHas('resident', function ($q) use ($residentType) {
                        $q->where('type', $residentType);
                    });
                }

                $beds = $query->get();
                \Log::info($beds);
        
                return response()->json(['beds' => $beds]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in getResidents: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
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

    public function getRooms(Request $request)
    {
        try {
            if (Auth::check()) {
                $roomType = $request->input('room_type');
                $query = Auth::user()->branch === "Dormitory" ? Dormitoryroom::query() : Hostelroom::query();

                if ($roomType) {
                    $query->where('type', $roomType);
                }

               
                $rooms = $query->get();
             
                return response()->json(['rooms' => $rooms]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in getRooms: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getBeds(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                $query = Auth::user()->branch === "Dormitory" ? Dormitorybed::query() : Hostelbed::query();
                
                $query->where('room_id', $id);
                $beds = $query->with(['resident'])->get();

                // Transform the results to include resident names
                $beds = $beds->map(function ($bed) {
                    return [
                        'id' => $bed->id,
                        'name' => $bed->name,
                        'type' => $bed->type,
                        'status' => $bed->status,
                        'action' => $bed->action,
                        'resident_name' => $bed->resident ? $bed->resident->name : null,
                    ];
                });

                return response()->json(['beds' => $beds]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in getBeds: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function getAnnouncements()
    {
        $branch = Auth::user()->branch;

        $announcements = Announcement::with('user')->where('branch', $branch)->get();

        return response()->json(['announcements' => $announcements]);
    }

    public function getLostitems()
    {
        $branch = Auth::user()->branch;

        $lostitems = Lostitem::where('branch', $branch)->get();

        return response()->json(['lostitems' => $lostitems]);
    }

    public function getProfile($id){
        $user= User::find(1);
        return response()->json(['user' => $user]);
    }

    public function notifyResidents()
    {
        try {
            $is_paid = 0;
            // Get the list of residents (you need to replace this with your logic to fetch residents)
            $residents = Auth::user()->branch === "Dormitory" ? Dormitorybed::with(['resident', 'room']) : Hostelbed::with(['resident', 'room']);
            $residents->whereHas('resident', function ($q) use ($is_paid) {
                $q->where('is_paid', $is_paid);
            });
    
            // Define the month for the payment reminder
            $currentMonth = now()->format('F');
            $residents = $residents->get();
            // Send payment reminders to all residents
            foreach ($residents as $resident) {
                Mail::to($resident->resident->email)->send(new NotifyMail($currentMonth));
            }
    
            Log::info('Emails sent successfully'); // Log informational message
    
            return response()->json(['success' => 'Emails Sent Successful'], 200);
        } catch (\Exception $e) {
            Log::error('Error sending emails: ' . $e->getMessage()); // Log error message
    
            return response()->json(['error' => 'Error sending emails'], 500);
        }
    }

}
