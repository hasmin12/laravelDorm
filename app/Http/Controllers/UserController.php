<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\DataTables\DormitoryResidentsDataTable;
use App\DataTables\HostelResidentsDataTable;

use App\Models\User;
use App\Models\DormitoryRoom;
use App\Models\DormitoryBed;

use App\Helpers\AuthHelper;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    public function DormitoryResidents(DormitoryResidentsDataTable $dataTable)
    {
        $rooms = DormitoryRoom::where('status',"available")->get();
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Dormitory Residents')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('dormitoryresidents.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.residents.dormitory', compact('pageTitle','auth_user','assets', 'headerAction','rooms'));
    }

    public function HostelResidents(HostelResidentsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Hostel Residents')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.residents.hostel', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    public function MaintenanceUsers()
    {
        $users = User::where('user_type',"maintenance user")->get();
        return response()->json($users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('users.form', compact('roles'));
    }

    public function CreateDormitoryResidents()
    {
        return view('admin.residents.dormitoryform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);

        $request['username'] = $request->username ?? stristr($request->email, "@", true) . rand(100,1000);

        $user = User::create($request->all());

        storeMediaFile($user,$request->profile_image, 'profile_image');

        $user->assignRole('user');

        // Save user Profile data...
        $user->userProfile()->create($request->userProfile);

        return redirect()->route('users.index')->withSuccess(__('message.msg_added',['name' => __('users.store')]));
    }

    public function StoreDormitoryResidents(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);

        $request['username'] = $request->username ?? stristr($request->email, "@", true) . rand(100,1000);

        $user = User::create($request->all());
        $user->phone_number = $request->userProfile['contactNumber'];
        $user->email_verified_at = now();
        $user->branch = "Dormitory";
        $user->save();

        storeMediaFile($user,$request->profile_image, 'profile_image');
        storeMediaFile($user,$request->userProfile['applicationForm'], 'applicationForm');

        storeMediaFile($user,$request->userProfile['cor'], 'cor');
        storeMediaFile($user,$request->userProfile['contract'], 'contract');
        storeMediaFile($user,$request->userProfile['validID'], 'validID');
        storeMediaFile($user,$request->userProfile['vaccineCard'], 'vaccineCard');


        $user->assignRole('user');

        // Save user Profile data...
        $user->userProfile()->create($request->userProfile);

        return redirect()->route('dormitoryresidents')->withSuccess(__('message.msg_added',['name' => __('users.store')]));
    }

    public function StoreHostelResidents(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);

        $request['username'] = $request->username ?? stristr($request->email, "@", true) . rand(100,1000);

        $user = User::create($request->all());
        $user->phone_number = $request->userProfile['contactNumber'];
        $user->email_verified_at = now();
        $user->branch = "Dormitory";
        $user->save();

        storeMediaFile($user,$request->profile_image, 'profile_image');
        storeMediaFile($user,$request->userProfile['applicationForm'], 'applicationForm');

        storeMediaFile($user,$request->userProfile['cor'], 'cor');
        storeMediaFile($user,$request->userProfile['contract'], 'contract');
        storeMediaFile($user,$request->userProfile['validID'], 'validID');
        storeMediaFile($user,$request->userProfile['vaccineCard'], 'vaccineCard');


        $user->assignRole('user');

        // Save user Profile data...
        $user->userProfile()->create($request->userProfile);

        return redirect()->route('hostelresidents')->withSuccess(__('message.msg_added',['name' => __('users.store')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $profileImage = getSingleMedia($data, 'profile_image');

        return view('users.profile', compact('data', 'profileImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;

        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        $profileImage = getSingleMedia($data, 'profile_image');
        return view('users.form', compact('data','id', 'roles', 'profileImage'));
    }

    public function EditDormitoryResidents($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;


        $profileImage = getSingleMedia($data, 'profile_image');

        return view('admin.residents.dormitoryform', compact('data','id', 'profileImage'));
    }

    public function EditHostelResidents($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;


        $profileImage = getSingleMedia($data, 'profile_image');

        return view('admin.residents.hostelform', compact('data','id', 'profileImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // dd($request->all());
        $user = User::with('userProfile')->findOrFail($id);

        $role = Role::find($request->user_role);
        if(env('IS_DEMO')) {
            if($role->name === 'admin'&& $user->user_type === 'admin') {
                return redirect()->back()->with('error', 'Permission denied');
            }
        }
        $user->assignRole($role->name);

        $request['password'] = $request->password != '' ? bcrypt($request->password) : $user->password;

        // User user data...
        $user->fill($request->all())->update();

        // Save user image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }

        // user profile data....
        $user->userProfile->fill($request->userProfile)->update();

        if(auth()->check()){
            return redirect()->route('users.index')->withSuccess(__('message.msg_updated',['name' => __('message.user')]));
        }
        return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));

    }

    public function UpdateDormitoryResidents(UserRequest $request, $id)
    {
        // dd($request->all());
        $user = User::with('userProfile')->findOrFail($id);

        $role = Role::find($request->user_role);
        if(env('IS_DEMO')) {
            if($role->name === 'admin'&& $user->user_type === 'admin') {
                return redirect()->back()->with('error', 'Permission denied');
            }
        }
        // $user->assignRole($role->name);

        $request['password'] = $request->password != '' ? bcrypt($request->password) : $user->password;

        // User user data...
        $user->fill($request->all())->update();

        // Save user image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }
        if (isset($request->userProfile['applicationForm'])) {
            $user->clearMediaCollection('applicationForm');
            $user->addMediaFromRequest('userProfile.applicationForm')->toMediaCollection('applicationForm');
        }

        if (isset($request->userProfile['contract'])) {
            $user->clearMediaCollection('contract');
            $user->addMediaFromRequest('userProfile.contract')->toMediaCollection('contract');
        }

        if (isset(($request->userProfile['cor']))) {
            $user->clearMediaCollection('cor');
            $user->addMediaFromRequest('userProfile.cor')->toMediaCollection('cor');
        }

        if (isset($request->userProfile['validID'])) {
            $user->clearMediaCollection('validID');
            $user->addMediaFromRequest('userProfile.validID')->toMediaCollection('validID');
        }

        if (isset($request->userProfile['vaccineCard'])) {
            $user->clearMediaCollection('vaccineCard');
            $user->addMediaFromRequest('userProfile.vaccineCard')->toMediaCollection('vaccineCard');
        }

        // user profile data....
        $user->userProfile->fill($request->userProfile)->update();

        if(auth()->check()){
            return redirect()->route('dormitoryresidents')->withSuccess(__('message.msg_updated',['name' => __('message.user')]));
        }
        return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));

    }

    public function UpdateHostelResidents(UserRequest $request, $id)
    {
        // dd($request->all());
        $user = User::with('userProfile')->findOrFail($id);

        $role = Role::find($request->user_role);
        if(env('IS_DEMO')) {
            if($role->name === 'admin'&& $user->user_type === 'admin') {
                return redirect()->back()->with('error', 'Permission denied');
            }
        }
        // $user->assignRole($role->name);

        $request['password'] = $request->password != '' ? bcrypt($request->password) : $user->password;

        // User user data...
        $user->fill($request->all())->update();

        // Save user image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }
        if (isset($request->userProfile['applicationForm'])) {
            $user->clearMediaCollection('applicationForm');
            $user->addMediaFromRequest('userProfile.applicationForm')->toMediaCollection('applicationForm');
        }

        if (isset($request->userProfile['contract'])) {
            $user->clearMediaCollection('contract');
            $user->addMediaFromRequest('userProfile.contract')->toMediaCollection('contract');
        }

        if (isset(($request->userProfile['cor']))) {
            $user->clearMediaCollection('cor');
            $user->addMediaFromRequest('userProfile.cor')->toMediaCollection('cor');
        }

        if (isset($request->userProfile['validID'])) {
            $user->clearMediaCollection('validID');
            $user->addMediaFromRequest('userProfile.validID')->toMediaCollection('validID');
        }

        if (isset($request->userProfile['vaccineCard'])) {
            $user->clearMediaCollection('vaccineCard');
            $user->addMediaFromRequest('userProfile.vaccineCard')->toMediaCollection('vaccineCard');
        }

        // user profile data....
        $user->userProfile->fill($request->userProfile)->update();

        if(auth()->check()){
            return redirect()->route('dormitoryresidents')->withSuccess(__('message.msg_updated',['name' => __('message.user')]));
        }
        return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $status = 'errors';
        $message= __('global-message.delete_form', ['form' => __('users.title')]);

        if($user!='') {
            $user->delete();
            $status = 'success';
            $message= __('global-message.delete_form', ['form' => __('users.title')]);
        }

        if(request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status,$message);

    }

    public function DeleteDormitoryResidents($id)
    {
        $user = User::findOrFail($id);
        $status = 'errors';
        $message= __('global-message.delete_form', ['form' => __('users.title')]);

        if($user!='') {
            $user->delete();
            $status = 'success';
            $message= __('global-message.delete_form', ['form' => __('users.title')]);
        }

        if(request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status,$message);

    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => 'inactive',
        ]);

        $bed = DormitoryBed::where('user_id',$user->id)->first();
        $bed->update([
            'user_id' => null,
            'status' => 'available',
        ]);

        return redirect()->back()->with('success', 'User Deactivated.');


    }

    public function DeleteHostelResidents($id)
    {
        $user = User::findOrFail($id);
        $status = 'errors';
        $message= __('global-message.delete_form', ['form' => __('users.title')]);

        if($user!='') {
            $user->delete();
            $status = 'success';
            $message= __('global-message.delete_form', ['form' => __('users.title')]);
        }

        if(request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status,$message);

    }
}
