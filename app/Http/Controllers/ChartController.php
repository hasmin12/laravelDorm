<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;
use Dompdf\Dompdf;
use Dompdf\Options;
class ChartController extends Controller
{

    public function residentChart(Request $request)
    {
        //Barchart
        Log::info($request->input('branch'));
        $currentDate = Carbon::now();
        $firstDayOfCurrentMonth = $currentDate->startOfMonth();
        $firstDayOfPreviousMonth = $currentDate->subMonth()->startOfMonth();
        $firstDayOfTwoMonthsAgo = $currentDate->subMonth()->startOfMonth();

        $query = User::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count'))
            ->where(function ($query) use ($firstDayOfCurrentMonth, $firstDayOfPreviousMonth, $firstDayOfTwoMonthsAgo) {
                $query->where('created_at', '>=', $firstDayOfCurrentMonth)
                    ->orWhere('created_at', '>=', $firstDayOfPreviousMonth)
                    ->orWhere('created_at', '>=', $firstDayOfTwoMonthsAgo);
            });

        if ($request->input('branch') !== null && $request->input('branch') !== '') {
            $query->where('branch', $request->input('branch'));
        }

        if ($request->input('branch') === 'Both' || $request->input('branch') === '') {
            $query->whereIn('branch', ['Hostel', 'Dormitory']);
        }

        $residentChart = $query->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();

        Log::info($residentChart);
        return response()->json($residentChart);
    }

    public function residentTypeChart(Request $request)
    {
        //Piechart
        Log::info($request->input('branch'));

        $query = User::select(DB::raw('type, COUNT(*) as count'));

        if ($request->input('branch') !== null && $request->input('branch') !== '') {
            $query->where('branch', $request->input('branch'));
        }

        if ($request->input('branch') === 'Both' || $request->input('branch') === '') {
            $query->whereIn('branch', ['Hostel', 'Dormitory']);
        }

        $residentTypeChart = $query->groupBy('type')->get();


        Log::info($residentTypeChart);

        return response()->json($residentTypeChart);
    }

    public function generatePdf()
{
    // Retrieve residents data
    $residents = User::all();

    // Retrieve resident chart data
    $residentChartData = [
        'residentChart' => $this->residentChart(request())->getContent(),
        'residentTypeChart' => $this->residentTypeChart(request())->getContent(),
    ];

    // Generate HTML for the PDF view
    $html = view('pdf.residents', compact('residents', 'residentChartData'))->render();

    // Generate PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Output PDF
    return $dompdf->stream('residents.pdf');
}

}
