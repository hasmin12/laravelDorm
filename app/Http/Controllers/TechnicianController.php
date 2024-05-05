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
 
        $maintenanceStatus = Maintenancechange::where('maintenance_id', $request->input('maintenance_id'))->get();
     
        return response()->json($maintenanceStatus, 200);
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
            $changePercentage = $request->input('changePercentage');
            $id = $request->input('maintenance_id');
            $maintenanceStatus = Maintenancechange::create([
                'maintenance_id' => $id ,
                'changePercentage' => $changePercentage,
                'description' => $description,
            ]);

            $maintenance = Maintenance::find($id);
            $newPercentage = $maintenance->completionPercentage + $changePercentage;
            Log::info($maintenance->completionPercentage );
            Log::info($changePercentage );
            Log::info($newPercentage);

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
