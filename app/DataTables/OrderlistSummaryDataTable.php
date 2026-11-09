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

class OrderlistSummaryDataTable extends DataTable
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
            ->addColumn('qty', function ($row) {
                return number_format($row->total_quantity, 2);
            })
            ->addColumn('tota_qty', function ($row) {
                return OrderProduct::whereHas('order', function ($q) {
                    if (Auth::user()->hasRole('Moderator')) {
                        $q->where('created_by', Auth::user()->id);
                    }
                    $date_range = explode('to', request('date_range'));
                    $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                    $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                    $q->where('date', '>=', $start_date)->where('date', '<=', $end_date);

                    if (request('store_id')) {
                        $q->where('store_id', request('store_id'));
                    }
                    if (request('area_id')) {
                        $q->where('area_id', request('area_id'));
                    }
                    if (request('created_by')) {
                        $q->where('created_by', request('created_by'));
                    }
                    if (request('status')) {
                        $q->where('status', request('status'));
                    }
                })->sum('quantity');
            })
            ->addColumn('amount', function ($row) {
                return number_format($row->total_subtotal, 2);
            })
            ->addColumn('tota_amount', function ($row) {
                return OrderProduct::whereHas('order', function ($q) {
                    if (Auth::user()->hasRole('Moderator')) {
                        $q->where('created_by', Auth::user()->id);
                    }
                    $date_range = explode('to', request('date_range'));
                    $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                    $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                    $q->where('date', '>=', $start_date)->where('date', '<=', $end_date);

                    if (request('store_id')) {
                        $q->where('store_id', request('store_id'));
                    }
                    if (request('area_id')) {
                        $q->where('area_id', request('area_id'));
                    }
                    if (request('created_by')) {
                        $q->where('created_by', request('created_by'));
                    }
                    if (request('status')) {
                        $q->where('status', request('status'));
                    }
                })->sum(DB::raw('subtotal - return_amount'));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(OrderProduct $model): QueryBuilder
    {
        $query = $model->with(['order', 'product']);
        $query->whereHas('order', function ($q) {
            if (Auth::user()->hasRole('Moderator')) {
                $q->where('created_by', Auth::user()->id);
            }
            $date_range = explode('to', request('date_range'));
            $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
            $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
            $q->where('date', '>=', $start_date)->where('date', '<=', $end_date);

            if (request('store_id')) {
                $q->where('store_id', request('store_id'));
            }
            if (request('area_id')) {
                $q->where('area_id', request('area_id'));
            }
            if (request('created_by')) {
                $q->where('created_by', request('created_by'));
            }
            if (request('status')) {
                $q->where('status', request('status'));
            }
        });
        return $query->groupBy('product_id')->select('*', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal - return_amount) as total_subtotal'));
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
                    [
                        'text'    => '<i class="fal fa-file-pdf"></i> Print Chalan',
                        'className' => 'getChalanPdf',
                    ],
                ],
                'responsive' => true,
                'pageLength' => 20,
                'drawCallback' => 'function() {
                    let data = this.api().ajax.json().data;
                    var tota_qty = 0;
                    var tota_amount = 0;
                    data.forEach(function(item, index){
                        tota_qty = item.tota_qty;
                        tota_amount = item.tota_amount;
                    });
                    $("#tota_qty").html(tota_qty);
                    $("#tota_amount").html(tota_amount);
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
                'width'     => '30',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
                'defaultContent' => ''
            ]),
            Column::make([
                'data'      => 'qty',
                'name'      => 'qty',
                'title'     => 'Quantity (KG)',
                'class'     => 'text-nowrap text-end',
                'footer'     => '<span id="tota_qty"></span>',
            ]),
            Column::make([
                'data'      => 'amount',
                'name'      => 'amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap text-end',
                'footer'     => '<span id="tota_amount"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'order_list_summary_' . date('d_m_Y_h_i_s_A');
    }
}
