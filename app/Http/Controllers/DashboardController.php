<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\User;
use App\Models\DormitoryRoom;
use App\Models\HostelRoom;

use DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    //
    public function getMonthNames()
    {
        $currentDate = Carbon::now()->startOfMonth();
        $startDate = $currentDate->copy()->subMonths(6)->startOfMonth();

        $months = [];
        $date = $startDate;

        // Generate an array of month names for the past 6 months, including the current month
        while ($date <= $currentDate) {
            $months[] = $date->format('F Y'); // Format as "Month Year"
            $date->addMonth();
        }

        return $months;
    }

    public function getDashboardData()
    {
        $currentDate = now()->endOfMonth();
        $startDate = now()->startOfYear();
        $numberOfMonths = $startDate->diffInMonths($currentDate);
        $numberOfDormitoryResidents = User::where('branch',"Dormitory")->where('status',"active")->where('user_type',"user")->count();
        $numberOfHostelResidents = User::where('branch',"Hostel")->where('status',"active")->where('user_type',"user")->count();
        $numberOfDormitoryRooms = DormitoryRoom::count();
        $numberOfHostelRooms  = HostelRoom::count();
        $payments = Payment::select(DB::raw('DATE_FORMAT(payment_date, "%Y-%m") as month'), DB::raw('SUM(amount) as total_revenue'))
        ->where('status', 'paid')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $reservations = Reservation::select(DB::raw('DATE_FORMAT(check_in_date, "%Y-%m") as month'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $paymentsData = $payments->map(function($item) {
            return [
                'month' => $item->month,
                'totalRevenue' => $item->total_revenue
            ];
        });

        $reservationsData = $reservations->map(function($item) {
            return [
                'month' => $item->month,
                'totalRevenue' => $item->total_revenue
            ];
        });


        $totalPaymentsRevenue = $payments->sum('total_revenue');
        $totalReservationsRevenue = $reservations->sum('total_revenue');
        if ($numberOfMonths == 0) {
            $monthlyPaymentsRevenue = $totalPaymentsRevenue ;
            $monthlyReservationsRevenue = $totalReservationsRevenue;
        } else {
            $monthlyPaymentsRevenue = $totalPaymentsRevenue / $numberOfMonths;
            $monthlyReservationsRevenue = $totalReservationsRevenue / $numberOfMonths;

        }


        return response()->json([
            'totalPaymentsRevenue' => $totalPaymentsRevenue,
            'totalReservationsRevenue' => $totalReservationsRevenue,
            'monthlyPaymentsRevenue' => $monthlyPaymentsRevenue,
            'monthlyReservationsRevenue' => $monthlyReservationsRevenue,

            'numberOfDormitoryResidents' => $numberOfDormitoryResidents,
            'numberOfHostelResidents' => $numberOfHostelResidents,
            'numberOfDormitoryRooms' => $numberOfDormitoryRooms,
            'numberOfHostelRooms' => $numberOfHostelRooms,
            'totalRevenue' => $totalPaymentsRevenue + $totalReservationsRevenue,

        ]);

    }
    public function getTotalRevenue()
    {
        $currentDate = now()->startOfMonth();
        $startDate = $currentDate->copy()->subMonths(6)->startOfMonth();

        $months = $this->getMonthNames();

        $payments = Payment::select(DB::raw('DATE_FORMAT(payment_date, "%Y-%m") as month'), DB::raw('SUM(amount) as total_revenue'))
            ->where('status', 'paid')
            ->whereBetween('payment_date', [$startDate, $currentDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $reservations = Reservation::select(DB::raw('DATE_FORMAT(check_in_date, "%Y-%m") as month'), DB::raw('SUM(total_price) as total_revenue'))
            ->whereBetween('check_in_date', [$startDate, $currentDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $paymentsData = array_fill_keys($months, 0);
        foreach ($payments as $item) {
            $month = Carbon::createFromFormat('Y-m', $item->month)->format('F Y');
            $paymentsData[$month] = $item->total_revenue;
        }
        $paymentsData = array_map(function($month, $revenue) {
            return ['month' => $month, 'totalRevenue' => $revenue];
        }, array_keys($paymentsData), $paymentsData);

        $reservationsData = array_fill_keys($months, 0);
        foreach ($reservations as $item) {
            $month = Carbon::createFromFormat('Y-m', $item->month)->format('F Y');
            $reservationsData[$month] = $item->total_revenue;
        }
        $reservationsData = array_map(function($month, $revenue) {
            return ['month' => $month, 'totalRevenue' => $revenue];
        }, array_keys($reservationsData), $reservationsData);

        return response()->json([
            'payments' => $paymentsData,
            'reservations' => $reservationsData
        ]);
    }




}
