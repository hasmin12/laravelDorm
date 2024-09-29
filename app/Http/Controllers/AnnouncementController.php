<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\AnnouncementsDataTable;
use App\Helpers\AuthHelper;
use App\Models\Announcement;
use App\Models\Notification;

use Illuminate\Support\Facades\Storage;
class AnnouncementController extends Controller
{
    //
    public function announcements(AnnouncementsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Announcements')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.announcements.index', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required',

        ]);


        // Create the announcement
        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->message = $request->message;
        if($request->status=="published"){
            $announcement->published_at = now();
            $users = User::where('branch', "Dormitory")
                ->where('status', "active")
                ->where('user_type', "user")
                ->get();

            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => "Announcement",
                    'message' => "A new announcement has been published by Admin.",
                    'is_read' => 0,
                ]);
            }
        }
        $announcement->status = $request->status;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $announcement->image_path = $request->file('image')->store('announcements', 'public');
        }

        $announcement->save();
        return redirect()->back()->with('success', 'Announcement created successfully.');
    }

    public function update(Request $request,$id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request->title;
        $announcement->message = $request->message;
        $announcement->published_at = $request->published_at;
        if($request->status=="published"){
            $announcement->published_at = now();
            $users = User::where('branch', "Dormitory")
                ->where('status', "active")
                ->where('user_type', "user")
                ->get();

            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => "Announcement",
                    'message' => "A new announcement has been published by Admin.",
                    'is_read' => 0,
                ]);
            }
        }else{
            $announcement->published_at = null;
        }
        $announcement->status = $request->status;

        if ($request->hasFile('image')) {
            if ($announcement->image_path) {
                Storage::disk('public')->delete($announcement->image_path);
            }
            $announcement->image_path = $request->file('image')->store('announcements', 'public');
        }

        $announcement->save();

        return redirect()->back()->with('success', 'Announcement updated successfully.');
    }
}
