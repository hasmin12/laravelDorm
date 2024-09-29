<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\LogsDataTable;
use App\Helpers\AuthHelper;
use Auth;
use App\DataTables\UserLogsDataTable;
use App\DataTables\UserSleepLogsDataTable;

use App\DataTables\SleepLogsDataTable;
use App\Models\SleepLog;

class LogController extends Controller
{
    //
    public function logs(LogsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Logs')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.logs.index', compact('pageTitle','auth_user','assets'));
    }

    public function sleeplogs(SleepLogsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Sleep Logs')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        // dd(SleepLog::all());
        return $dataTable->render('admin.sleeplogs.index', compact('pageTitle','auth_user','assets'));
    }

    public function mylogs()
    {
        $userId = Auth::user()->id;
        $dataTable = new UserLogsDataTable($userId);

        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $assets = ['data-table'];
        return $dataTable->render('residents.logs', compact('pageTitle', 'assets'));
    }

    public function mysleeplogs()
    {
        $userId = Auth::user()->id;
        $dataTable = new UserSleepLogsDataTable($userId);

        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $assets = ['data-table'];
        return $dataTable->render('residents.sleeplogs', compact('pageTitle', 'assets'));
    }


}
