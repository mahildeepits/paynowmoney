<?php

namespace App\DataTables;

use App\Models\AutoPool;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AutoPoolDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'admin.auto-pool.action')
            ->editColumn('created_at',function($query){
                return $query->created_at->toDayDateTimeString() ?? '';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AutoPool $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('autopool-table')
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    // //->dom('Bfrtip')
                    // ->orderBy(1)
                    // ->selectStyleSingle()
                    // ->buttons([
                    //     Button::make('excel'),
                    //     Button::make('csv'),
                    //     Button::make('pdf'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // ])
                    ;
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
            Column::make('id'),
            Column::make('name'),
            Column::make('count_4')->title('User/4 ( ₹ )'),
            Column::make('count_16')->title('User/16 ( ₹ )'),
            Column::make('count_64')->title('User/64 ( ₹ )'),
            Column::make('count_256')->title('User/256 ( ₹ )'),
            Column::make('count_1024')->title('User/1024 ( ₹ )'),
            Column::make('count_4096')->title('User/4096 ( ₹ )'),
            Column::make('count_16384')->title('User/16384 ( ₹ )'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AutoPool_' . date('YmdHis');
    }
}
