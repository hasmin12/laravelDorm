<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dormitorypayment;

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
        $branch = $request->input('branch');
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


    public function getResidentDataByType()
    {
        // Get the count of residents created each month grouped by type
        $residentData = User::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                'type', 
                DB::raw("COUNT(*) as count")
            )
            ->where('role', 'Resident')
            ->where('branch', 'Dormitory')
            ->where(function ($query) {
                $query->where('status', 'Active') // Consider active residents
                    ->orWhere(function ($query) {
                        $query->where('status', 'Inactive')
                            ->whereYear('updated_at', now()->year)
                            ->whereMonth('updated_at', now()->month);
                    });
            })
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth()) // Get data from the past 6 months
            ->groupBy('month', 'type')
            ->orderBy('month')  
            ->get();

        $datasets = [];
        foreach ($residentData as $data) {
            if (!isset($datasets[$data->type])) {
                $datasets[$data->type] = [
                    'label' => $data->type,
                    'data' => []
                ];
            }
            $datasets[$data->type]['data'][] = $data->count;
        }

        $datasets = array_values($datasets);

        return response()->json($datasets);
    }
    public function countResidentsByType()
{
    // Define the past 6 months up to the current month
    $months = [];
    for ($i = 5; $i >= 0; $i--) {
        $months[] = Carbon::now()->subMonths($i)->format('M Y');
    }

    // Initialize counts for each type
    $typeCounts = [
        'Student' => array_fill(0, count($months), 0),
        'Faculty' => array_fill(0, count($months), 0),
        'Staff' => array_fill(0, count($months), 0)
    ];

    // Fetch necessary data from the database and aggregate counts
    $userCounts = User::where('role', 'Resident')
                      ->where('branch', 'Dormitory')
                      ->select('type', 'status', 'created_at', 'updated_at')
                      ->get();

    // Aggregate counts for each user type
    foreach ($userCounts as $user) {
        $type = $user->type;
        $status = $user->status;
        $createdAt = Carbon::parse($user->created_at);
        $updatedAt = Carbon::parse($user->updated_at);

        // Loop through each month and update counts based on status and type
        foreach ($months as $index => $month) {
            if ($status == 'Active' && $createdAt->format('Y-m') <= Carbon::parse($month)->format('Y-m')) {
                $typeCounts[$type][$index]++;
            }elseif($status == 'Inactive' && $createdAt->format('Y-m') <= Carbon::parse($month)->format('Y-m') && Carbon::parse($month)->format('Y-m') <= $updatedAt->format('Y-m')){
                $typeCounts[$type][$index]++;
            }
        }
    }

    // Prepare the output format
    $output = [
        'months' => $months,
        'datasets' => []
    ];

    $defaultColors = ["rgba(0, 156, 255, .7)", "rgba(255, 99, 132, .7)", "rgba(75, 192, 192, .7)"];
    $randomColors = array_slice($defaultColors, 0, count($typeCounts));

    // Iterate over the type counts and prepare the dataset
    $i = 0;
    foreach ($typeCounts as $type => $counts) {
        $output['datasets'][] = [
            'type' => $type,
            'counts' => $counts,
            'backgroundColor' => $randomColors[$i++]
        ];
    }

    return response()->json($output);
}


public function getDormPaymentChartData()
{
    // Define the past 6 months up to the current month
    $months = [];
    for ($i = 5; $i >= 0; $i--) {
        $months[] = Carbon::now()->subMonths($i)->format('M Y');
    }

    $status = [
        'PAID' => array_fill(0, count($months), 0),
        'Pending' => array_fill(0, count($months), 0),
    ];

    $payments = Dormitorypayment::all();

    // Aggregate payments by month and status
    foreach ($payments as $payment) {
        $paymentMonth = Carbon::parse($payment->created_at)->format('M Y');
        $status[$payment->status][array_search($paymentMonth, $months)] += $payment->totalAmount;
    }

    $output = [
        'months' => $months,
        'datasets' => []
    ];

    $defaultColors = ["rgba(0, 156, 255, .7)", "rgba(255, 99, 132, .7)"];
    $randomColors = array_slice($defaultColors, 0, count($status));

    // Iterate over the status and prepare the dataset
    $i = 0;
    foreach ($status as $status => $totals) {
        $output['datasets'][] = [
            'status' => $status,
            'totals' => $totals,
            'backgroundColor' => $randomColors[$i++]
        ];
    }

    return response()->json($output);
}

    
    

    
}





