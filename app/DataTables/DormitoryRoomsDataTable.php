<?php

namespace App\DataTables;

use App\Models\DormitoryRoom;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DormitoryRoomsDataTable extends DataTable
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
                        $status = 'primary';
                        break;
                    case 'unavailable':
                        $status = 'dark';
                        break;

                }
                return '<span class="text-capitalize badge bg-' . $status . '">' . $query->status . '</span>';
            })
            ->editColumn('created_at', function ($query) {
                return date('Y/m/d', strtotime($query->created_at));
            })
            ->filterColumn('name', function ($query, $keyword) {
                return $query->where('name', 'like', "%{$keyword}%");
            })
            ->filterColumn('type', function ($query, $keyword) {
                return $query->where('type', 'like', "%{$keyword}%");
            })
            ->filterColumn('category', function ($query, $keyword) {
                return $query->where('category', 'like', "%{$keyword}%");
            })
            ->addColumn('action', 'admin.rooms.dormitoryaction')
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DormitoryRoom $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = DormitoryRoom::query()->orderBy('created_at', 'desc');
        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTable')
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
            ['data' => 'totalBed', 'name' => 'totalBed', 'title' => 'Total Beds'],
            ['data' => 'occupiedBeds', 'name' => 'occupiedBeds', 'title' => 'Occupied Beds'],
            ['data' => 'type', 'name' => 'type', 'title' => 'Type'],
            ['data' => 'category', 'name' => 'category', 'title' => 'Category'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];
    }
}
