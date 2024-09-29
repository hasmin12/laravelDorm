<?php

namespace App\DataTables;

use App\Models\Announcement;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AnnouncementsDataTable extends DataTable
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
            ->editColumn('published_at', function ($announcement) {
                return $announcement->published_at ? $announcement->published_at->format('Y-m-d H:i:s') : 'Not Published';
            })
            ->editColumn('status', function ($announcement) {
                $status = $announcement->status === 'published' ? 'success' : 'warning';
                return '<span class="badge bg-'.$status.'">'.ucfirst($announcement->status).'</span>';
            })
            ->addColumn('action', 'admin.announcements.action') // Ensure this view exists
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Announcement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Announcement::query()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('announcementsTable')
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
            ['data' => 'title', 'name' => 'title', 'title' => 'Title','className' => 'title-column',],
            [
                'data' => 'message',
                'name' => 'message',
                'title' => 'Message',
                'className' => 'message-column', // Add a custom class
            ],
            ['data' => 'published_at', 'name' => 'published_at', 'title' => 'Published At'],
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
