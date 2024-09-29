<?php

namespace App\DataTables;

use App\Models\HostelRoom;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class HostelRoomsDataTable extends DataTable
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
            ->editColumn('status', function ($query) {
                $status = 'warning';
                switch ($query->status) {
                    case 'available':
                        $status = 'warning';
                        break;
                    case 'occupied':
                        $status = 'primary';
                        break;
                    case 'unavailable':
                        $status = 'dark';
                        break;
                }
                return '<span class="text-capitalize badge bg-' . $status . '">' . $query->status . '</span>';
            })
            ->editColumn('price', function ($query) {
                return number_format($query->price, 2);
            })
            ->editColumn('rating', function ($query) {
                return number_format($query->getAverageRating(), 1); // Use average rating method
            })
            ->filterColumn('name', function ($query, $keyword) {
                return $query->where('name', 'like', "%{$keyword}%");
            })
            ->filterColumn('description', function ($query, $keyword) {
                return $query->where('description', 'like', "%{$keyword}%");
            })
            ->filterColumn('floorNumber', function ($query, $keyword) {
                return $query->where('floorNumber', 'like', "%{$keyword}%");
            })
            ->addColumn('action', 'admin.rooms.hostelaction')
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HostelRoom $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return HostelRoom::query()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('hostelRoomsTable')
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
            ['data' => 'name', 'name' => 'name', 'title' => 'Room Name'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
            ['data' => 'floorNumber', 'name' => 'floorNumber', 'title' => 'Floor Number'],
            ['data' => 'beds', 'name' => 'beds', 'title' => 'Beds'],
            ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
            ['data' => 'pax', 'name' => 'pax', 'title' => 'Pax'],
            ['data' => 'rating', 'name' => 'rating', 'title' => 'Rating'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            // ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];
    }
}
