<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Maintenance;

use App\Models\BillingReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Log;

class ReportController extends Controller
{
    //
    public function residentsReport(Request $request)
    {
        $branch = $request->input('branch');
        $change = $request->input('change');

    
        $query = BillingReport::where('branch', $branch)->where('status',"PAID");
        // $query = BillingReport::where('branch', $branch);
    
        switch ($change) {
            case 'Daily':
                $query->whereDate('created_at', today()->format('Y-m-d'));
                break;
            case 'Weekly':
                $query->whereBetween('created_at', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')]);
                break;
            case 'Monthly':
                $query->whereMonth('created_at', now()->month);
                break;
            case 'Yearly':
                $query->whereYear('created_at', now()->year);
                break;
            default:
                break;
        }
    
        $billings = $query->get();
        $notPaid = BillingReport::where('status', 'Pending')->count();
        $Paid = BillingReport::where('status', 'PAID')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();
        $lateFee = BillingReport::where('status', 'late fee')->distinct()->count('residentName');

        return response()->json(['report'=>$billings,'notPaid'=>$notPaid,'Paid'=>$Paid,'lateFee'=>$lateFee,]);
    }
    

    
    
 // Assuming your User model is in the App\Models namespace

    // public function generateUsersReport()
    // {
    //     $users = User::select('name', 'email', 'type', 'birthdate', 'sex', 'contactNumber')
    //         ->where('branch', 'Dormitory')
    //         ->where('status', 'Active')
    //         ->where('role', 'Resident')
    //         ->get();


    //     $html = view('admin.reports.residents', compact('users'))->render();
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isRemoteEnabled', true);
    //     $dompdf = new Dompdf($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     return $dompdf->stream('users_report.pdf');
    // }
    public function generateUsersReport()
    {
        $users = User::select('name', 'email', 'type', 'birthdate', 'sex', 'contactNumber')
            ->where('branch', 'Dormitory')
            ->where('status', 'Active')
            ->where('role', 'Resident')
            ->get();
    
        $pdf = Pdf::loadView('admin.reports.residents', $users);
        return $pdf->download('users.pdf');
    
    }

    public function generateMaintenanceReport()
    {
        $maintenance = Maintenance::all();
    
        $pdf = Pdf::loadView('admin.reports.maintenance', $maintenance);
        return $pdf->download('users.pdf');
    
    }
}
