<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Hostelroom;
use App\Models\Reservation;
use App\Models\Registration;
use App\Models\User;
use App\Models\Visitor;

use Log;
class GuestController extends Controller
{
    //
    public function getHostelRooms()
    {
        $hostelRooms = HostelRoom::all();

        $rooms = $hostelRooms->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'description' => $room->description,
                'type' => $room->type,
                'pax' => $room->pax,
                'price' => $room->price,
                'status' => $room->status,
                'img_paths' => $room->images()->pluck('path')->toArray(), 
            ];
        });

        return response()->json($rooms);
    }

    public function createReservation(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            
            $fileName1 = time() . $request->file('payments')->getClientOriginalName();
            $path1 = $request->file('payments')->storeAs('payments', $fileName1, 'public');
            $payments = '/storage/' . $path1;

            $fileName = time() . $request->file('img_path')->getClientOriginalName();
            $path = $request->file('img_path')->storeAs('reserve', $fileName, 'public');
            $img_path = '/storage/' . $path;

            $reservation = Reservation::create([
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
                'payments' => $payments,
                'reservation_date' => $ldate,
            ]);

            $hostelRoom = Hostelroom::find($reservation->room_id);
            $hostelRoom->update([
                'status' => "Reserved",
            ]);
    
            return response()->json(['message' => 'Reservation created successfully', 'reservation' => $reservation]);
        } catch (\Exception $e) {
            \Log::error('Error creating room: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function createRegistration(Request $request)
    {
        
        $fileName1 = time() . $request->file('contract')->getClientOriginalName();
        $path1 = $request->file('contract')->storeAs('contract', $fileName1, 'public');
        $contractPath = '/storage/' . $path1;

        $fileName2 = time() . $request->file('cor')->getClientOriginalName();
        $path2 = $request->file('cor')->storeAs('cor', $fileName2, 'public');
        $corPath = '/storage/' . $path2;

        $fileName3 = time() . $request->file('validId')->getClientOriginalName();
        $path3 = $request->file('validId')->storeAs('validId', $fileName3, 'public');
        $validIdPath = '/storage/' . $path3;
        
        $fileName4 = time() . $request->file('vaccineCard')->getClientOriginalName();
        $path4 = $request->file('vaccineCard')->storeAs('vaccineCard', $fileName4, 'public');
        $vaccineCardPath = '/storage/' . $path4;
        Log::info($request->input('password'));
        $user = Registration::create([
           
            'Tuptnum' => $request->input('Tuptnum'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'type' => $request->input('type'),
            'sex' => $request->input('sex'),
            'birthdate' => $request->input('birthdate'),
            'address' => $request->input('address'),
            'contacts' => $request->input('contacts'),
            'contract' => $contractPath,
            'cor' => $corPath,
            'validId' => $validIdPath,
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
}
