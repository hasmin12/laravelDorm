<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Repairchange;
use Log;
use Auth;
class TechnicianController extends Controller
{
    //
    public function acceptRepair(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            $user = Auth::user(); 
            $id = $request->input('repair_id');
            $cost = $request->input('cost');
            $completion = $request->input('completionDays');
            $repair = Repair::find($id);
            
            $repair->update([
                'cost' => $cost,
                'completionDays' => $completion,
                'status' => "PENDING",
                'technician_id' => $user->id,
                'technicianName' => $user->name,
            ]);

            return response()->json(['repair' => $repair], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating repair: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    
    public function getRepairStatus(Request $request)
    {
 
        $repairStatus = Repairchange::where('repair_id', $request->input('repair_id'))->get();
     
        return response()->json($repairStatus, 200);
    }

    public function addRepairStatus(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            $description = $request->input('description');
            $changePercentage = $request->input('changePercentage');
            $id = $request->input('repair_id');
            $repairStatus = Repairchange::create([
                'repair_id' => $id ,
                'changePercentage' => $changePercentage,
                'description' => $description,
            ]);

            $repair = Repair::find($id);
            $newPercentage = $repair->completionPercentage + $changePercentage;
            Log::info($repair->completionPercentage );
            Log::info($changePercentage );
            Log::info($newPercentage);

            if($newPercentage === 100){
                $repair->update([
                    'completionPercentage' => $newPercentage,
                    'status' => "DONE",
                    'completedDate' => $ldate
                ]);
            }else{
                $repair->update([
                    'completionPercentage' => $newPercentage
                ]);
            }
            

            return response()->json($repair, 201);
        } catch (\Exception $e) {
            \Log::error('Error creating repairStatus: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
