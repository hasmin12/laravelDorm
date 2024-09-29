<?php

namespace App\DataTables;

use App\Models\MaintenanceRequest;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MaintenanceRequestsDataTable extends DataTable
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
            ->editColumn('requested_at', function ($request) {
                return $request->requested_at ? $request->requested_at->format('m-d-Y') : 'N/A';
            })
            ->editColumn('status', function ($request) {
                $statusClass = [
                    'pending' => 'warning',
                    'in_progress' => 'info',
                    'completed' => 'success',
                    'canceled' => 'danger'
                ][$request->status];
                return '<span class="badge bg-' . $statusClass . '">' . ucfirst($request->status) . '</span>';
            })
            ->addColumn('user_name', function ($request) {
                return $request->user->first_name.' '.$request->user->last_name; // Assuming you have a `name` field in the User model
            })
            ->addColumn('action', 'admin.maintenancerequests.action') // Ensure this view exists
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MaintenanceRequest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return MaintenanceRequest::with('user')->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('maintenanceRequestsTable')
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
            ['data' => 'type', 'name' => 'type', 'title' => 'type'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'requested_at', 'name' => 'requested_at', 'title' => 'Requested At'],
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
