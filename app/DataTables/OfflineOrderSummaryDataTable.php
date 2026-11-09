<?php

namespace App\DataTables;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OfflineOrderSummaryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OrderProduct $model): QueryBuilder
    {
        $query = $model->with(['product', 'order'])->select(
            'order_products.product_id',
            'order_products.order_id',
            'products.name as productName',
            DB::raw('SUM(order_products.quantity) as total_qty'),
        );
        $query->leftJoin('products', 'products.id', '=', 'order_products.product_id');
        $query->groupBy('product_id');
        $query->groupBy('productName');
        $query->groupBy('order_id');
        $query->where('delivered', 0)->whereHas('order', function ($q) {
            $q->where('order_type', 'offline');
        })->orderBy('productName', 'asc');
        return $query;
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
                'buttons'   => [
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
                'pageLength' => 20,
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
                'data'      => 'product.vendor.name',
                'name'      => 'product.vendor.name',
                'title'     => 'Vendor',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.category.name',
                'name'      => 'product.category.name',
                'title'     => 'Product Type',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_qty',
                'name'      => 'total_qty',
                'title'     => 'Order Qty',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'searchable' => false,
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'offline_order_summary_' . date('d_m_Y_h_i_s_A');
    }
}
