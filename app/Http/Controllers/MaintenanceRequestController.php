<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\MaintenanceRequestsDataTable;
use App\Helpers\AuthHelper;
use App\Models\MaintenanceRequest;
use App\Models\MaintenanceStatus;

use App\Models\MaintenanceList;
use App\Models\DormitoryBed;


use Auth;

class MaintenanceRequestController extends Controller
{
    //
    public function maintenancerequests(MaintenanceRequestsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Maintenance')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.maintenancerequests.index', compact('pageTitle','auth_user','assets'));
    }

    public function myRequest()
    {
        $maintenance = MaintenanceRequest::with('maintenanceStatus')
            ->where('user_id', Auth::user()->id)
            ->get();

        $maintenancelist = MaintenanceList::all();

        $assets = ['chart', 'animation'];

        return view('residents.maintenance', compact('assets', 'maintenance', 'maintenancelist'));
    }


    public function requestmaintenance(Request $request)
    {
        $request->validate([
            'maintenance_type' => 'required',
            'description' => 'required|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Limit file size to 2MB
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('maintenance_images', 'public');
        }
        $user = Auth::user();
        $bed = DormitoryBed::where('user_id',$user->id)->first();
        MaintenanceRequest::create([
            'type' => $request->maintenance_type,
            'description' => $request->description,
            'room_details' => $bed->room->name,

            'image_path' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Maintenance request submitted successfully!');
    }

    public function addStatus(Request $request, $id)
    {
        $maintenance = MaintenanceRequest::findOrFail($id);

        $request->validate([
            'status' => 'required|array',
            'message' => 'nullable|string',
        ]);

        $newPercentage = array_sum($request->input('status'));
        $maintenance->completion_percentage = min($maintenance->completion_percentage + $newPercentage, 100);

        // Determine the title based on the new completion percentage
        $title = '';
        if ($maintenance->completion_percentage >= 100) {
            $maintenance->status = "completed";
            $title = "Finalize";
        } elseif ($maintenance->completion_percentage >= 80) {
            $title = "Execute";
        } elseif ($maintenance->completion_percentage >= 30) {
            $title = "Prepare Tools";
        } elseif ($maintenance->completion_percentage >= 20) {
            $title = "Plan";
        } elseif ($maintenance->completion_percentage >= 10) {
            $title = "Check";
        }

        // Save the maintenance request
        $maintenance->save();

        // Create the new maintenance status entry
        $maintenanceStatus = $maintenance->maintenanceStatus()->create([
            'title' => $title,
            'percentage' => $newPercentage,
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Maintenance request updated successfully!');
    }

    public function assignUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'maintenance_id' => 'required',

        ]);
        $userId = $request->input('user_id');
        $maintenance_id = $request->input('maintenance_id');

        $maintenance = MaintenanceRequest::findOrFail($maintenance_id);
        $maintenance->maintenance_user_id = $userId;
        $maintenance->status = "in_progress";

        $maintenance->save();


        return redirect()->back()->with('success', 'User assigned successfully.');
    }




}
