<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;

class ChartController extends Controller
{
    //
    public function dormitorychart()
    {
        $users = User::where('branch',"Dormitory")->where('status',"active")->get();

        $userTypes = $users->groupBy(function($user) {
            return $user->user_type ?? 'Unknown';
        })->map->count();
        return view('admin.reports.dormitory', compact('userTypes'));
    }

    public function hostelchart()
    {
        $reservations = Reservation::selectRaw('count(*) as count, status')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        return view('admin.reports.hostel', compact('reservations'));
    }


}
