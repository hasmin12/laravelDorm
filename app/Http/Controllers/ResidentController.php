<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Repair;

class ResidentController extends Controller
{
    //
    public function getRepairs()
    {
        $user = Auth::user();
        if($user->role === "Admin"){
            $repairs = Repair::where('branch', $user->branch)->where('user_id',$user->id)->get();
        }else{
            $repairs = Repair::where('branch', $user->branch)->get();
        }
            

        return response()->json(['repairs' => $repairs]);
    }

    public function createRepair(Request $request)
    {
        try {
            $ldate = date('Y-m-d H:i:s');

            $user = Auth::user(); 
            $itemName = $request->input('itemName');
            $description = $request->input('description');

            $repair = Repair::create([
                'itemName' => $itemName,
                'description' => $description,
                'room_number' => $user->roomdetails,
                'request_date' => $ldate,
                'branch' => $user->branch,
                'residentName' => $user->name
            ]);

            $imgpath = $request->file('img_path');
                if ($imgpath && $imgpath !== '') {
                    $fileName = time() . $request->file('img_path')->getClientOriginalName();
                    $path = $request->file('img_path')->storeAs('repair', $fileName, 'public');
                    $img_path = '/storage/' . $path;

                    $repair->update([
                        'img_path' => $img_path,
                    ]);
                }

            return response()->json(['repair' => $repair], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating repair: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    
    
    
}
