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
use App\Models\Maintenance;
use App\Models\Registration;
use App\Models\Dormitorypayment;
use App\Models\Hostelpayment;
use App\Models\Notification;
use App\Models\Complaint;
use App\Models\Violation;
use App\Models\Residentlog;




use App\Mail\NotifyMail;
use App\Mail\Confirmationmail;
use App\Notifications\RealTimeNotification;
use Illuminate\Support\Facades\Mail;

use Auth;
use Carbon\Carbon;
use Log;

use App\Events\NotificationEvent;

class AdminController extends Controller
{

    //

    public function getDashboardData(Request $request)
    {
        try {
            $branch = $request->input('branch');

            // Initialize variables
            $totalResidents = 0;
            $totalRooms = 0;
            $totalBeds = 0;
            $lostItems = 0;
            $paidResidents = 0;
            $unpaidResidents = 0;
            $monthIncome = 0;
            $totalIncome = 0;

            if ($branch === "Dormitory") {
                $totalResidents = User::where('branch', $branch)->where('role', 'Resident')->count();
                $lostItems = Lostitem::where('branch', $branch)->count();
                $paidResidents = User::where('branch', $branch)->where('role', 'Resident')->where('is_paid', 1)->count();
                $unpaidResidents = User::where('branch', $branch)->where('role', 'Resident')->where('is_paid', 0)->count();
                $totalRooms = Dormitoryroom::count();
                $totalBeds = Dormitorybed::count();
                $monthIncome = Dormitorypayment::getThisMonthsIncome();
                $totalIncome = Dormitorypayment::getTotalIncome();
            } elseif ($branch === "Hostel") {
                $totalResidents = User::where('branch', $branch)->where('role', 'Resident')->count();
                $lostItems = Lostitem::where('branch', $branch)->count();
                $paidResidents = User::where('branch', $branch)->where('role', 'Resident')->where('is_paid', 1)->count();
                $unpaidResidents = User::where('branch', $branch)->where('role', 'Resident')->where('is_paid', 0)->count();
                $totalRooms = Hostelroom::count();
                $totalBeds = Hostelbed::count();
                $monthIncome = Hostelpayment::getThisMonthsIncome();
                $totalIncome = Hostelpayment::getTotalIncome();
            } else {
                // Counting for both Dormitory and Hostel
                $totalResidents = User::whereIn('branch', ['Dormitory', 'Hostel'])->where('role', 'Resident')->count();
                $lostItems = Lostitem::whereIn('branch', ['Dormitory', 'Hostel'])->count();
                $paidResidents = User::whereIn('branch', ['Dormitory', 'Hostel'])->where('role', 'Resident')->where('is_paid', 1)->count();
                $unpaidResidents = User::whereIn('branch', ['Dormitory', 'Hostel'])->where('role', 'Resident')->where('is_paid', 0)->count();
                $totalRooms = Dormitoryroom::count() + Hostelroom::count();
                $totalBeds = Dormitorybed::count() + Hostelbed::count();
                $monthIncome = Dormitorypayment::getThisMonthsIncome() + Hostelpayment::getThisMonthsIncome();
                $totalIncome = Dormitorypayment::getTotalIncome() + Hostelpayment::getTotalIncome();
            }

            // Return the dashboard data as a response
            return response()->json([
                'totalResidents' => $totalResidents,
                'totalRooms' => $totalRooms,
                'totalBeds' => $totalBeds,
                'lostItems' => $lostItems,
                'paidResidents' => $paidResidents,
                'unpaidResidents' => $unpaidResidents,
                'monthIncome' => $monthIncome,
                'totalIncome' => $totalIncome,
            ], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }


    public function getResidents(Request $request)
    {
        try {
            if (Auth::check()) {
                $branch = $request->input('branch');
                $searchQuery = $request->input('search_query');
                $residentType = $request->input('resident_type');
                if ($branch && $branch !== '') {
                    $query = User::where('branch', $branch)->where('role', "Resident")->where('status', "Active");
                } else {
                    $query = User::where('role', "Resident")->where('status', "Active");
                }

                if ($residentType && $residentType !== 'All') {
                    $query->where('type', $residentType);
                }
                if ($searchQuery) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%');
                }
                $residents = $query->get();
                Log::info($residents);
                return response()->json(['residents' => $residents]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            Log::error('Error in getResidents: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getApplicants(Request $request)
    {
        try {
            if (Auth::check()) {
                $applicants = User::where('branch', "Dormitory")->where('role', "Resident")->where('status', "Applicant")->get();
                return response()->json(['applicants' => $applicants]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            Log::error('Error in getApplicants: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getDormPayments(){
        try {
            if (Auth::check()) {
                $payments = Dormitorypayment::all();
                return response()->json(['payments' => $payments]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            Log::error('Error in getDormPayments: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


// Method to fetch resident details with payment history
public function getResident($id)
{
    try {
        // Find the resident by ID
        $resident = User::findOrFail($id);

        // Load payment history for the resident from the dormitorypayments table
        $payments = DormitoryPayment::where('user_id', $resident->id)->get();

        // Attach payment history to the resident
        $resident->payments = $payments;

        return response()->json(['resident' => $resident], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Resident not found'], 404);
    }
}


    public function createResident(Request $request)
    {
        Log::info($request);
        $fileName1 = time() . $request->file('img_path')->getClientOriginalName();
        $path1 = $request->file('img_path')->storeAs('residents', $fileName1, 'public');
        $img_path = '/storage/' . $path1;

        $fileName2 = time() . $request->file('cor')->getClientOriginalName();
        $path2 = $request->file('cor')->storeAs('cor', $fileName2, 'public');
        $corPath = '/storage/' . $path2;

        $fileName3 = time() . $request->file('validId')->getClientOriginalName();
        $path3 = $request->file('validId')->storeAs('validId', $fileName3, 'public');
        $validIdPath = '/storage/' . $path3;
        
        $fileName4 = time() . $request->file('vaccineCard')->getClientOriginalName();
        $path4 = $request->file('vaccineCard')->storeAs('vaccineCard', $fileName4, 'public');
        $vaccineCardPath = '/storage/' . $path4;
        
        $fileName5 = time() . $request->file('applicationForm')->getClientOriginalName();
        $path5 = $request->file('applicationForm')->storeAs('applicationForm', $fileName5, 'public');
        $applicationForm = '/storage/' . $path5;
        
        $fileName6 = time() . $request->file('contract')->getClientOriginalName();
        $path6 = $request->file('contract')->storeAs('contract', $fileName6, 'public');
        $contractPath = '/storage/' . $path6;


        $user = User::create([
           
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => $request->input('type'),
            'img_path' => $img_path,
            
            'name' => $request->input('name') ,
            'course' => $request->input('course'),
            'year' => $request->input('year'),
            'birthdate' => $request->input('birthdate'),
            'age' => $request->input('age'),
            'sex' => $request->input('sex'),
            'religion' => $request->input('religion'),
            'civil_status' => $request->input('civil_status'),
            'address' => $request->input('address'),
            'contactNumber' => $request->input('contactNumber'),
            'Tuptnum' => $request->input('Tuptnum'),
            'laptop' => $request->input('laptop'),
            'electricfan' => $request->input('electricfan'),
            'guardianName' => $request->input('guardianName'),
            'guardianContactNumber' => $request->input('guardianContactNumber'),
            'guardianRelationship' => $request->input('guardianRelationship'),
            'guardianAddress' => $request->input('guardianAddress'),
            'applicationForm' => $applicationForm,
            'cor' => $corPath,
            'validID' => $validIdPath,
            'vaccineCard' => $vaccineCardPath,
            'contract' => $contractPath,
            'status' => 'Applicant',
        ]);

        $laptopIncluded = $user->laptop == 1;
        $electricFanIncluded = $user->electricfan == 1;

        if ($laptopIncluded && $electricFanIncluded) {
            $totalAmount = 2600;
        }
        elseif ($electricFanIncluded && !$laptopIncluded) {
            $totalAmount = 2300;
        }
         elseif ($laptopIncluded && !$electricFanIncluded) {
            $totalAmount = 2300;
        }
        else {
            $totalAmount = 2000;
        }

        $ldate = date('Y-m-d H:i:s');
        $payment = Dormitorypayment::create([
            'receipt' => $request->input('receipt'),
            'paidDate' => $ldate,
            'payment_month' => now()->format('F Y'),
            'user_id' => $user->id,
            // 'roomdetails' => $resident->roomdetails,
            'laptop' => $user->laptop,
            'electricfan' => $user->electricfan,
            'totalAmount' => $totalAmount,
            'status' => "PAID",
        ]);

        


        return response()->json(['message' => 'Registration successful', 'user' => $user]);
    }

    public function updateResident(Request $request, $id)
    {
        try {
            // Check if the user is authenticated
            // if (Auth::check()) {
            //     // Check if the authenticated user's role is "Resident"
            //     if (Auth::user()->role === "Admin") {
            // Find the resident in the User table
            $resident = User::find($id);
            Log::info($resident);
            // Check if the resident exists
            if (!$resident) {
                return response()->json(['error' => 'Resident not found'], 404);
            }

            // Update the resident details
            $resident->update([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'sex' => $request->input('sex'),
                // Add more fields to update as needed
            ]);

            // Return success response
            return response()->json(['success' => true, 'message' => 'Resident updated successfully', 'resident' => $resident]);
            //     } else {
            // //         // Return unauthorized access response
            // //         return response()->json(['error' => 'Unauthorized'], 401);
            // //     }
            // // } else {
            // //     // Return unauthorized access response
            // //     return response()->json(['error' => 'Unauthorized'], 401);
            // // }
        } catch (\Exception $e) {
            // Log and return error response
            \Log::error('Error in update Resident: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function getRegisteredusers(Request $request)
    {
        try {
            if (Auth::check()) {
                $branch = $request->input('branch');
                $searchQuery = $request->input('search_query');
                $residentType = $request->input('resident_type');
                if ($branch && $branch !== '') {
                    $query = Registration::where('branch', $branch)->where('role', "Resident");
                } else {
                    $query = Registration::where('role', "Resident");
                }

                if ($residentType && $residentType !== 'All') {
                    $query->where('type', $residentType);
                }
                if ($searchQuery) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%');
                }
                $registeredusers = $query->get();
                Log::info($registeredusers);
                return response()->json(['registeredusers' => $registeredusers]);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (Exception $e) {
            Log::error('Error in getRegisteredusers: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    // public function addRegistereduser(Request $request){
    //     $registeredUser = Registration::find($request->input('registereduser_id'));
    //     $bed = Dormitorybed::find($request->input('bed_id'));
    //     $room = Dormitoryroom::find($request->input('room_id'));
    //     Log::info($registeredUser->address);
    //     $user = User::create([
    //         'name' => $registeredUser->name,
    //         'email' => $registeredUser->email,
    //         'password' => bcrypt($registeredUser->password),
    //         'branch' => $registeredUser->branch,
    //         'role' => $registeredUser->role,
    //         'Tuptnum' => $registeredUser->Tuptnum,
    //         'sex' => $registeredUser->sex,
    //         'address' => $registeredUser->address,
    //         'birthdate' => $registeredUser->birthdate,
    //         'contacts' => $registeredUser->contacts,
    //         'cor' => $registeredUser->cor,
    //         'validId' => $registeredUser->validId,
    //         'vaccineCard' => $registeredUser->vaccineCard,
    //         'contract' => $registeredUser->contract,
    //         'type' => $registeredUser->type,
    //         'roomdetails' =>$room->name.': '.$bed->name,
    //     ]);

    //     $bed->update([
    //         'user_id' => $user->id,
    //         'status' => "Occupied",
    //     ]);

    //     $room->update([
    //         'slot' => $room->slot - 1,
    //     ]);

    //     $registeredUser->delete();

    //     return response()->json($user);


    // }

    public function archiveResident($id)
    {
        try {
            if (Auth::check()) {
                $user = User::find($id);

                $user->delete();

                return response()->json(['success' => true, 'message' => 'User deleted successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in archiveResident: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getPaymentHistory(Request $request)
    {
        try {
            $residentId = $request->input('residentId');
            $paymentHistory = Dormitorypayment::where('user_id', $residentId)->get();

            return response()->json(['payment_history' => $paymentHistory], 200);
        } catch (\Exception $e) {
            // Handle errors, return error response
            return response()->json(['message' => 'Failed to fetch payment history', 'error' => $e->getMessage()], 500);
        }
    }

    public function getReservationHistory(Request $request)
    {
        try {
            $residentId = $request->input('residentId');
            $reservations = Reservation::where('user_id', $residentId)->get();

            return response()->json(['reservations' => $reservations], 200);
        } catch (\Exception $e) {
            // Handle errors, return error response
            return response()->json(['message' => 'Failed to fetch Reservation history', 'error' => $e->getMessage()], 500);
        }
    }





    public function getLaundry()
    {

        if (Auth::user()->branch === "Dormitory") {
            $schedules = Laundryschedule::where('branch', 'Dormitory')->get();

            $events = [];

            foreach ($schedules as $schedule) {
                // Customize the event data based on your Schedule model fields
                $user = $schedule->user;
                $events[] = [
                    'title' => $user->Tuptnum,
                    // 'start' => $schedule->laundrydate,
                    'laundrydate' => $schedule->laundrydate,
                    'laundrytime' => $schedule->laundrytime,
                ];
            }
        } else {
            $schedules = Laundryschedule::where('branch', 'Hostel')->get();

            $events = [];

            foreach ($schedules as $schedule) {
                // Customize the event data based on your Schedule model fields
                $user = $schedule->user;
                Log::info($user->roomdetails);
                $events[] = [
                    'title' => $user->roomdetails,
                    'start' => $schedule->laundrydate, // Assuming your Schedule model has a 'scheduled_date' field
                    // Add other relevant fields as needed
                ];
            }
        }


        return response()->json($events);
    }

    // Your existing method with the addition of eager loading beds relationship
    public function getRooms(Request $request)
    {
        try {
            if (Auth::check()) {
                // $roomType = $request->input('room_type');
                // $roomCategory = $request->input('sex');
                $roomType = "";
                $roomCategory = "";
                $query = Auth::user()->branch === "Dormitory" ? Dormitoryroom::with('beds.resident') : Hostelroom::query();

                if ($roomType) {
                    $query->where('type', $roomType);
                }

                if ($roomCategory) {
                    $query->where('category', $roomCategory);
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


    public function getRoom($id)
    {
        try {
            if (Auth::user()->branch === "Dormitory") {
                $room = Dormitoryroom::findOrFail($id);
            } else {
                $room = Hostelroom::findOrFail($id);
            }
            return response()->json(['room' => $room]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }
    }

    public function createRoom(Request $request)
    {
        try {
            $name = $request->input('name');
            $category = $request->input('category');
            $type = $request->input('type');
            $numBeds = $request->input('numBed');
            $bedNames = ['A', 'B', 'C', 'D'];
            if (Auth::user()->branch === "Dormitory") {
                $room = Dormitoryroom::create([
                    'name' => $name,
                    'type' => $type,
                    'category' => $category,
                    // 'occupiedBeds' => $numBeds,
                    'totalBeds' => $numBeds,
                ]);

                for ($i = 0; $i < $numBeds; $i++) {
                    Dormitorybed::create([
                        'name' => $bedNames[$i],
                        'room_id' => $room->id,
                    ]);
                }
            } else {
                $room = Hostelroom::create([
                    'name' => $name,
                    'type' => $type,
                    'category' => $category,
                    // 'occupiedBeds' => $numBeds,
                    'totalBeds' => $numBeds,
                ]);

                for ($i = 0; $i < $numBeds; $i++) {
                    Hostelbed::create([
                        'name' => $bedNames[$i],
                        'room_id' => $room->id,
                    ]);
                }
            }
            return response()->json(['room' => $room], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating room: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateRoom(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                if (Auth::user()->branch === "Dormitory") {
                    $room = Dormitoryroom::find($id);
                } else {
                    $room = Hostelroom::find($id);
                }

                if (!$room) {
                    return response()->json(['error' => 'Room not found'], 404);
                }

                $room->update([
                    'name' => $request->input('name'),
                    'type' => $request->input('type'),
                    'category' => $request->input('category'),
                ]);

                return response()->json(['success' => true, 'message' => 'Room updated successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in update Room: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function deleteRoom($id)
    {
        try {
            if (Auth::check()) {
                // Find the room by ID
                if (Auth::user()->branch === "Dormitory") {
                    $room = Dormitoryroom::find($id);
                } else {
                    $room = Hostelroom::find($id);
                }

                if (!$room) {
                    return response()->json(['error' => 'Room not found'], 404);
                }

                $room->delete();

                return response()->json(['success' => true, 'message' => 'Room deleted successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in deleteRoom: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function getBeds(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                // $roomId = $request->input('room_id');
                // Log::info($roomId);
                $query = Auth::user()->branch === "Dormitory" ? Dormitorybed::query() : Hostelbed::query();

                $query->where('room_id', $id);
                $beds = $query->with(['resident'])->get();

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


                // $query->where('room_id', $id);

                // $beds = $query->with(['resident'])->get();

                // Transform the results to include resident names

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
        // Log::info($announcements);
        return response()->json(['announcements' => $announcements]);
    }

    public function getAnnouncement($id)
    {
        try {
            $announcement = Announcement::findOrFail($id);
            return response()->json(['announcement' => $announcement]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }
    }

    public function createAnnouncement(Request $request)
    {
        try {
            $user = Auth::user();
            $title = $request->input('title');

            $content = $request->input('content');
            $receiver = $request->input('receiver');

            $fileName = time() . $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('announcement', $fileName, 'public');
            $img_path = '/storage/' . $path;

            $announcement = Announcement::create([
                'user_id' => $user->id,
                'receiver' => $receiver,
                'title' => $title,
                'content' => $content,
                'branch' => $user->branch,
                'postedBy' => $user->name,

            ]);

            $announcement->update([
                'img_path' => $img_path
            ]);

            return response()->json(['announcement' => $announcement], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating announcement: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateAnnouncement(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                $announcement = Announcement::find($id);
                if (!$announcement) {
                    return response()->json(['error' => 'Announcement not found'], 404);
                }

                $fileName = time() . $request->file('img_path')->getClientOriginalName();
                $path = $request->file('img_path')->storeAs('announcement', $fileName, 'public');
                $img_path = '/storage/' . $path;
                $announcement->update([
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'receiver' => $request->input('receiver'),
                    'img_path' => $img_path
                ]);

                return response()->json(['success' => true, 'message' => 'Announcement updated successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in updateAnnouncement: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function deleteAnnouncement($id)
    {
        try {
            if (Auth::check()) {
                // Find the announcement by ID
                $announcement = Announcement::find($id);

                if (!$announcement) {
                    return response()->json(['error' => 'Announcement not found'], 404);
                }

                $announcement->delete();

                return response()->json(['success' => true, 'message' => 'Announcement deleted successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in deleteAnnouncement: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getLostitems()
    {
        $branch = Auth::user()->branch;

        $lostitems = Lostitem::where('branch', $branch)->get();

        return response()->json(['lostitems' => $lostitems]);
    }

    public function getLostitem($id)
    {
        try {
            $lostitem = Lostitem::findOrFail($id);
            return response()->json(['lostitem' => $lostitem]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }
    }

    public function createLostitem(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');

            $itemName = $request->input('itemName');
            $locationLost = $request->input('locationLost');
            $dateLost = $ldate;
            $branch = Auth::user()->branch;
            Log::info($branch);
            $findersName = $request->input('findersName');

            $fileName = time() . $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('lostitem', $fileName, 'public');
            $img_path = '/storage/' . $path;

            $lostitem = Lostitem::create([
                'itemName' => $itemName,
                'dateLost' => $dateLost,
                'locationLost' => $locationLost,
                'branch' => $branch,
                'findersName' => $findersName,
                'img_path' => $img_path,
            ]);

            return response()->json(['lostitem' => $lostitem], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating lostitem: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateLostitem(Request $request, $id)
    {
        try {
            $ldate = date('Y-m-d H:i:s');

            if (Auth::check()) {
                $lostitem = Lostitem::find($id);

                $claimedBy = $request->input('claimedBy');
                if (!$lostitem) {
                    return response()->json(['error' => 'Lostitem not found'], 404);
                }
                $imgpath = $request->file('img_path');
                if ($imgpath && $imgpath !== '') {
                    $fileName = time() . $request->file('img_path')->getClientOriginalName();
                    $path = $request->file('img_path')->storeAs('lostitem', $fileName, 'public');
                    $img_path = '/storage/' . $path;

                    $lostitem->update([
                        'img_path' => $img_path,
                    ]);
                }

                $lostitem->update([
                    'itemName' => $request->input('itemName'),
                    'locationLost' => $request->input('locationLost'),
                    'findersName' => $request->input('findersName'),
                ]);

                if ($claimedBy && $claimedBy !== '') {
                    $lostitem->update([
                        'claimedBy' => $claimedBy,
                        'claimedDate' => $ldate,
                        'status' => "Claimed",
                    ]);
                }



                return response()->json(['success' => true, 'message' => 'Lostitem updated successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in updateLostitem: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function deleteLostitem($id)
    {
        try {
            if (Auth::check()) {
                // Find the announcement by ID
                $lostitem = Lostitem::find($id);

                if (!$lostitem) {
                    return response()->json(['error' => 'Lostitem not found'], 404);
                }

                $lostitem->delete();

                return response()->json(['success' => true, 'message' => 'Lostitem deleted successfully']);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (\Exception $e) {
            \Log::error('Error in deleteLostitem: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function createLaundryschedule(Request $request)
    {
        try {
            $user = Auth::user();

            if ($user->is_scheduled === 0) {
                $laundryDate = $request->input('laundryDate');
                $laundryTime = $request->input('laundryTime');

                $laundrySchedule = Laundryschedule::create([
                    'user_id' => $user->id,
                    'laundrydate' => $laundryDate,
                    'laundrytime' => $laundryTime,
                    'branch' => $user->branch,
                ]);

                $user->update([
                    'is_scheduled' => 1,
                ]);

                return response()->json(['laundrySchedule' => $laundrySchedule], 201);
            } else {
                // User is already scheduled, return a custom message
                return response()->json(['message' => 'User is already scheduled for laundry.'], 201);
            }
        } catch (\Exception $e) {
            \Log::error('Error creating laundrySchedule: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }



    public function getProfile($id)
    {
        $user = User::find(1);
        return response()->json(['user' => $user]);
    }

    public function notifyResidents()
    {
        try {
            $residents = User::where('is_paid', 0)->where('branch', "Dormitory")->where('role', "Resident")->get();
            $currentMonth = now()->format('F Y');


            foreach ($residents as $resident) {
                // Mail::to($resident->email)->send(new NotifyMail($currentMonth));
                $totalAmount = 1000;
                if ($resident->laptop === 1) {
                    $totalAmount = $totalAmount + 150;
                }

                if ($resident->electricfan === 1) {
                    $totalAmount = $totalAmount + 150;
                }

                $dormitoryPayment = Dormitorypayment::create([
                    'user_id' => $resident->id,
                    'roomdetails' => $resident->roomdetails,
                    'laptop' => $resident->laptop,
                    'electricfan' => $resident->electricfan,
                    'totalAmount' => $totalAmount,
                    'payment_month' => $currentMonth
                ]);

                $notifs = Notification::create([
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $resident->id,
                    'notification_type' => "Monthly Payment1",
                    'target_id' => $dormitoryPayment->id,
                    'message' => "Hello $resident->name,
                    This is a friendly reminder to pay your monthly fees for $currentMonth.Please ensure your payment is submitted by the end of the month.Thank you for your cooperation."
                ]);
                // Log::info('Emails sent successfully'); // Log informational message

                // event(new NotificationEvent($resident->name));
            }

            Log::info('Emails sent successfully'); // Log informational message

            return response()->json(['success' => 'Emails Sent Successful'], 200);
        } catch (\Exception $e) {
            Log::error('Error sending emails: ' . $e->getMessage()); // Log error message

            return response()->json(['error' => 'Error sending emails'], 500);
        }
    }

    public function getMaintenances()
    {
        try {
            if (Auth::user()->branch === "Dormitory") {
                $maintenances = Maintenance::where('branch', "Dormitory")->get();
            } else {
                $maintenances = Maintenance::where('branch', "Hostel")->get();
            }
            Log::info($maintenances);
            return response()->json(['maintenances' => $maintenances]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Maintenances not found'], 404);
        }
    }

    public function getComplaints()
    {
        try {
            if (Auth::user()->branch === "Dormitory") {
                $complaints = Complaint::where('branch', "Dormitory")->get();
            } else {
                $complaints = Complaint::where('branch', "Hostel")->get();
            }

            return response()->json(['complaints' => $complaints]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Complaints not found'], 404);
        }
    }

    public function getViolations()
    {
        // $branch = Auth::user()->branch;

        $violations = Violation::all();

        return response()->json(['violations' => $violations]);
    }

    public function createViolation(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            $user = User::find($request->input('user_id'));
            $violation = Violation::create([
                'user_id' => $user->id,
                'residentName' => $user->name,
                'violationName' => $request->input('violationName'),
                'violationDate' => $ldate,
                'violationType' => $request->input('violationType'),
                'penalty' => $request->input('penalty'),
                'status' => 'Active',

            ]);
            return response()->json(['violation' => $violation], 200);


        } catch (\Exception $e) {
            \Log::error('Error creating Violation: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function approveApplicant($id)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            $user = User::find($id);
            $currentMonth = now()->format('F Y');
            $totalAmount = 2000;
            $laptopIncluded = $user->laptop === 1;
            $electricFanIncluded = $user->electricfan === 1;

            if ($laptopIncluded) {
                $totalAmount += 300;
            }

            if ($electricFanIncluded) {
                $totalAmount += 300;
            }
            $user->update([
                'status' => 'Applicant',
            ]);

            Mail::to($user->email)->send(
                new ConfirmationMail(
                    $user->name,
                    $currentMonth,
                    $totalAmount,
                    $laptopIncluded,
                    $electricFanIncluded
                )
            );

            $dormitoryPayment = Dormitorypayment::create([
                'user_id' => $user->id,
                // 'roomdetails' => $user->roomdetails,
                'laptop' => $user->laptop,
                'electricfan' => $user->electricfan,
                'totalAmount' => $totalAmount,
                'payment_month' => $currentMonth
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending confirmation email: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function assignResident(Request $request)
    {
        $bedId = $request->input('bedId');
        $residentId = $request->input('residentId');

        $bed = Dormitorybed::find($bedId);
        $user = User::find($residentId);
        $bed->update([
            'user_id' => $residentId,
            'user_image' => $user->img_path,
            'status' => "Occupied"
        ]);

        $room = Dormitoryroom::find($bed->room_id);

        $room->update([
            'occupiedBeds' => $room->occupiedBeds + 1,
        ]);

        $user = User::find($residentId);
        $user->update([
            'room' => "Room " . $bed->room_id,
            'bed' => $bed->name,

            // 'roomdetails' => "Room ".$bed->room_id."-".$bed->name ,
            'status' => "Active"
        ]);

        $newUser = Notification::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $residentId,
            'notification_type' => "Registration Complete",
            // 'target_id' => $dormitoryPayment->id,
            'message' => "Hello $user->name, Your registration is now complete. You are assigned to $user->room - $user->bed "
        ]);

        return response()->json(['bed' => $bed], 200);
    }

    public function getLogs(Request $request)
    {
        $logs = Residentlog::where('user_id', $request->input('residentId'))->where('name', "Leave")->get();
        return response()->json($logs);
    }

    public function getSleepLogs(Request $request)
    {
        $sleeplogs = Residentlog::where('user_id', $request->input('residentId'))->where('name', "Sleep")->get();
        return response()->json($sleeplogs);
    }



}
