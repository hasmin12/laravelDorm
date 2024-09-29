<?php

namespace App\DataTables;

use App\Models\Reservation;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReservationsDataTable extends DataTable
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
            ->editColumn('hostel_room.name', function ($query) {
                return $query->hostelRoom->name ?? '-';
            })
            ->editColumn('user.name', function ($query) {
                return $query->user->first_name.' '.$query->user->last_name ?? '-';
            })
            ->editColumn('check_in_date', function ($reservation) {
                return $reservation->check_in_date instanceof \DateTime ? $reservation->check_in_date->format('Y-m-d') : $reservation->check_in_date;
            })
            ->editColumn('check_out_date', function ($reservation) {
                return $reservation->check_out_date instanceof \DateTime ? $reservation->check_out_date->format('Y-m-d') : $reservation->check_out_date;
            })
            ->editColumn('total_price', function ($query) {
                return number_format($query->total_price, 2);
            })
            ->editColumn('status', function ($query) {
                $statusClass = 'warning';
                switch ($query->status) {
                    case 'confirmed':
                        $statusClass = 'success';
                        break;
                    case 'cancelled':
                        $statusClass = 'danger';
                        break;
                }
                return '<span class="badge bg-' . $statusClass . '">' . ucfirst($query->status) . '</span>';
            })
            ->addColumn('action', 'admin.reservations.action') // Assumes you have an action blade file
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Reservation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Reservation::with(['hostelRoom', 'user'])->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('reservationsTable')
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
            ['data' => 'hostel_room.name', 'name' => 'hostel_room.name', 'title' => 'Room Name'],
            ['data' => 'user.name', 'name' => 'user.name', 'title' => 'User'],
            ['data' => 'check_in_date', 'name' => 'check_in_date', 'title' => 'Check-in Date'],
            ['data' => 'check_out_date', 'name' => 'check_out_date', 'title' => 'Check-out Date'],
            ['data' => 'total_price', 'name' => 'total_price', 'title' => 'Total Price'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }
}
