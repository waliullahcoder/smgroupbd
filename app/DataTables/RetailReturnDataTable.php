<?php

namespace App\DataTables;

use App\Models\RetailReturnList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RetailReturnDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $summary = RetailReturnList::whereHas('return', function ($query) {
            $start_date = !is_null(request('start_date')) ? date('Y-m-d', strtotime(request('start_date'))) : date('Y-m-d');
            $end_date = !is_null(request('end_date')) ? date('Y-m-d', strtotime(request('end_date'))) : date('Y-m-d');
            $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        });

        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->date));
            })
            ->addColumn('total_amount', function ($row) use ($summary) {
                return $summary->sum('amount');
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RetailReturnList $model): QueryBuilder
    {
        return $model->with(['product'])->whereHas('return', function ($query) {
            $start_date = !is_null(request('start_date')) ? date('Y-m-d', strtotime(request('start_date'))) : date('Y-m-d');
            $end_date = !is_null(request('end_date')) ? date('Y-m-d', strtotime(request('end_date'))) : date('Y-m-d');
            $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        })->groupBy('product_id')->select('*', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(qty) as total_qty'));
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('dataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->selectStyleSingle()
            ->parameters([
                'buttons'      => [
                    Button::make('reload'),
                    [
                        'extend'  => 'excel',
                        'text'    => '<i class="fal fa-file-spreadsheet"></i> Exel',
                    ],
                    [
                        'text'    => '<i class="fal fa-file-pdf"></i> Print',
                        'className' => 'getPdf',
                    ],
                ],
                'responsive' => true,
                'drawCallback' => 'function() {
                    let data = this.api().ajax.json().data;
                    var total_amount = 0;
                    data.forEach(function(item, index){
                        total_amount = item.total_amount;
                    });
                    $("#total_amount").html(total_amount)
                 }',
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make([
                'data'      => 'DT_RowIndex',
                'name'      => 'DT_RowIndex',
                'className' => 'text-center',
                'title'     => 'SL#',
                'orderable' => false,
                'searchable' => false,
                'width' => '30',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product',
                'defaultContent' => '',
            ]),
            Column::make([
                'data'      => 'total_qty',
                'name'      => 'total_qty',
                'title'     => 'Quantity',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Amount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_amount"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'retail_return_' . date('d_m_Y_h_i_s_A');
    }
}
