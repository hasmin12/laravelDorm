<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DormitoryRoomsDataTable;
use App\Helpers\AuthHelper;
use App\Models\DormitoryRoom;
use App\Models\DormitoryBed;
use App\Models\User;


class DormitoryRoomController extends Controller
{
    //
    public function DormitoryRooms(DormitoryRoomsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Dormitory Rooms')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.rooms.dormitory', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    public function addRoom(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'totalBed' => 'required|integer|min:1',
            'type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:available,unavailable',
        ]);

        $room = DormitoryRoom::create($validatedData);

        for ($i = 1; $i <= $request->totalBed; $i++) {
            $bedName = 'Bed ' . chr(64 + $i);

            DormitoryBed::create([
                'room_id' => $room->id,
                'user_id' => null,
                'name' => $bedName,
                'status' => 'available',
            ]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Dormitory Room added successfully.');
    }

    public function updateRoom(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'totalBed' => 'required|integer|min:1',
            'type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:available,unavailable',
        ]);

        // Find the existing dormitory room
        $room = DormitoryRoom::findOrFail($id);

        // Update the room details
        $room->update($validatedData);

        // Get the current number of beds
        $currentBedCount = $room->beds()->count();

        if ($request->totalBed > $currentBedCount) {
            // Add new beds if totalBed is greater
            for ($i = $currentBedCount + 1; $i <= $request->totalBed; $i++) {
                $bedName = 'Bed ' . chr(64 + $i); // Generate bed name (e.g., Bed A, Bed B)
                DormitoryBed::create([
                    'room_id' => $room->id,
                    'user_id' => null, // Set this according to your logic
                    'name' => $bedName,
                    'status' => 'available',
                ]);
            }
        } elseif ($request->totalBed < $currentBedCount) {
            // Delete excess beds if totalBed is less
            $bedsToDelete = $currentBedCount - $request->totalBed;
            $beds = $room->beds()->orderBy('name', 'desc')->take($bedsToDelete)->get();
            foreach ($beds as $bed) {
                $bed->delete();
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Dormitory Room updated successfully.');
    }

    public function showbed($id){
        $room = DormitoryRoom::findOrFail($id);

        return view('admin.rooms.dormitorybed', compact('room'));
    }

    public function assignBed(Request $request){

        $validatedData = $request->validate([
            'user_id' => 'required',
            'bed_id' => 'required',
        ]);
        $bed = DormitoryBed::findOrFail($request->bed_id);
        $bed->update([
            'user_id' => $request->user_id,
            'status' => 'occupied',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update([
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'User assigned successfully.');
    }

}
