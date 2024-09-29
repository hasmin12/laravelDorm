<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\LostAndFoundsDataTable;
use App\Helpers\AuthHelper;
use App\Models\LostAndFound;
use Auth;
class LostAndFoundController extends Controller
{
    //
    public function lostandfounds(LostAndFoundsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Lost and Found')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        // $headerAction = '<a href="'.route('admin.addFoundItem').'" class="btn btn-sm btn-primary" role="button">Add Item</a>';
        return $dataTable->render('admin.lostandfounds.index', compact('pageTitle','auth_user','assets'));
    }

    public function viewLostItems()
    {
        $lostitems = LostAndFound::where('status',"lost")->get();
        $assets = ['chart', 'animation'];
        return view('residents.lostandfound', compact('assets','lostitems'));
    }

    public function addLostItem()
    {
        $lostitems = LostAndFound::all();
        $assets = ['chart', 'animation'];
        return view('residents.lostandfound', compact('assets','lostitems'));
    }

    public function addFoundItem()
    {
        $lostitems = LostAndFound::all();
        $assets = ['chart', 'animation'];
        return view('admin.lostandfounds.index', compact('assets','lostitems'));
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'owner' => 'max:255',
            'contact_number' => 'max:20',
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:lost,found',
            'reported_at' => 'required|date',
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        $lostAndFound = new LostAndFound($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/lost_and_found', 'public');
            $lostAndFound->image_path = $path;
        }

        $lostAndFound->save();

        return redirect()->back()->with('success', 'Item added successfully!');

    }

    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'owner' => 'max:255',
            'contact_number' => 'max:20',
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:lost,found',
            'reported_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $lostAndFound = LostAndFound::findOrFail($id);
        $lostAndFound->update($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/lost_and_found', 'public');
            $lostAndFound->image_path = $path;
        }

        $lostAndFound->save();
        return redirect()->back()->with('success', 'Item updated successfully!');

    }




}
