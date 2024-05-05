<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BillingReport;

use Carbon\Carbon;
use Log;
use Dompdf\Dompdf;
use Dompdf\Options;
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
    

    
    public function printResidentsReport()
    {   
        
        $html = view('pdf.residents', compact('residents', 'residentChartData'))->render();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('ResidentsReport.pdf');
    }
}
