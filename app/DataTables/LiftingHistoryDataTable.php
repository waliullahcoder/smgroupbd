<?php

namespace App\DataTables;

use App\Models\LiftingProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LiftingHistoryDataTable extends DataTable
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
            ->addColumn('lifting_date', function ($row) {
                return date('d-m-Y', strtotime($row->lifting->lifting_date));
            })
            ->addColumn('product_name_code', function ($row) {
                return $row->product->name . ' - (' . (request('product_type') == 'Consumer' || is_null(request('product_type')) ? $row->product->code : $row->variant->sku) . ')';
            })
            ->addColumn('total_qty', function ($row) {
                $vendor_ids = request('vendor_id');
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $category_ids = request('category_id');
                $store_id = request('store_id');
                $product_ids = request('product_id');
                $product_type = request('product_type');

                $query = LiftingProduct::with(['lifting', 'product', 'vendor']);
                $query->where('product_type', $product_type ?? 'Consumer');
                if (!is_null($category_ids)) {
                    $query->whereHas('product', function ($squery) use ($category_ids) {
                        $squery->whereIn('category_id', $category_ids);
                    });
                }
                if (!is_null($vendor_ids)) {
                    $query->whereHas('lifting', function ($squery) use ($vendor_ids) {
                        $squery->whereIn('vendor_id', $vendor_ids);
                    });
                }
                if (!is_null($product_ids)) {
                    $query->whereIn('product_id', $product_ids);
                }
                if (!is_null($store_id)) {
                    $query->where('store_id', $store_id);
                }
                $query->whereHas('lifting', function ($squery) use ($start_date, $end_date) {
                    $squery->where('lifting_date', '>=', $start_date)->where('lifting_date', '<=', $end_date);
                });
                return number_format($query->sum('qty'), 2, '.', ',');
            })
            ->addColumn('total_amount', function ($row) {
                $vendor_ids = request('vendor_id');
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $category_ids = request('category_id');
                $store_id = request('store_id');
                $product_ids = request('product_id');
                $product_type = request('product_type');

                $query = LiftingProduct::with(['lifting', 'product', 'vendor']);
                $query->where('product_type', $product_type ?? 'Consumer');
                if (!is_null($category_ids)) {
                    $query->whereHas('product', function ($squery) use ($category_ids) {
                        $squery->whereIn('category_id', $category_ids);
                    });
                }
                if (!is_null($vendor_ids)) {
                    $query->whereHas('lifting', function ($squery) use ($vendor_ids) {
                        $squery->whereIn('vendor_id', $vendor_ids);
                    });
                }
                if (!is_null($product_ids)) {
                    $query->whereIn('product_id', $product_ids);
                }
                if (!is_null($store_id)) {
                    $query->where('store_id', $store_id);
                }
                $query->whereHas('lifting', function ($squery) use ($start_date, $end_date) {
                    $squery->where('lifting_date', '>=', $start_date)->where('lifting_date', '<=', $end_date);
                });
                $total = $query->sum(DB::raw('total_amount - discount'));
                return number_format($total, 2, '.', ',');
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LiftingProduct $model): QueryBuilder
    {
        $query = $model->with(['lifting', 'vendor', 'product', 'product.category', 'variant', 'store']);

        $vendor_ids = request('vendor_id');
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $category_ids = request('category_id');
        $store_id = request('store_id');
        $product_ids = request('product_id');
        $product_type = request('product_type');
        $query->where('product_type', $product_type ?? 'Consumer');

        if (!is_null($vendor_ids)) {
            $query->whereHas('lifting', function ($squery) use ($vendor_ids) {
                $squery->whereIn('vendor_id', $vendor_ids);
            });
        }
        if (!is_null($category_ids)) {
            $query->whereHas('product', function ($squery) use ($category_ids) {
                $squery->whereIn('category_id', $category_ids);
            });
        }
        if (!is_null($store_id)) {
            $query->where('store_id', $store_id);
        }
        if (!is_null($product_ids)) {
            $query->whereIn('product_id', $product_ids);
        }
        $query->whereHas('lifting', function ($squery) use ($start_date, $end_date) {
            $squery->where('lifting_date', '>=', $start_date)->where('lifting_date', '<=', $end_date);
        });
        return $query->select('*', DB::raw('total_amount - discount as amount'));
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
                    var total_qty = 0;
                    var total_amount = 0;
                    data.forEach(function(item, index){
                        total_qty = item.total_qty;
                        total_amount = item.total_amount;
                    });
                    $("#total_qty").html(total_qty);
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
                'width'     => '40',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'lifting_date',
                'name'      => 'lifting_date',
                'title'     => 'Date',
                'class'     => 'text-nowrap',
                'orderable' => false,
            ]),
            Column::make([
                'data'      => 'lifting.voucher_no',
                'name'      => 'lifting.voucher_no',
                'title'     => 'Voucher No.',
                'class'     => 'text-nowrap',
                'orderable' => false,
            ]),
            Column::make([
                'data'      => 'vendor.name',
                'name'      => 'vendor.name',
                'title'     => 'Vendor',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'defaultContent' => '',
            ]),
            Column::make([
                'data'      => 'product.category.name',
                'name'      => 'product.category.name',
                'title'     => 'Product Category',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'defaultContent' => '',
            ]),
            Column::make([
                'data'      => 'product_name_code',
                'name'      => 'product_name_code',
                'title'     => 'Product(' . (request('product_type') == 'Consumer' || is_null(request('product_type')) ? 'Code' : 'Variant') . ')',
                'class'     => 'text-nowrap',
                'orderable' => false,
            ]),
            Column::make([
                'data'      => 'qty',
                'name'      => 'qty',
                'title'     => 'Qty',
                'class'     => 'text-nowrap text-end',
                'footer'    => '<span id="total_qty"></span>',
                'orderable' => false,
            ]),
            Column::make([
                'data'      => 'lifting_price',
                'name'      => 'lifting_price',
                'title'     => 'Rate',
                'class'     => 'text-nowrap text-end',
                'orderable' => false,
            ]),
            Column::make([
                'data'      => 'amount',
                'name'      => 'amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap text-end',
                'footer'    => '<span id="total_amount"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'lifting_history_' . date('d_m_Y_h_i_s_A');
    }
}
