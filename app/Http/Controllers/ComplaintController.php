<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ComplaintsDataTable;
use App\Helpers\AuthHelper;
use App\DataTables\UserComplaintsDataTable;
use Auth;

class ComplaintController extends Controller
{
    //
    public function complaints(ComplaintsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.complaints.index', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    public function mycomplaints()
    {
        $userId = Auth::user()->id;
        $dataTable = new UserComplaintsDataTable($userId);

        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $assets = ['data-table'];
        return $dataTable->render('residents.complaints', compact('pageTitle', 'assets'));
    }
}
