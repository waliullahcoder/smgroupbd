<?php

namespace App\DataTables;

use App\Models\LiftingReturnList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LiftingReturnHistoryDataTable extends DataTable
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
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->return->date));
            })
            ->addColumn('product_name_code', function ($row) {
                return $row->product->name . '(' . (request('product_type') == 'Consumer' || is_null(request('product_type')) ? $row->product->code : $row->variant->sku) . ')';
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LiftingReturnList $model): QueryBuilder
    {
        $query = $model->with(['return', 'product', 'variant', 'lifting_product', 'vendor', 'store']);

        $vendor_ids = request('vendor_id');
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $category_ids = request('category_id');
        $store_id = request('store_id');
        $product_ids = request('product_id');
        $product_type = request('product_type');

        $query->where('product_type', $product_type ?? 'Consumer');
        if (!empty($vendor_ids)) {
            $query->whereHas('return', function ($squery) use ($vendor_ids) {
                $squery->whereIn('vendor_id', $vendor_ids);
            });
        }
        if (!empty($category_ids)) {
            $query->whereHas('product', function ($squery) use ($category_ids) {
                $squery->whereIn('category_id', $category_ids);
            });
        }
        if (!empty($store_id)) {
            $query->where('store_id', $store_id);
        }
        if (!empty($product_ids)) {
            $query->whereIn('product_id', $product_ids);
        }
        $query->whereHas('return', function ($squery) use ($start_date, $end_date) {
            $squery->whereNull('deleted_at')->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        });
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
                'data'      => 'date',
                'name'      => 'date',
                'title'     => 'Date',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'return.return_no',
                'name'      => 'return.return_no',
                'title'     => 'Return No.',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'vendor.name',
                'name'      => 'vendor.name',
                'title'     => 'Vendor',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.category.name',
                'name'      => 'product.category.name',
                'title'     => 'Product Category',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product_name_code',
                'name'      => 'product_name_code',
                'title'     => 'Product(' . (request('product_type') == 'Consumer' || is_null(request('product_type')) ? 'Code' : 'Variant') . ')',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'qty',
                'name'      => 'qty',
                'title'     => 'Qty',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'lifting_price',
                'name'      => 'lifting_price',
                'title'     => 'Rate',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'amount',
                'name'      => 'amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'lifting_return_history_' . date('d_m_Y_h_i_s_A');
    }
}
