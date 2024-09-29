<?php

namespace App\DataTables;

use App\Models\Complaint;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ComplaintsDataTable extends DataTable
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
            ->editColumn('resolved_at', function ($complaint) {
                return $complaint->resolved_at ? $complaint->resolved_at->format('Y-m-d H:i:s') : 'N/A';
            })
            ->addColumn('user_name', function ($complaint) {
                return $complaint->user ? $complaint->user->first_name." ".$complaint->user->last_name  : 'N/A'; // Assuming you have a `name` field in the User model
            })
            ->addColumn('action', 'complaints.action') // Ensure this view exists
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Complaint $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Complaint::with('user')->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('complaintsTable')
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
            ['data' => 'complaint_details', 'name' => 'complaint_details', 'title' => 'Complaint Details'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'resolved_at', 'name' => 'resolved_at', 'title' => 'Resolved At'],
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
