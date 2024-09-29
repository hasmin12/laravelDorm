<?php

namespace App\DataTables;

use App\Models\SleepLog; // Update this to the SleepLog model
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SleepLogsDataTable extends DataTable
{
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

            ->editColumn('sleep_date', function ($sleepLog) {
                return $sleepLog->sleep_date ? \Carbon\Carbon::parse($sleepLog->sleep_date)->format('m-d-Y') : 'N/A';
            })

            ->addColumn('user_name', function ($sleepLog) {
                return $sleepLog->user ? $sleepLog->user->first_name . ' ' . $sleepLog->user->last_name : 'N/A';
            })
            ->addColumn('action', 'sleep_logs.action') // Ensure this view exists
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SleepLog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return SleepLog::with('user')->orderBy('created_at', 'desc'); // Query the SleepLog model
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('sleepLogsTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')
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
            ['data' => 'sleep_date', 'name' => 'sleep_date', 'title' => 'Sleep Date'],
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->searchable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }
}
