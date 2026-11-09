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

class OnlineSalesHistoryDataTable extends DataTable
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
            ->addColumn('total_qty', function ($row) {
                $query = OrderProduct::with(['order', 'product']);
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $area_id = request('area_id');
                $product_id = request('product_id');
                $status = request('status');
                $created_by = request('created_by');
                $store_id = request('store_id');

                $query->whereHas('order', function ($q) use ($store_id, $status, $area_id, $created_by, $start_date, $end_date) {
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
            ->addColumn('total_subtotal', function ($row) {
                $query = OrderProduct::with(['order', 'product']);
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $area_id = request('area_id');
                $product_id = request('product_id');
                $status = request('status');
                $created_by = request('created_by');
                $store_id = request('store_id');

                $query->whereHas('order', function ($q) use ($store_id, $status, $area_id, $created_by, $start_date, $end_date) {
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
            ->addColumn('status', function ($row) {
                if (@$row->order->status == 'Cancelled') {
                    $status = '<span class="btn btn-xs text-white px-2 bg-danger" style="min-width: 80px;">Cancelled</span>';
                } elseif (@$row->order->status == 'Successed') {
                    $status = '<span class="btn btn-xs text-white px-2 bg-success" style="min-width: 80px;">Successed</span>';
                } else {
                    $status = '<span class="btn btn-xs text-white px-2  ';
                    if ($row->order->status == 'Pending') {
                        $status .= 'bg-primary';
                    } elseif ($row->order->status == 'Forward') {
                        $status .= 'bg-info';
                    } elseif ($row->order->status == 'On Route') {
                        $status .= 'bg-route';
                    } elseif ($row->order->status == 'Delivered') {
                        $status .= 'bg-delivered';
                    } elseif ($row->order->status == 'Collected') {
                        $status .= 'bg-success';
                    } elseif ($row->order->status == 'Returned') {
                        $status .= 'bg-danger';
                    }
                    $status .= '" style="min-width: 80px;">' . @$row->order->status . '</span>';
                }
                return $status;
            })
            ->addColumn('sales_by', function ($row) {
                return @$row->order->staff->name;
            })
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })->rawColumns(['status']);
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

        $query->whereHas('order', function ($q) use ($store_id, $status, $area_id, $created_by, $start_date, $end_date) {
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
        return $query->orderBy('id', 'desc');
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
                    var total_subtotal = 0;
                    data.forEach(function(item, index){
                        total_qty = item.total_qty;
                        total_subtotal = item.total_subtotal;
                    });
                    $("#total_qty").html(total_qty);
                    $("#total_subtotal").html(total_subtotal);
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
                'data'      => 'date',
                'name'      => 'date',
                'title'     => 'Date',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'order.invoice',
                'name'      => 'order.invoice',
                'title'     => 'Invoice',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'order.user_name',
                'name'      => 'order.user_name',
                'title'     => 'Customer Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'order.user_phone',
                'name'      => 'order.user_phone',
                'title'     => 'Customer Phone',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'quantity',
                'name'      => 'quantity',
                'title'     => 'Quantity',
                'class'     => 'text-nowrap text-center',
                'footer'    => '<span id="total_qty"></span>',
            ]),
            Column::make([
                'data'      => 'sale_price',
                'name'      => 'sale_price',
                'title'     => 'Rate',
                'class'     => 'text-nowrap text-center',
            ]),
            Column::make([
                'data'      => 'subtotal',
                'name'      => 'subtotal',
                'title'     => 'Amount',
                'class'     => 'text-nowrap text-center',
                'footer'    => '<span id="total_subtotal"></span>',
            ]),
            Column::make([
                'data'      => 'status',
                'name'      => 'status',
                'title'     => 'Status',
                'class'     => 'text-nowrap text-center',
            ]),
            Column::make([
                'data'      => 'sales_by',
                'name'      => 'sales_by',
                'title'     => 'Sales By',
                'class'     => 'text-nowrap text-center',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'online_sales_history_' . date('d_m_Y_h_i_s_A');
    }
}
