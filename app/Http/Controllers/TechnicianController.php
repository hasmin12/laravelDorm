<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Maintenancechange;
use Log;
use Auth;
class TechnicianController extends Controller
{
    //
    public function acceptMaintenance(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');
            $user = Auth::user(); 
            $id = $request->input('maintenance_id');
            $cost = $request->input('cost');
            $completion = $request->input('completionDays');
            $maintenance = Maintenance::find($id);
            
            $maintenance->update([
                // 'cost' => $cost,
                'completionDays' => $completion,
                'status' => "IN PROGRESS",
                'technician_id' => $user->id,
                'technicianName' => $user->name,
            ]);

            return response()->json(['maintenance' => $maintenance], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating maintenance: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
 
    public function getMaintenanceStatus(Request $request)
    {
 
        $maintenanceStatus = Maintenance::findOrFail($request->input('maintenance_id'));
        Log::info($maintenanceStatus->completionPercentage);
        return response()->json($maintenanceStatus->completionPercentage, 200);
    }
    public function getMaintenance(Request $request)
    {
 
        $maintenance = Maintenance::where('technician_id', Auth::user()->id)->get();

        return response()->json($maintenance, 200);
    }
    public function addMaintenanceStatus(Request $request)
    {

        try {
            $ldate = date('Y-m-d H:i:s');
            $description = $request->input('description');
            $completionPercentage = $request->input('completionPercentage');
            $id = $request->input('maintenance_id');
            $maintenanceStatus = Maintenancechange::create([
                'maintenance_id' => $id ,
                'changePercentage' => $completionPercentage,
                'description' => $description,
            ]);

            $maintenance = Maintenance::find($id);
            $newPercentage = $completionPercentage;
            

            if($newPercentage === 100){
                $maintenance->update([
                    'completionPercentage' => $newPercentage,
                    'status' => "DONE",
                    'completedDate' => $ldate
                ]);
            }else{
                $maintenance->update([
                    'completionPercentage' => $newPercentage
                ]);
            }
            

            return response()->json($maintenance, 201);
        } catch (\Exception $e) {
            \Log::error('Error creating maintenanceStatus: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}

