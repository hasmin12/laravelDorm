<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Hostelroom;
use App\Models\Reservation;
use App\Models\Registration;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Hostelreview;

use Log;
class GuestController extends Controller
{
    //
    public function getHostelRooms(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $query = HostelRoom::query();

    if ($startDate && $endDate) {
        $query->whereDoesntHave('reservations', function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                $query->where('checkout_date', '>=', $endDate)
                      ->where('checkin_date', '<=', $startDate);
            });
        });
    }

    $hostelRooms = $query->get();

    $rooms = $hostelRooms->map(function ($room) {
        return [
            'id' => $room->id,
            'name' => $room->name,
            'description' => $room->description,
            'bedtype' => $room->bedtype,
            'pax' => $room->pax,
            'price' => $room->price,
            'status' => $room->status,
            'rating' => $room->rating,
            'img_path' => $room->img_path,
            'img_paths' => $room->images()->pluck('path')->toArray(),
            'reservations' => $room->reservations, 
        ];
    });
    Log::info($request);
    Log::info($rooms);
    return response()->json($rooms);
}

    public function createReservation(Request $request)
    {
        try {
            Log::info($request);
            $ldate = date('Y-m-d H:i:s');
            
            $fileName1 = time() . $request->file('downreceipt')->getClientOriginalName();
            $path1 = $request->file('downreceipt')->storeAs('downreceipt', $fileName1, 'public');
            $payments = '/storage/' . $path1;

            $fileName = time() . $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('reserve', $fileName, 'public');
            $img_path = '/storage/' . $path;

            $newHostelUser = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'sex' => $request->input('sex'),
                'address' => $request->input('address'),
                'contacts' => $request->input('contacts'),
                'birthdate' => $request->input('birthdate'),
                'validId' => $request->input('validId'),
                'role' => 'Resident',
                'branch' => 'Hostel',
                'type' => 'Hostel Resident',
            ]);
            $hostelRoom = Hostelroom::find($request->input('room_id'));
            $hostelRoom->update([
                'status' => "Reserved",
            ]);

            $reservation = Reservation::create([
                'user_id' => $newHostelUser->id,
                'room_id' => $request->input('room_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'sex' => $request->input('sex'),
                'address' => $request->input('address'),
                'contacts' => $request->input('contacts'),
                'birthdate' => $request->input('birthdate'),
                'validId' => $request->input('validId'),
                'img_path' => $img_path,
                'checkin_date' => $request->input('checkin_date'),
                'checkout_date' => $request->input('checkout_date'),
                'downPayment' => $request->input('downPayment'),
                'totalPayment' => $request->input('totalPayment'),
                'downreceipt' => $payments,
                'reservation_date' => $ldate,
                'roomName' => $hostelRoom->name
            ]);

            
    
            return response()->json(['message' => 'Reservation created successfully', 'reservation' => $reservation]);
        } catch (\Exception $e) {
            \Log::error('Error creating room: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function createRegistration(Request $request)
    {
        
        $fileName1 = time() . $request->file('img_path')->getClientOriginalName();
        $path1 = $request->file('img_path')->storeAs('residents', $fileName1, 'public');
        $img_path = '/storage/' . $path1;

        $fileName2 = time() . $request->file('cor')->getClientOriginalName();
        $path2 = $request->file('cor')->storeAs('cor', $fileName2, 'public');
        $corPath = '/storage/' . $path2;

        $fileName3 = time() . $request->file('validID')->getClientOriginalName();
        $path3 = $request->file('validID')->storeAs('validID', $fileName3, 'public');
        $validIdPath = '/storage/' . $path3;
        
        $fileName4 = time() . $request->file('vaccineCard')->getClientOriginalName();
        $path4 = $request->file('vaccineCard')->storeAs('vaccineCard', $fileName4, 'public');
        $vaccineCardPath = '/storage/' . $path4;
        // Log::info($request->input('password'));
        $user = Registration::create([
           
            'email' => $request->input('email'),
            'password' =>brycpt($request->input('password')),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => $request->input('type'),
            'img_path' => $img_path,
            
            'name' => $request->input('fname')." ".$request->input('lname') ,
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

            'cor' => $corPath,
            'validID' => $validIDPath,
            'vaccineCard' => $vaccineCardPath,
        ]);


        return response()->json(['message' => 'Registration successful', 'user' => $user]);
    }

    public function addVisitor(Request $request){
        $fileName = time() . $request->file('validId')->getClientOriginalName();
        $path = $request->file('validId')->storeAs('validId', $fileName, 'public');
        $validId = '/storage/' . $path;

        $visitor = Visitor::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'visit_date' => $request->input('visit_date'),
            'user_id' => $request->input('resident_id'),
            'relationship' => $request->input('relationship'),
            'purpose' => $request->input('purpose'),
            'validId' => $validId
        ]);
      
        return response()->json(['message' => 'Visitor form submitted successfully']);
    }

    public function getResidents(){
        $residents = User::where('branch', "Dormitory")->where('role',"Resident")->get();
        Log::info($residents);
        return response()->json(['residents' => $residents]);
    }

    public function getReservations(){
        $reservations = Reservation::all();
      
        return response()->json($reservations);
    }

    public function getReviews($id){
        $reviews = Hostelreview::where('room_id',$id)->get();
      
        return response()->json($reviews);
    }
}