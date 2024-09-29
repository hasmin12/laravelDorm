<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\VisitorsDataTable;
use App\Helpers\AuthHelper;

class VisitorController extends Controller
{
    //
    public function visitors(VisitorsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.visitors.index', compact('pageTitle','auth_user','assets', 'headerAction'));
    }
}
