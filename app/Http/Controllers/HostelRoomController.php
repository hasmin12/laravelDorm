<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\HostelRoomsDataTable;
use App\Helpers\AuthHelper;
use App\Models\HostelRoom;
use App\Models\HostelImage;
use App\Models\Reservation;
use App\Models\User;

class HostelRoomController extends Controller
{
    //
    public function HostelRooms(HostelRoomsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Hostel Rooms')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.rooms.hostel', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    public function ViewHostels(Request $request)
    {
        $hostelrooms = HostelRoom::with('images')->get();
        $hostelimages = HostelImage::all();
        $assets = ['chart', 'animation'];
        return view('guest.hostel', compact('assets','hostelrooms','hostelimages'));
    }

    public function reserve(Request $request)
    {
        // Retrieve data directly from the request
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        $totalPrice = $request->input('totalPrice'); // You might want to handle this as a number
        $cartItems = $request->input('cartItems');

        // Optionally create a user if it doesn't exist
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'username' => $firstname . " " . $lastname,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'password' => bcrypt($password),
            ]
        );

        // Iterate over cart items to create reservations
        foreach ($cartItems as $item) {
            Reservation::create([
                'hostel_room_id' => $item['roomId'],
                'user_id' => $user->id,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'total_price' => $item['total'], // Make sure this is numeric
                'status' => 'pending',
            ]);
        }

        return response()->json(['success' => 'Reservation created successfully.']);
    }

    public function addRoom(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'floorNumber' => 'required|integer',
            'beds' => 'required|integer',
            'price' => 'required|numeric',
            'pax' => 'required|integer',
            'status' => 'required|string|in:available,unavailable',
        ]);

        HostelRoom::create($validatedData);

        return redirect()->back()->with('success', 'Hostel Room created successfully.');
    }

    public function updateRoom(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'floorNumber' => 'required|integer',
            'beds' => 'required|integer',
            'price' => 'required|numeric',
            'pax' => 'required|integer',
            'status' => 'required|string|in:available,unavailable',
        ]);

        $hostelRoom = HostelRoom::findOrFail($id);

        $hostelRoom->update($validatedData);


        return redirect()->back()->with('success', 'Hostel Room updated successfully.');
    }

}
