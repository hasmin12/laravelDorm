<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Announcement;
use App\Models\MaintenanceRequest;
use App\Models\MaintenanceList;

use App\Models\LostAndFound;
use App\Models\LaundrySchedule;
use App\Models\Payment;
use App\Models\DormitoryBed;
use App\Models\SleepLog;

use App\Models\Log as LeaveLog;
use Illuminate\Support\Facades\Log;
class MobileController extends Controller
{
    //
    public function signin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user) {
            if (!password_verify($request->input('password'), $user->password)) {
                return response()->json(['message' => 'Invalid email or password'], 401);
            }

            // Check user status
            switch ($user->status) {
                case 'active':
                    return response()->json(['user' => $user]);
                case 'inactive':
                    return response()->json(['message' => 'Your account is not active. Please contact support.'], 403);
                case 'pending':
                    return response()->json(['message' => 'Your account is not active. Please contact support.'], 403);
                default:
                    return response()->json(['message' => 'Unknown account status'], 500);
            }
        } else {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
    }


    public function announcements(){
        $announcements = Announcement::where('status',"published")->get();
        return response()->json(['announcements' => $announcements]);
    }

    public function mymaintenance($id){
        $maintenance = MaintenanceRequest::with('maintenanceStatus')->where('user_id',$id)->get();
        $maintenancelist = MaintenanceList::all();

        return response()->json(['maintenance' => $maintenance, 'maintenancelist' => $maintenancelist]);
    }

    public function requestmaintenance(Request $request,$id){

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('maintenance_images', 'public');
        }
        $user = User::find($id);
        $bed = DormitoryBed::where('user_id',$user->id)->first();
        MaintenanceRequest::create([
            'type' => $request->type,
            'description' => $request->description,
            'room_details' => $bed->room->name,

            'image_path' => $imagePath,
            'user_id' => $user->id,
        ]);

        return response()->json(['success', 'Maintenance request submitted successfully!']);
    }

    public function lostandfound(){
        $lostandfound = LostAndFound::where('status',"lost")->get();
        return response()->json(['lostandfound' => $lostandfound]);
    }

    public function laundry(){
        $laundryschedule = LaundrySchedule::with('user')->get();
        return response()->json(['laundryschedule' => $laundryschedule]);
    }

    public function schedulelaundry(Request $request, $id)
    {

        $myPendingSchedules = LaundrySchedule::where('user_id', $id)->where('status', "scheduled")->first();

        if ($myPendingSchedules) {
            return response()->json(['success' => false, 'message' => 'User is already scheduled for laundry.']);
        }

        $scheduledAt = $request->date . ' ' . $request->time;

        $pendingCount = LaundrySchedule::where('scheduled_at', $scheduledAt)
            ->where('status', 'scheduled')
            ->count();

        if ($pendingCount >= 4) {
            return response()->json(['success' => false, 'message' => 'Cannot schedule more than 4 laundries at the same date and time.']);
        }

        LaundrySchedule::create([
            'user_id' => $id,
            'scheduled_at' => $scheduledAt,
            'status' => 'scheduled',
        ]);

        return response()->json(['success' => true, 'message' => 'Maintenance request submitted successfully!']);
    }


    public function mypayments($id){
        $payments = Payment::where('user_id',$id)->get();
        return response()->json(['payments' => $payments]);
    }

    public function sendpayment(Request $request, $id){
        $payment = Payment::findOrFail($request->payment_id);
        $imagePath = $request->file('or_image')->store('or_images', 'public');
        $payment->or_number = $request->or_number;
        $payment->or_image = $imagePath;
        $payment->payment_date = now();

        $payment->status = "paid";

        $payment->save();
        return response()->json(['success' => true, 'message' => 'Maintenance request submitted successfully!']);

    }

    public function leaveRequest($id){
        $leaveRequest = LeaveLog::where('user_id',$id)->get();

        return response()->json(['leaveRequest' => $leaveRequest]);
    }

    public function returned(Request $request, $id){

        $leaveRequest = LeaveLog::find($request->leave_id);
        $leaveRequest->status = "Returned";
        $leaveRequest->returned_date = now();
        $leaveRequest->save();
        return response()->json(['success' => true, 'message' => 'User Returned!', 'leaveRequest' => $leaveRequest]);

    }

    public function requestleave(Request $request, $id){
        Log::info($request);
        $imagePath = $request->file('gatepass')->store('gatepass', 'public');

        $newLog = LeaveLog::create([
            'user_id' => $id,
            'reason' => $request->reason,
            'gatepass' => $imagePath,
            'status' => "Leave",
            'log_date'=> now(),
            'date_of_leave' => now(),
            'expected_return' =>  $request->expectedReturn,
        ]);
        return response()->json(['success' => true, 'message' => 'Success!', 'leaveRequest' => $newLog]);

    }

    public function mySleep($id){
        $sleep = SleepLog::where('user_id',$id)->get();

        return response()->json(['sleep' => $sleep]);
    }

    public function sendSleep($id){

        $newLog = SleepLog::create([
            'user_id' => $id,
            'sleep_date'=> now(),
        ]);
        return response()->json(['success' => true, 'message' => 'Success!', 'sleep' => $newLog]);
    }



}
