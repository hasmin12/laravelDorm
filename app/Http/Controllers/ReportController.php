<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Maintenance;
use App\Models\Laundryschedule;


use App\Models\BillingReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Log;
use Dompdf\Options;

class ReportController extends Controller
{
    //
    public function residentsReport(Request $request)
    {
        $branch = $request->input('branch');
        $change = $request->input('change');
        $query = User::select('name', 'email', 'type', 'birthdate', 'sex', 'contactNumber','created_at')
            ->where('status', 'Active')
            ->where('role', 'Resident')
            ->where('branch', $branch);
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
        $users = $query->get();

        return response()->json($users);
    }

    public function maintenanceReport(Request $request)
    {
        $branch = $request->input('branch');
        $change = $request->input('change');
        $query = Maintenance::select('room_number', 'request_date', 'type', 'technicianName', 'residentName', 'completed_date','status')
            ->where('branch', $branch);
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
        $maintenance = $query->get();

        return response()->json($maintenance);
    }

    public function visitorsReport(Request $request)
    {
        $branch = $request->input('branch');
        $change = $request->input('change');
        
        $query = Visitor::select('name', 'phone', 'visit_date', 'residentName', 'relationship', 'purpose');
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
        $visitors = $query->get();

        return response()->json($visitors);
    }

    public function laundryReport(Request $request)
    {
        $branch = $request->input('branch');
        $change = $request->input('change');
        
        $query = Laundryschedule::select('laundryschedules.user_id', 'users.name', 'laundryschedules.laundrydate', 'laundryschedules.laundrytime', 'laundryschedules.status', 'laundryschedules.created_at')
            ->join('users', 'laundryschedules.user_id', '=', 'users.id')
            ->where('laundryschedules.branch', $branch);
        switch ($change) {
            case 'Daily':
                $query->whereDate('laundryschedules.created_at', today()->format('Y-m-d'));
                break;
            case 'Weekly':
                $query->whereBetween('laundryschedules.created_at', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')]);
                break;
            case 'Monthly':
                $query->whereMonth('laundryschedules.created_at', now()->month);
                break;
            case 'Yearly':
                $query->whereYear('laundryschedules.created_at', now()->year);
                break;
            default:
                break;
        }
        $laundryschedules = $query->get();

        return response()->json($laundryschedules);
    }

    


    public function generateResidentsReport(Request $request)
    {
        set_time_limit(300); 
        $branch = $request->input('branch');
        $change = $request->input('change');
        $query = User::select('name', 'email', 'type', 'birthdate', 'sex', 'contactNumber', 'created_at')
            ->where('branch', 'Dormitory')
            ->where('status', 'Active')
            ->where('role', 'Resident')
            ->where('branch', $branch);

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

        $users = $query->get();

        $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', true);

        $pdf = Pdf::loadView('admin.reports.residents', compact('users'));

        return $pdf->download('residents_report.pdf');
    }

    public function generateMaintenanceReport(Request $request)
    {
        set_time_limit(300); 
        $branch = $request->input('branch');
        $change = $request->input('change');
        $query = Maintenance::select('room_number', 'request_date', 'type', 'technicianName', 'residentName', 'completed_date','status')
            ->where('branch', $branch);
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
        $maintenance = $query->get();

        $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', true);

        $pdf = Pdf::loadView('admin.reports.maintenance', compact('maintenance'));

        return $pdf->download('maintenance_report.pdf');
    }
    



    public function generateVisitorsReport(Request $request)
    {
        set_time_limit(300); 
        $change = $request->input('change');
        
        $query = Visitor::select('name', 'phone', 'visit_date', 'residentName', 'relationship', 'purpose');
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
        $visitors = $query->get();


        $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', true);

        $pdf = Pdf::loadView('admin.reports.visitors', compact('visitors'));

        return $pdf->download('visitors_report.pdf');
    }

    public function generateLaundryReport(Request $request)
    {
        set_time_limit(300); 
        $branch = $request->input('branch');
        $change = $request->input('change');
        
        $query = Laundryschedule::select('laundryschedules.user_id', 'users.name', 'laundryschedules.laundrydate', 'laundryschedules.laundrytime', 'laundryschedules.status', 'laundryschedules.created_at')
            ->join('users', 'laundryschedules.user_id', '=', 'users.id')
            ->where('laundryschedules.branch', $branch);
        switch ($change) {
            case 'Daily':
                $query->whereDate('laundryschedules.created_at', today()->format('Y-m-d'));
                break;
            case 'Weekly':
                $query->whereBetween('laundryschedules.created_at', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')]);
                break;
            case 'Monthly':
                $query->whereMonth('laundryschedules.created_at', now()->month);
                break;
            case 'Yearly':
                $query->whereYear('laundryschedules.created_at', now()->year);
                break;
            default:
                break;
        }
        $laundryschedules = $query->get();

        $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', true);

        $pdf = Pdf::loadView('admin.reports.laundry', compact('laundryschedules'));

        return $pdf->download('visitors_report.pdf');
    }


}
