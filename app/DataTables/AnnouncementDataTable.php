<?php

namespace App\DataTables;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AnnouncementDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'admin.features.announcement-action')
            ->editColumn('created_at',function($query){
                return $query->created_at->toDayDateTimeString() ?? 'N/A';
            })
            ->editColumn('image',function($query){
                if($query->image)
                    return "<a href='{$query->image_path}' target='_blank'><img src='{$query->image_path}' width='100' alt='image'></a>";
                return 'N/A';
            })
            ->editColumn('status', function($query) {
                return $query->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->rawColumns(['action','image','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Announcement $model): QueryBuilder
    {
        $query = $model->newQuery();
        $query->orderBy('created_at', 'desc');
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('anouncement-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                ->addClass('text-center'),
            Column::make('title'),
            Column::make('description')
                ->addClass('text-elipsis'),
            Column::make('status'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Announcement_' . date('YmdHis');
    }
}
