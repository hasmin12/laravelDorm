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
use App\Models\Repair;
use App\Models\Registration;


use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;

use Auth; 
use Carbon\Carbon;
use Log;


class AdminController extends Controller
{
    
    //

    public function getDashboardData(Request $request)
    {
        try {
            $branch = $request->input('branch'); 
            if($branch === "Dormitory"){
                $totalResidents = User::where('branch', $branch)->where('role',"Resident")->count();
                $totalRooms = Dormitoryroom::count();
                $totalBeds = Dormitorybed::count();
                $lostItems = Lostitem::where('branch', $branch)->count();
                $paidResidents = User::where('branch', $branch)->where('role',"Resident")->where('is_paid',1)->count();
                $unpaidResidents = User::where('branch', $branch)->where('role',"Resident")->where('is_paid',0)->count();
                $monthIncome =  Dormitorypayment::getThisMonthsIncome(); 
                $totalIncome = Dormitorypayment::getTotalIncome();
            }else{
                $totalResidents = User::where('branch', $branch)->where('role',"Resident")->count();
                $totalRooms = Hostelroom::count();
                $totalBeds = Hostelbed::count();
                $lostItems = Lostitem::where('branch', $branch)->count();
                $paidResidents = User::where('branch', $branch)->where('role',"Resident")->where('is_paid',1)->count();
                $unpaidResidents = User::where('branch', $branch)->where('role',"Resident")->where('is_paid',0)->count();
                $monthIncome =  Hostelpayment::getThisMonthsIncome(); 
                $totalIncome = Hostelpayment::getTotalIncome();
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
                $searchQuery = $request->input('search_query');
                $residentType = $request->input('resident_type');
                
                if (Auth::user()->branch === "Dormitory") {
                    $query = User::where('branch', "Dormitory")->where('role',"Resident");

                    

                    if ($residentType && $residentType !== 'All') {
                        $query->where('type', $residentType);
                    }
   
                } else {
                    $query = User::where('branch', "Hostel")->where('role',"Resident"); 
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
            \Log::error('Error in getResidents: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function getResident($id)
    {
        try {
            $resident = User::findOrFail($id);           
            return response()->json(['room' => $room]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }
    }

    public function createResident(Request $request)
    {
        try {
            $bed_id = $request->input('name');

            $name = $request->input('name');
            $email = $request->input('email');
            $password = bcrypt($request->input('password'));
            $branch = Auth::user()->branch; 
            $role = "Resident";
            $Tuptnum = $request->input('Tuptnum');
            $address = $request->input('address');
            $sex = $request->input('sex');
            $birthdate = $request->input('birthdate');
            $contacts = $request->input('contacts');
            
            $fileName1 = time() . $request->file('cor')->getClientOriginalName();
            $path1 = $request->file('cor')->storeAs('cor', $fileName1, 'public');
            $cor = '/storage/' . $path1;
            
            $fileName2 = time() . $request->file('schoolID')->getClientOriginalName();
            $path2 = $request->file('schoolID')->storeAs('schoolID', $fileName2, 'public');
            $schoolID = '/storage/' . $path2;

            $fileName3 = time() . $request->file('vaccineCard')->getClientOriginalName();
            $path3 = $request->file('vaccineCard')->storeAs('vaccineCard', $fileName3, 'public');
            $vaccineCard = '/storage/' . $path3;

            $fileName4 = time() . $request->file('contract')->getClientOriginalName();
            $path4 = $request->file('contract')->storeAs('contract', $fileName4, 'public');
            $contract = '/storage/' . $path4;

            $type = $request->input('type');

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'branch' => $branch,
                'role' => $role,
                'Tuptnum' => $Tuptnum,
                'sex' => $sex,
                'address' => $address,
                'birthdate' => $birthdate,
                'contacts' => $contacts,
                'cor' => $cor,
                'schoolID' => $schoolID,
                'vaccineCard' => $vaccineCard,
                'contract' => $contract,
                'type' => $type,
            ]);

            if($branch==="Dormitory"){
                $room = Dormitoryroom::findOrFail($id);
                $bed = Dormitorybed::create([
                    'user_id' => $user->id
                ]);
            }else{
                $bed = Hostelbed::create([
                    'user_id' => $user->id
                ]);
            }
                

            return response()->json(['user' => $user], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating Resident: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getRegisteredusers(Request $request)
    {
        try {
            if (Auth::check()) {
                $searchQuery = $request->input('search_query');
                $registereduserType = $request->input('registereduser_type');
                
                
                $query = Registration::query();

                if ($registereduserType && $registereduserType !== 'All') {
                    $query->where('type', $registereduserType);
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
        } catch (\Exception $e) {
            \Log::error('Error in getRegisteredusers: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function addRegistereduser(Request $request){
        $registeredUser = Registration::find($request->input('registereduser_id'));
        $bed = Dormitorybed::find($request->input('bed_id'));
        $room = Dormitoryroom::find($request->input('room_id'));
        Log::info($registeredUser->address);
        $user = User::create([
            'name' => $registeredUser->name,
            'email' => $registeredUser->email,
            'password' => bcrypt($registeredUser->password),
            'branch' => $registeredUser->branch,
            'role' => $registeredUser->role,
            'Tuptnum' => $registeredUser->Tuptnum,
            'sex' => $registeredUser->sex,
            'address' => $registeredUser->address,
            'birthdate' => $registeredUser->birthdate,
            'contacts' => $registeredUser->contacts,
            'cor' => $registeredUser->cor,
            'validId' => $registeredUser->validId,
            'vaccineCard' => $registeredUser->vaccineCard,
            'contract' => $registeredUser->contract,
            'type' => $registeredUser->type,
            'roomdetails' =>$room->name.': '.$bed->name,
        ]);

        $bed->update([
            'user_id' => $user->id,
            'status' => "Occupied",
        ]);

        $room->update([
            'slot' => $room->slot - 1,
        ]);

        $registeredUser->delete();

        return response()->json($user);


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
                    'start' => $schedule->laundrydate,
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

    public function getRooms(Request $request)
    {
        
        try {
            if (Auth::check()) {
                $roomType = $request->input('room_type');
                $roomCategory = $request->input('sex');

                $query = Auth::user()->branch === "Dormitory" ? Dormitoryroom::query() : Hostelroom::query();

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
            }else{
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
                    'slot' => $numBeds,
                    'totalBeds' => $numBeds,
                ]);
                
                for ($i = 0; $i < $numBeds; $i++) {
                    Dormitorybed::create([
                        'name' => $bedNames[$i],
                        'room_id' => $room->id,
                    ]);
                }
            }else{
                $room = Hostelroom::create([
                    'name' => $name,
                    'type' => $type,
                    'category' => $category,
                    'slot' => $numBeds,
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
                }else{
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
                }else{
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


    public function getBeds(Request $request,$id)
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

    public function getRepairs()
    {
        try {
            if(Auth::user()->branch === "Dormitory"){
                $repairs = Repair::where('branch',"Dormitory")->get(); 
            }else{
                $repairs = Repair::where('branch',"Hostel")->get(); 
            }
                Log::info($repairs);     
            return response()->json(['repairs' => $repairs]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Repairs not found'], 404);
        }
    }

}
