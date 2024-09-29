<?php

namespace App\DataTables;

use App\Models\LostAndFound;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LostAndFoundsDataTable extends DataTable
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
            ->editColumn('reported_at', function ($item) {
                return $item->reported_at ? $item->reported_at->format('Y-m-d H:i:s') : 'N/A';
            })
            ->editColumn('status', function ($item) {
                $statusClass = [
                    'lost' => 'warning',
                    'found' => 'success'
                ][$item->status];
                return '<span class="badge bg-' . $statusClass . '">' . ucfirst($item->status) . '</span>';
            })
            ->addColumn('owner', function ($payment) {
                return $payment->owner ? $payment->owner : '-'; // Assuming you have a `name` field in the User model
            })
            ->addColumn('contact_number', function ($payment) {
                return $payment->contact_number ? $payment->contact_number : '-';
            })
            ->addColumn('action', 'admin.lostandfounds.action') // Ensure this view exists
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LostAndFound $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return LostAndFound::with('user')->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('lostAndFoundsTable')
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
            ['data' => 'owner', 'name' => 'owner', 'title' => 'Owner'],
            ['data' => 'contact_number', 'name' => 'contact_number', 'title' => 'Contact Number'],

            ['data' => 'item_name', 'name' => 'item_name', 'title' => 'Item Name'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
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
