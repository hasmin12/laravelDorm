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
use App\Models\Guardian;

use Log;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Response\QrCodeResponse;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;
use Storage;
use Illuminate\Support\Str;
class GuestController extends Controller
{
    //
    public function getHostelRooms(Request $request)
    {
        $query = HostelRoom::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('bedtype', 'like', '%' . $search . '%')
                    ->orWhere('pax', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%')
                    ->orWhere('rating', 'like', '%' . $search . '%');
            });
        }
        if ($request->has('features')) {
            $features = $request->input('features');
            if (in_array('wifi', $features)) {
                $query->where('wifi', true);
            }
            if (in_array('air_conditioning', $features)) {
                $query->where('air_conditioning', true);
            }
            if (in_array('kettle', $features)) {
                $query->where('kettle', true);
            }
            if (in_array('tv_with_cable', $features)) {
                $query->where('tv_with_cable', true);
            }
            if (in_array('hot_shower', $features)) {
                $query->where('hot_shower', true);
            }
            if (in_array('refrigerator', $features)) {
                $query->where('refrigerator', true);
            }
            if (in_array('kitchen', $features)) {
                $query->where('kitchen', true);
            }
            if (in_array('hair_dryer', $features)) {
                $query->where('hair_dryer', true);
            }
        }

        $hostelRooms = $query->get();

        $rooms = $hostelRooms->map(function ($room) {
            Log::info($room);

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
                'wifi' => $room->wifi,
                'air_conditioning' => $room->air_conditioning,
                'kettle' => $room->kettle,
                'tv_with_cable' => $room->tv_with_cable,
                'hot_shower' => $room->hot_shower,
                'refrigerator' => $room->refrigerator,
                'kitchen' => $room->kitchen,
                'hair_dryer' => $room->hair_dryer,
            ];
        });

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


            $hostelRoom = Hostelroom::find($request->input('room_id'));

            $reservation = Reservation::create([
                'room_id' => $request->input('room_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),

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
                'roomName' => $hostelRoom->name,
                'status' => "Pending",
                'qrcode' => "",
                'qrcodeImage' => "",

            ]);

            $qrCodeText = Str::random(10);
            // $qrCode = Builder::create()
            //     ->writer(new PngWriter())
            //     ->writerOptions([])
            //     ->data($qrCodeText)
            //     ->encoding(new Encoding('UTF-8'))
            //     ->size(250)
            //     ->margin(10)
            //     ->build();

            // $qrCodePath = 'qrcodes/' . time() . '_qrcode.png';
            // Storage::put($qrCodePath, $qrCode->getString());

            $reservation->update([
                'qrcode' => $qrCodeText,
                // 'qrcodeImage' => $qrCodePath,
            ]);

        // Mail::to($request->input('email'))->send(new ReservationConfirmation($reservation));

        return response()->json(['message' => 'Reservation created successfully', 'reservation' => $reservation]);
    } catch (\Exception $e) {
        Log::error('Error creating reservation: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}





    public function createRegistration(Request $request)
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


        $user = User::create([

            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => $request->input('type'),
            'img_path' => $img_path,

            'name' => $request->input('name'),
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

            'applicationForm' => $applicationForm,
            'cor' => $corPath,
            'validID' => $validIdPath,
            'vaccineCard' => $vaccineCardPath,
            'status' => 'Applicant',
        ]);

        $guardian = Guardian::create([
            'user_id' => $user->id,
            'name' => $request->input('guardianName'),
            'contactNumber' => $request->input('guardianContactNumber'),
            'relationship' => $request->input('guardianRelationship'),
            'address' => $request->input('guardianAddress'),
        ]);


        return response()->json(['message' => 'Registration successful', 'user' => $user]);
    }

    public function register(Request $request)
    {
        Log::info($request);

        // Handle file upload
        $fileName1 = time() . $request->file('img_path')->getClientOriginalName();
        $path1 = $request->file('img_path')->storeAs('residents', $fileName1, 'public');
        $img_path = '/storage/' . $path1;

        // Create new user
        $user = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => $request->input('type'),
            'img_path' => $img_path,
            'name' => $request->input('name'),
            'Tuptnum' => $request->input('Tuptnum'),
            'status' => 'Applicant',
        ]);

        return redirect()->route('login')
                        ->with('success', 'Registration successful. Please wait for confirmation.');
    }


    public function addVisitor(Request $request)
    {
        $fileName = time() . $request->file('validId')->getClientOriginalName();
        $path = $request->file('validId')->storeAs('validId', $fileName, 'public');
        $validId = '/storage/' . $path;

        $visitor = Visitor::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'visit_date' => $request->input('visit_date'),
            'residentName' => $request->input('residentName'),
            'relationship' => $request->input('relationship'),
            'purpose' => $request->input('purpose'),
            'validId' => $validId
        ]);

        return response()->json(['message' => 'Visitor form submitted successfully']);
    }

    public function getResidents()
    {
        $residents = User::where('branch', "Dormitory")->where('role', "Resident")->where('status', "Active")->get();
        Log::info($residents);
        return response()->json(['residents' => $residents]);
    }

    public function getReservations()
    {
        $reservations = Reservation::all();

        return response()->json($reservations);
    }

    public function getReviews($id)
    {
        $reviews = Hostelreview::where('room_id', $id)->get();

        return response()->json($reviews);
    }
}
