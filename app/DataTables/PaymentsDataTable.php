<?php

namespace App\DataTables;

use App\Models\Payment;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentsDataTable extends DataTable
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
            ->editColumn('payment_date', function ($payment) {
                return $payment->payment_date ? $payment->payment_date->format('Y-m-d H:i:s') : 'N/A';
            })
            ->editColumn('status', function ($payment) {
                $statusClass = $payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning');
                return '<span class="badge bg-'.$statusClass.'">'.ucfirst($payment->status).'</span>';
            })
            ->addColumn('user_name', function ($payment) {
                return $payment->user->first_name." ".$payment->user->last_name; // Assuming you have a `name` field in the User model
            })
            // ->addColumn('action', 'payments.action') // Ensure this view exists
            // ->rawColumns(['status', 'action']);

            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Payment::with('user')->orderBy('created_at', 'desc');
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
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'payment_date', 'name' => 'payment_date', 'title' => 'Payment Date'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->searchable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }
}
