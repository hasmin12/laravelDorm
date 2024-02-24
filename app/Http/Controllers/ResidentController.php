<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Repair;
use App\Models\Dormitorypayment;
use App\Models\Hostelpayment;
use App\Models\Laundryschedule;
use App\Models\Complaint;
use App\Models\Residentlog;
use App\Models\User;

use Log;
class ResidentController extends Controller
{
    //
    public function getRepairs()
    {
        $user = Auth::user();
        if($user->role === "Resident"){
            $repairs = Repair::where('user_id', $user->id)->get();
        }elseif($user->role === "Technician"){
            $repairs = Repair::where('technician_id', $user->id)->orWhereNull('technician_id')->get();
        }else{
            $repairs = Repair::all();
        }
        return response()->json($repairs, 200);
    }

    public function createRepair(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');

            $user = Auth::user(); 
            $itemName = $request->input('itemName');
            $description = $request->input('description');

            $repair = Repair::create([
                'itemName' => $itemName,
                'description' => $description,
                'room_number' => $user->roomdetails,
                'request_date' => $ldate,
                'branch' => $user->branch,
                'residentName' => $user->name,
                'user_id' =>$user->id,
            ]);

            $imgpath = $request->file('img_path');
            if ($imgpath && $imgpath !== '') {
                $fileName = time() . $request->file('img_path')->getClientOriginalName();
                $path = $request->file('img_path')->storeAs('repair', $fileName, 'public');
                $img_path = '/storage/' . $path;

                $repair->update([
                    'img_path' => $img_path,
                ]);
            }

            return response()->json(['repair' => $repair], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating repair: ' . $e->getMessage());
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

    public function createPayment(Request $request){
        try {
            if (Auth::user()->branch === "Dormitory"){
                $ldate = date('Y-m-d H:i:s');
               
                $fileName = time() . $request->file('img_path')->getClientOriginalName();
                $path = $request->file('img_path')->storeAs('payments', $fileName, 'public');
                $img_path = '/storage/' . $path;
       
                $payment = Dormitorypayment::where('user_id',Auth::user()->id)->where('status',"Pending")->first(); 
                $payment->update([
                    'receipt' => $request->input('receipt'),
                    'img_path' => $img_path,
                    'paidDate' => $ldate,
                    'status' => "PAID",
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
                $maxBookingsPerSlot = 3;

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
            $id = $request->input('id');
            if($purpose){
                $fileName = time() . $request->file('gatePass')->getClientOriginalName();
            $path = $request->file('gatePass')->storeAs('gatePass', $fileName, 'public');
            $img_path = '/storage/' . $path;
                $residentlog = Residentlog::create([
                    'user_id' =>  Auth::user()->id,
                    'gatepass' =>  $img_path,
                    'purpose' =>  $request->input('purpose'),
                    'leave_date' => $ldate
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

    public function updateLogs(Request $request)
    {
        try {
            
            $ldate = date('Y-m-d H:i:s');

            $residentlog = Residentlog::find($id);
            $residentlog->update([
                'return_date' => $ldate,
            ]);
            return response()->json(['residentlog' => $residentlog], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating purpose: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function myLogs()
    {
        try {
            $myLogs = Residentlog::where('user_id', Auth::user()->id)->whereNull('return_date')->get();
            Log::info($myLogs);
            return response()->json($myLogs, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch logs', 'error' => $e->getMessage()], 500);
        }
    }


    public function acceptRepair(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            $user = Auth::user(); 
            $id = $request->input('repair_id');
            $repair = Repair::find($id);
            
            $repair->update([
                'status' => "IN PROGRESS",
            ]);

            return response()->json(['repair' => $repair], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating repair: ' . $e->getMessage());
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





}
