<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Hostelreview;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use App\Models\Maintenance;
use App\Models\Dormitorypayment;
use App\Models\Hostelpayment;
use App\Models\Laundryschedule;
use App\Models\Complaint;
use App\Models\Residentlog;
use App\Models\User;
use App\Models\Approvemaintenance;
use App\Models\Reservation;
use App\Models\Comment;

use Illuminate\Support\Facades\Storage;
//reports
use App\Models\BillingReport;
use App\Models\AnnouncementReport;
use App\Models\MaintenanceReport;

use Log;
class ResidentController extends Controller
{
    public function getMaintenances()
    {
        $user = Auth::user();
        if($user->role === "Resident"){
            $maintenances = Maintenance::where('user_id', $user->id)->get();
        }elseif($user->role === "Technician"){
            $maintenances = Maintenance::where('itemName', $user->specialization)->get();
        }else{
            $maintenances = Maintenance::all();
        }
        Log::info($maintenances);
        return response()->json($maintenances, 200);
    }

    public function createMaintenance(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            Log::info($request);
            $user = Auth::user(); 
            $type = $request->input('type');
            $description = $request->input('description');
            $maintenance = Maintenance::create([
                'type' => $type,
                'description' => $description,
                'room_number' => $user->room,
                'request_date' => $ldate,
                'branch' => $user->branch,
                'residentName' => $user->name,
                'user_id' =>$user->id,
            ]);

            $imgpath = $request->file('img_path');
            if ($imgpath && $imgpath !== '') {
                $fileName = time() . $request->file('img_path')->getClientOriginalName();
                $path = $request->file('img_path')->storeAs('maintenance', $fileName, 'public');
                $img_path = '/storage/' . $path;

                $maintenance->update([
                    'img_path' => $img_path,
                ]);
            }

            $maintenancereport = MaintenanceReport::create([
                'maintenanceId' => $maintenance->id,
                'residentName' => $user->name,
                'type' => $type,
                'room_number' => "Room ".$user->room,
                'branch' => $user->branch,
                'status' => "Pending",

            ]);

            $notification = Notification::create([
                'sender_id' => Auth::user()->id,
                'senderName' => Auth::user()->name,
                'receiver_id' => 1,
                'notification_type' => "Maintenance Request",
                'message' => Auth::user()->name." requested a Maintenance"
            ]);

            return response()->json(['maintenance' => $maintenance], 201);
        } catch (\Exception $e) {
            Log::error('Error creating maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function addComment(Request $request)
    {
        try {
            $comment = Comment::create([
                'content' =>  $request->input('content'),
                'announcement_id' =>  $request->input('announcement_id'),
                'user_id' =>  Auth::user()->id,
                'username' =>  Auth::user()->name,
                'userImage' =>  Auth::user()->img_path,
            ]);
            $notification = Notification::create([
                'sender_id' => Auth::user()->id,
                'senderName' => Auth::user()->name,
                'receiver_id' => 1,
                'notification_type' => "Announcement Comment",
                'message' => Auth::user()->name." add a comment"
            ]);
            return response()->json(['comment' => $comment], 201);
        } catch (\Exception $e) {
            Log::error('Error creating comment: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function myPaymentHistory()
    {
        try {
            if (Auth::user()->branch === "Dormitory"){
                $paymentHistory = Dormitorypayment::where('user_id',Auth::user()->id)->get(); 
            }else{
                $paymentHistory = Hostelpayment::where('user_id',Auth::user()->id)->get(); 
            }
            
            return response()->json($paymentHistory, 200);
        } catch (\Exception $e) {
       
            return response()->json(['message' => 'Failed to fetch payment history', 'error' => $e->getMessage()], 500);
        }
    }

    public function readAnnouncement(Request $request)
    {
        try {
            $announcement = AnnouncementReport::where('announcementId',$request->input('announcementId'))->get();

            $announcementreport = AnnouncementReport::where('announcementId',$request->input('announcementId'))->get();
            
            return response()->json($announcementreport, 200);
        } catch (\Exception $e) {
       
            return response()->json(['message' => 'Failed', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function uploadReceipt(Request $request)
    {

    
        try {
            // Get the payment ID and file from the request
            $paymentId = $request->payment_id;
            $file = $request->file('receiptFile');
    
            // Generate a unique file name
            $fileName = time() . '_' . $file->getClientOriginalName();
    
            // Store the file in the storage/app/public/receipts directory
            $path = $file->storeAs('public/receipts', $fileName);
    
            // Construct the img_path for storing in the database
            $img_path = '/storage/receipts/' . $fileName;
    
            // Update the img_path column in the dormitorypayments table
            $payment = Dormitorypayment::findOrFail($paymentId);
            $payment->img_path = $img_path;
            $payment->save();
    
            // Check if img_path is not NULL and update status to "PAID" if so
            if ($payment->img_path !== null) {
                $payment->update(['status' => 'PAID']);
            }

            $notification = Notification::create([
                'sender_id' => Auth::user()->id,
                'senderName' => Auth::user()->name,
                'receiver_id' => 1,
                'notification_type' => "Monthly Payment",
                'message' => Auth::user()->name." sends a receipt of payment"
            ]);
    
            return response()->json(['message' => 'Receipt uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to upload receipt', 'error' => $e->getMessage()], 500);
        }
    }
    
    
    

    

    public function createPayment(Request $request){
        try {
            if (Auth::user()->branch === "Dormitory"){
                $ldate = date('Y-m-d H:i:s');
               
                $fileName = time() . $request->file('img_path')->getClientOriginalName();
                $path = $request->file('img_path')->storeAs('payments', $fileName, 'public');
                $img_path = '/storage/' . $path;
                Log::info($request);
                $payment = Dormitorypayment::find($request->input('payment_id'));
                $payment->update([
                    'receipt' => $request->input('receipt'),
                    'img_path' => $img_path,
                    'paidDate' => $ldate,
                    'status' => "PAID",
                ]);
                $datenow = date('Y-m-d');
                $billReport = BillingReport::where('billingId',$payment->id)->first();
                $billReport->update([
                    'update_at' => $datenow,
                    'status' => "PAID",
                ]);

                $notification = Notification::create([
                    'sender_id' => Auth::user()->id,
                    'senderName' => Auth::user()->name,
                    'receiver_id' => 1,
                    'notification_type' => "Monthly Payment",
                    'message' => Auth::user()->name." sends a receipt of payment"
                ]);
            }else{
                $payment = Hostelpayment::where('user_id',Auth::user()->id)->get(); 
            }
            
            return response()->json($payment, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create payment ', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function createLaundrySchedule(Request $request)
{
    try {
        $user = Auth::user();

        if ($user->is_scheduled === 0) {
            $input = $request->all();
            Log::info($input);
            $dateSched = Laundryschedule::where('laundrydate', $input['laundrydate'])->count();
            if ($dateSched <= 8) {
                // Check if the requested time slot is available
                $timeSched = Laundryschedule::where('laundrydate', $input['laundrydate'])
                    ->where('laundrytime', $input['laundrytime'])->count();

                // Adjust the maximum allowed bookings per time slot
                $maxBookingsPerSlot = 2;

                if ($timeSched < $maxBookingsPerSlot) {
                    $Laundryschedule = new Laundryschedule();
                    $Laundryschedule->user_id = Auth::id();
                    $Laundryschedule->laundrydate = $input['laundrydate'];
                    $Laundryschedule->laundrytime = $input['laundrytime'];
                    $Laundryschedule->branch = $user->branch;
                    $Laundryschedule->status = "Scheduled";
                    $Laundryschedule->save();

                    $user->update([
                        'is_scheduled' => 1,
                    ]);

                    return response()->json([
                        'message' => 'Laundry schedule created successfully.',
                        'Laundryschedule' => $Laundryschedule,
                        'status' => 200,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'This time slot is fully booked.',
                        'status' => 200,
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'This date is fully booked.',
                    'status' => 200,
                ]);
            }
        } else {
            return response()->json([
                'message' => 'User is already scheduled for laundry.',
                'status' => 201,
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to create schedule.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function createComplaint(Request $request)
    {
        try {
            $complaint = Complaint::create([
                'name' =>  $request->input('name'),

                'complaint' =>  $request->input('complaint'),
                'branch' =>  Auth::user()->branch

            ]);

            $notification = Notification::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => 1,
                'notification_type' => "Complaint",
                'message' => $request->input('name')." makes a complaint"
            ]);
            return response()->json(['complaint' => $complaint], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating complaint: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function sendLogs(Request $request)
    {
        $ldate = date('Y-m-d H:i:s');
        try {
           
            

            $purpose = $request->input('purpose');
            $return = $request->input('expectedReturn');
            $id = $request->input('id');
            if($purpose){
                $fileName = time() . $request->file('gatePass')->getClientOriginalName();
            $path = $request->file('gatePass')->storeAs('gatePass', $fileName, 'public');
            $img_path = '/storage/' . $path;
                $residentlog = Residentlog::create([
                    'user_id' =>  Auth::user()->id,
                    'name' =>  'Leave',
                    'gatepass' =>  $img_path,
                    'purpose' =>  $purpose,
                    'leave_date' => $ldate,
                    'expectedReturn' => $return,
                    'dateLog' => $ldate,
                ]);
                $notification = Notification::create([
                    'sender_id' => Auth::user()->id,
                    'senderName' => Auth::user()->name,
                    'receiver_id' => 1,
                    'notification_type' => "Resident Logs",
                    'message' => Auth::user()->name." make a Leave"
                ]);

            }else{
                $residentlog = Residentlog::find($id);
                $residentlog->update([
                    'return_date' => $ldate,
                ]);
            }
            return response()->json(['residentlog' => $residentlog], 200);
            
        } catch (\Exception $e) {
            \Log::error('Error creating Logs: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateLogs(Request $request, $id)
    {
        try {
            
            $ldate = date('Y-m-d H:i:s');

            $residentlog = Residentlog::find($id);
            $residentlog->update([
                'return_date' => $ldate,
            ]);
            return response()->json(['residentlog' => $residentlog], 201);
        } catch (\Exception $e) {
            Log::error('Error creating purpose: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function myLogs()
    {
        try {
            $myLogs = Residentlog::where('user_id', Auth::user()->id)->get();
            Log::info($myLogs);
            return response()->json($myLogs, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch logs', 'error' => $e->getMessage()], 500);
        }
    }


    public function acceptMaintenance(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            $user = Auth::user(); 
            $id = $request->input('maintenance_id');
            $maintenance = Maintenance::find($id);
            
            $maintenance->update([
                'status' => "IN PROGRESS",
            ]);

            return response()->json(['maintenance' => $maintenance], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateEquipment(Request $request)
    {
        try {
            $user = User::find($request->input('user_id'));
            Log::info($user);
            $equipment = $request->input('checkedEquipmentNames');
            
            // Construct the property name dynamically
            $propertyName = strtolower($equipment); // Ensure consistency in property names

            // Toggle the value of the property
            $user->$propertyName = $user->$propertyName === 0 ? 1 : 0;
            
            // Save the updated user instance
            $user->save();

            return response()->json($user, 200);
        } catch (\Exception $e) {
            \Log::error('Error updating equipment: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function passContract(Request $request){
        $contract = $request->input('contract');
        $residentId = $request->input('residentId');

        $user = User::find($residentId);
        $user->update([
            'contract'  => $contract
        ]);
        return response()->json(['user' => $user],200);         
    }

    public function approveMaintenance($id) {
        $user = Auth::user();

        $approve = Approvemaintenance::create([
            'maintenance_id' => $id,
            'user_id' => $user->id,
        ]);

        return response()->json($approve,200);         

    }

    // public function myReservations()
    // {
    //     try {
    //         $myReservations = Reservation::with('room')->where('user_id', Auth::user()->id)->get();
    //         return response()->json($myReservations);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Failed to fetch logs', 'error' => $e->getMessage()], 500);
    //     }
    // }

    public function myReservations()
    {
        try {
            $myReservations = Reservation::with('room')->where('email', Auth::user()->email)->get();
            return response()->json($myReservations);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch logs', 'error' => $e->getMessage()], 500);
        }
    }

    public function cancelReservation($id)
    {
        try {
            $reservation = Reservation::find($id);
            $reservation->update([
                'status'  => 'Cancelled'
            ]);
            return response()->json($reservation);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to cancelled reservation', 'error' => $e->getMessage()], 500);
        }
    }


    public function sendSleep()
    {
        $ldate = date('Y-m-d H:i:s');
        try {
           
            $residentlog = Residentlog::create([
                'user_id' =>  Auth::user()->id,
                'name' =>  'Sleep',
                'dateLog' => $ldate,
            ]);

            return response()->json(['residentlog' => $residentlog], 200);
            
        } catch (\Exception $e) {
            \Log::error('Error creating Logs: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function sendRating(Request $request)
    {
        $ldate = date('Y-m-d H:i:s');
        try {
           $review = $request->input('reviewMessage');
           $rating = $request->input('rating');
           $resId = $request->input('reservationId');
           $reservation = Reservation::findOrFail($resId);
           $reservation->review = "Yes";
           $reservation->save();

           $revRate = Hostelreview::create([
                'room_id' => $reservation->room_ids,
                'name' => Auth::user()->name,
                'review' => $rating,
                'rating' => $review
           ]);
            

            return response()->json(['review' => $review], 200);
            
        } catch (\Exception $e) {
            \Log::error('Error creating Logs: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }



}
