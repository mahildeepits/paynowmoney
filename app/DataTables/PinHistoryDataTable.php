<?php

namespace App\DataTables;

use App\Models\Epin;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PinHistoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('joining_kit',function(Epin $epin){
                return $epin->joining_kit_rel->kit_name;
            })
            ->editColumn('pin_no', function(Epin $epin){
                return $epin->pin_no;
                // return substr($epin->pin_no,0,2).'*********';
            })
            ->editColumn('transfer_from', function(Epin $epin){
                if($epin->transfer_from === null){
                    return 'Admin';
                }else{
                    return $epin->pin_trasnfer_from_rel->name;
                }
            })
            ->editColumn('used_by', function(Epin $epin){
                if($epin->used_by === null){
                    return 'N/A';
                }else{
                    return $epin->used_by_rel->member_id;
                }
            })
            ->editColumn('used_at', function(Epin $epin){
                if($epin->used_at === null){
                    return 'N/A';
                }else{
                    return $epin->used_at;
                }
            })
            ->addColumn('action', 'pinhistory.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Epin $model): QueryBuilder
    {
        $user = \Auth::guard('member')->user();
        $query = $model->where('transfer_to',$user->id)->newQuery();
        if($this->from_date){
            $query->where(\DB::raw('date(transferred_at)'),'>=',$this->from_date);
        }
        if($this->to_date){
            $query->where(\DB::raw('date(transferred_at)'),'<=',$this->to_date);
        }
        if($this->joining_kit){
            $query->where('joining_kit',$this->joining_kit);
        }
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pinhistory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row"<"col-md-12 text-center"B><"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::raw([
                            'extend' =>  'copy',
                            'className'=> 'btn-sm btn-info',
                            'header'=> false,
                            'footer'=> true,
                        ]),
                        Button::raw([
                            'extend' => 'csv',
                            'className' => 'btn-sm btn-success',
                            'header' => false,
                            'footer' => true,
                        ]),
                        Button::raw([
                            'extend' =>  'excel',
                            'className' =>  'btn-sm btn-warning',
                            'header' =>  false,
                            'footer' =>  true,
                        ]),
                        Button::raw([
                            'extend' => 'pdf',
                            'className' => 'btn-sm btn-primary',
                            'header' => false,
                            'footer' => true,
                        ]),
                        Button::raw([
                            'extend' => 'print',
                            'className' => 'btn-sm btn-danger',
                            'header' => true,
                            'footer' => false,
                            'orientation' => 'landscape',
                            'exportOptions' => [
                                // columns: ':visible',
                                'stripHtml' => false
                            ]
                        ])
                    ]);

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('joining_kit'),
            Column::make('pin_no')->addClass('text-center'),
            Column::make('transfer_from')->addClass('text-center'),
            Column::make('used_by')->addClass('text-center'),
            Column::make('used_at'),
            Column::make('transferred_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PinHistory_' . date('YmdHis');
    }
}
