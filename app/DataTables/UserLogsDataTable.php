<?php

namespace App\DataTables;

use App\Models\Log;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserLogsDataTable extends DataTable
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
        parent::__construct();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('log_date', function ($log) {
                return $log->log_date ? $log->log_date->format('Y-m-d H:i:s') : 'N/A';
            })
            ->editColumn('date_of_leave', function ($log) {
                return $log->date_of_leave ? $log->date_of_leave->format('Y-m-d H:i:s') : 'N/A';
            })
            ->editColumn('expected_return', function ($log) {
                return $log->expected_return ? $log->expected_return->format('Y-m-d H:i:s') : 'N/A';
            })
            ->editColumn('returned_date', function ($log) {
                return $log->returned_date ? $log->returned_date->format('Y-m-d H:i:s') : 'N/A';
            })
            ->addColumn('user_name', function ($log) {
                return $log->user ? $log->user->first_name.' '.$log->user->last_name : 'N/A'; // Assuming you have a `name` field in the User model
            })
            ->addColumn('action', 'logs.action') // Ensure this view exists
            ->rawColumns(['action']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Log $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Log::with('user')->where('user_id', $this->userId)->orderBy('created_at', 'desc');// Filter by user ID
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('paymentsTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center"<"col-md-6" i><"col-md-6" p>><"clear">')
            ->parameters([
                "processing" => true,
                "autoWidth" => false,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'user_name', 'name' => 'user.name', 'title' => 'User'],
            ['data' => 'reason', 'name' => 'reason', 'title' => 'reason'],

            ['data' => 'gatepass', 'name' => 'gatepass', 'title' => 'Gatepass'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            // ['data' => 'log_date', 'name' => 'log_date', 'title' => 'Log Date'],
            ['data' => 'date_of_leave', 'name' => 'date_of_leave', 'title' => 'Date of Leave'],
            ['data' => 'expected_return', 'name' => 'expected_return', 'title' => 'Expected Return'],
            ['data' => 'returned_date', 'name' => 'returned_date', 'title' => 'Returned Date'],
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->searchable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }
}
