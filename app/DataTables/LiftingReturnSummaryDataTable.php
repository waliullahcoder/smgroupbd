<?php

namespace App\DataTables;

use App\Models\LiftingReturnList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LiftingReturnSummaryDataTable extends DataTable
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
            ->addColumn('product_name_code', function ($row) {
                return $row->product->name . '(' . (request('product_type') == 'Consumer' || is_null(request('product_type')) ? $row->product->code : $row->variant->sku) . ')';
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LiftingReturnList $model): QueryBuilder
    {
        $vendor_ids = request('vendor_id');
        $date_range = explode('to', request('date_range'));
        $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $category_ids = request('category_id');
        $store_id = request('store_id');
        $product_ids = request('product_id');
        $product_type = request('product_type');

        $query = $model->with(['return', 'product', 'variant', 'lifting_product', 'vendor', 'store'])->select(
            'lifting_return_lists.variant_id',
            'lifting_return_lists.product_id',
            'lifting_return_lists.vendor_id',
            DB::raw('SUM(lifting_return_lists.qty) as total_qty'),
            DB::raw('SUM(lifting_return_lists.lifting_price) as total_price')
        );
        $query->where('product_type', $product_type ?? 'Consumer');

        if (!empty($category_ids)) {
            $query->whereHas('product', function ($squery) use ($category_ids) {
                $squery->whereIn('category_id', $category_ids);
            });
        }
        if (!empty($vendor_ids)) {
            $query->whereIn('vendor_id', $vendor_ids);
        }
        if (!empty($product_ids)) {
            $query->whereIn('product_id', $product_ids);
        }
        if (!empty($store_id)) {
            $query->where('store_id', $store_id);
        }
        $query->whereHas('return', function ($squery) use ($start_date, $end_date) {
            $squery->whereNull('deleted_at')->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        });
        if ($product_type == 'Consumer' || is_null($product_type)) {
            return $query->groupBy('product_id');
        } else {
            return $query->groupBy('variant_id');
        }
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
                'title'     => 'Product name (' . (request('product_type') == 'Consumer' || is_null(request('product_type')) ? 'Code' : 'Variant') . ')',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'total_qty',
                'name'      => 'total_qty',
                'title'     => 'Qty',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'total_price',
                'name'      => 'total_price',
                'title'     => 'Amount',
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
        return 'lifting_return_summary_' . date('d_m_Y_h_i_s_A');
    }
}
