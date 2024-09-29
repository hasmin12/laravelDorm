<?php

namespace App\DataTables;

use App\Models\Violation;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ViolationsDataTable extends DataTable
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
            ->editColumn('reported_at', function ($violation) {
                return $violation->reported_at ? $violation->reported_at->format('Y-m-d H:i:s') : 'N/A';
            })
            ->editColumn('status', function ($violation) {
                $statusClass = [
                    'pending' => 'warning',
                    'resolved' => 'success',
                    'dismissed' => 'danger'
                ][$violation->status];
                return '<span class="badge bg-' . $statusClass . '">' . ucfirst($violation->status) . '</span>';
            })
            ->addColumn('user_name', function ($violation) {
                return $violation->user ? $violation->user->name : 'N/A'; // Assuming you have a `name` field in the User model
            })
            ->addColumn('action', 'violations.action') // Ensure this view exists
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Violation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Violation::with('user')->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('violationsTable')
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
            ['data' => 'violation_name', 'name' => 'violation_name', 'title' => 'Violation Name'],
            ['data' => 'violation_type', 'name' => 'violation_type', 'title' => 'Violation Type'],

            ['data' => 'details', 'name' => 'details', 'title' => 'Details'],
            ['data' => 'penalty', 'name' => 'penalty', 'title' => 'Penalty'],

            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'reported_at', 'name' => 'reported_at', 'title' => 'Reported At'],
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
