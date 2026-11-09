<?php

namespace App\DataTables;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OnlineSalesSummaryDataTable extends DataTable
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
            ->addColumn('all_total_qty', function ($row) {
                $query = OrderProduct::with(['order', 'product']);
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $area_id = request('area_id');
                $product_id = request('product_id');
                $status = request('status');
                $created_by = request('created_by');
                $store_id = request('store_id');

                $query->whereHas('order', function ($q) use ($status, $area_id, $created_by, $start_date, $end_date, $store_id) {
                    if(is_array(Auth::user()->stores) && count(Auth::user()->stores)){
                        $q->whereIn('store_id', Auth::user()->stores);
                    }
                    if ($store_id) {
                        $q->where('store_id', $store_id);
                    }
                    if (is_array($status) && count($status) > 0) {
                        $q->whereIn('status', $status);
                    }
                    if (is_array($area_id) && count($area_id) > 0) {
                        $q->whereIn('area_id', $area_id);
                    }
                    if (Auth::user()->hasRole('Moderator')) {
                        $q->where('created_by', Auth::user()->id);
                    } else {
                        if (is_array($created_by) && count($created_by) > 0) {
                            $q->whereIn('created_by', $created_by);
                        }
                    }
                    $q->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                });
                if (!is_null($product_id)) {
                    $query->whereIn('product_id', $product_id);
                }
                return number_format($query->sum('quantity'), 2);
            })
            ->addColumn('all_total_amount', function ($row) {
                $query = OrderProduct::with(['order', 'product']);
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $area_id = request('area_id');
                $product_id = request('product_id');
                $status = request('status');
                $created_by = request('created_by');
                $store_id = request('store_id');

                $query->whereHas('order', function ($q) use ($status, $area_id, $created_by, $start_date, $end_date, $store_id) {
                    if(is_array(Auth::user()->stores) && count(Auth::user()->stores)){
                        $q->whereIn('store_id', Auth::user()->stores);
                    }
                    if ($store_id) {
                        $q->where('store_id', $store_id);
                    }
                    if (is_array($status) && count($status) > 0) {
                        $q->whereIn('status', $status);
                    }
                    if (is_array($area_id) && count($area_id) > 0) {
                        $q->whereIn('area_id', $area_id);
                    }
                    if (Auth::user()->hasRole('Moderator')) {
                        $q->where('created_by', Auth::user()->id);
                    } else {
                        if (is_array($created_by) && count($created_by) > 0) {
                            $q->whereIn('created_by', $created_by);
                        }
                    }
                    $q->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                });
                if (!is_null($product_id)) {
                    $query->whereIn('product_id', $product_id);
                }
                return number_format($query->sum(DB::raw('subtotal - return_amount')), 2);
            })
            ->addColumn('qty_uom', function ($row) {
                return $row->total_qty . ' ' . @$row->product->attribute->name;
            })
            ->addColumn('avg_price', function ($row) {
                return number_format($row->total_amount / $row->total_qty, 2);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OrderProduct $model): QueryBuilder
    {
        $query = $model->with(['order', 'product']);
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $area_id = request('area_id');
        $product_id = request('product_id');
        $status = request('status');
        $created_by = request('created_by');
        $store_id = request('store_id');

        $query->whereHas('order', function ($q) use ($status, $area_id, $created_by, $start_date, $end_date, $store_id) {
            if(is_array(Auth::user()->stores) && count(Auth::user()->stores)){
                $q->whereIn('store_id', Auth::user()->stores);
            }
            if ($store_id) {
                $q->where('store_id', $store_id);
            }
            if (is_array($status) && count($status) > 0) {
                $q->whereIn('status', $status);
            }
            if (is_array($area_id) && count($area_id) > 0) {
                $q->whereIn('area_id', $area_id);
            }
            if (Auth::user()->hasRole('Moderator')) {
                $q->where('created_by', Auth::user()->id);
            } else {
                if (is_array($created_by) && count($created_by) > 0) {
                    $q->whereIn('created_by', $created_by);
                }
            }
            $q->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        });
        if (!is_null($product_id)) {
            $query->whereIn('product_id', $product_id);
        }
        return $query->groupBy('product_id')->select(['product_id', DB::raw('SUM(subtotal - return_amount) as total_amount'), DB::raw('SUM(order_products.quantity) as total_qty')]);
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
                'drawCallback' => 'function() {
                    let data = this.api().ajax.json().data;
                    var total_qty = 0;
                    var total_amount = 0;
                    data.forEach(function(item, index){
                        total_qty = item.all_total_qty;
                        total_amount = item.all_total_amount;
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
                'width'     => '60',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.code',
                'name'      => 'product.code',
                'title'     => 'Product Code',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'qty_uom',
                'name'      => 'qty_uom',
                'title'     => 'Quantity',
                'class'     => 'text-nowrap text-center',
                'footer'    => '<span id="total_qty"></span>',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'avg_price',
                'name'      => 'avg_price',
                'title'     => 'Avarage Rate',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap text-center',
                'footer'    => '<span id="total_amount"></span>',
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
        return 'online_sales_summary_' . date('d_m_Y_h_i_s_A');
    }
}
