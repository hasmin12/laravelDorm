<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\Models\LaundrySchedule;
use Auth;

class LaundryController extends Controller
{
    //
    public function laundry(Request $request)
    {

        $assets = ['calender'];
        $user = Auth::user();
        if($user->user_type=="user"){
            return view('residents.laundry',compact('assets'));
        }else{
            return view('admin.laundry.calendar',compact('assets'));
        }
    }

    public function getLaundrySchedules()
    {
        $schedules = LaundrySchedule::all();

        $events = $schedules->map(function ($schedule) {
            return [
                'title' =>$schedule->user->first_name." ".$schedule->user->last_name,
                'start' => $schedule->scheduled_at->format('Y-m-d H:i:s'),
                'end' => $schedule->scheduled_at->addHour()->format('Y-m-d H:i:s'),
                // 'description' => $schedule->notes,
            ];
        });

        return response()->json($events);
    }

    public function schedule(Request $request)
    {
        $userId = Auth::id();
        $myPendingSchedules = LaundrySchedule::where('user_id',$userId)->where('status',"scheduled")->first();
        if($myPendingSchedules){
            return redirect()->back()->with('error', 'User is already scheduled for laundry.');
        }
        $request->validate([
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required|date_format:H:i',
        ]);

        $scheduledAt = $request->scheduled_date . ' ' . $request->scheduled_time;
        $pendingCount = LaundrySchedule::where('scheduled_at', $scheduledAt)
            ->where('status', 'scheduled')
            ->count();

        if ($pendingCount >= 4) {
            return redirect()->back()->withErrors(['scheduled_at' => 'Cannot schedule more than 4 laundries at the same date and time.']);
        }


        LaundrySchedule::create([
            'user_id' => $userId,
            'scheduled_at' => $scheduledAt,
            'status' => 'scheduled',
        ]);

        return redirect()->back()->with('success', 'Laundry scheduled successfully!');
    }


}
