<?php

namespace App\DataTables;

use App\Models\AllSalesHistory;
use App\Models\SalesHistory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductSalesSummaryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('total_amount', function ($row) {
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $category_id = request('category_id');
                $store_id = request('store_id');
                $product_id = request('product_id');
                $query = SalesHistory::query();
                if (!is_null($category_id)) {
                    $query->whereIn('category_id', $category_id);
                }
                if (!is_null($product_id)) {
                    $query->whereIn('product_id', $product_id);
                }
                if (!is_null($store_id)) {
                    $query->where('store_id', $store_id);
                }
                $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                $total = $query->sum('amount');
                return number_format($total, 2, '.', ',');
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SalesHistory $model): QueryBuilder
    {
        $query = $model->query();
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $category_id = request('category_id');
        $store_id = request('store_id');
        $product_id = request('product_id');

        if (!is_null($category_id)) {
            $query->whereIn('category_id', $category_id);
        }
        if (!is_null($product_id)) {
            $query->whereIn('product_id', $product_id);
        }
        if (!is_null($store_id)) {
            $query->where('store_id', $store_id);
        }
        $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        return $query->select('*', DB::raw('SUM(qty) as group_qty'), DB::raw('SUM(amount) as group_amount'))->groupBy('product_id');
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
                    $("#total_amount").html(total_amount);
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
                'data'      => "DT_RowIndex",
                'name'      => "DT_RowIndex",
                'title'     => 'SL#',
                'orderable' => false,
                'searchable' => false,
                'width'     => '60',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'category_name',
                'name'      => 'category_name',
                'title'     => 'Category',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product_name',
                'name'      => 'product_name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product_code',
                'name'      => 'product_code',
                'title'     => 'Code',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'attribute_name',
                'name'      => 'attribute_name',
                'title'     => 'UOM',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'group_qty',
                'name'      => 'group_qty',
                'title'     => 'Qty',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'group_amount',
                'name'      => 'group_amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_amount"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductSalesSummary_' . date('YmdHis');
    }
}
