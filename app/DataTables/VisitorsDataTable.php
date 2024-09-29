<?php

namespace App\DataTables;

use App\Models\Visitor;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VisitorsDataTable extends DataTable
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
            ->editColumn('visit_date', function ($visitor) {
                return $visitor->visit_date ? $visitor->visit_date->format('Y-m-d H:i:s') : 'N/A';
            })
            ->addColumn('user_name', function ($visitor) {
                return $visitor->user->first_name ? $visitor->user->first_name." ".$visitor->user->last_name : 'N/A'; // Assuming you have a `name` field in the User model
            })
            ->addColumn('action', 'visitors.action') // Ensure this view exists
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Visitor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Visitor::with('user')->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('visitorsTable')
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
            ['data' => 'visitor_name', 'name' => 'visitor_name', 'title' => 'Visitor Name'],
            ['data' => 'visitor_contact', 'name' => 'visitor_contact', 'title' => 'Contact'],
            ['data' => 'visit_purpose', 'name' => 'visit_purpose', 'title' => 'Purpose'],
            ['data' => 'visit_date', 'name' => 'visit_date', 'title' => 'Visit Date'],
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
}
