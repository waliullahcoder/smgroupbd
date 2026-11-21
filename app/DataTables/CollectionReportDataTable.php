<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollectionReportDataTable extends DataTable
{
    /**
     * Build DataTable.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('date', function ($row) {
                return $row->collected_at
                    ? date('d-m-Y', strtotime($row->collected_at))
                    : '';
            })

            ->setRowId('id');
    }

    /**
     * Get query source.
     */
    public function query(Order $model): QueryBuilder
    {
        $start_date = request('start_date')
            ? date('Y-m-d', strtotime(request('start_date')))
            : date('Y-m-d');

        $end_date = request('end_date')
            ? date('Y-m-d', strtotime(request('end_date')))
            : date('Y-m-d');

        $query = $model->newQuery()
            ->with('store')
            ->whereDate('collected_at', '>=', $start_date)
            ->whereDate('collected_at', '<=', $end_date)
            ->where('collected', 1);

        if (request()->filled('delivery_man_id')) {
            $query->where('delivery_man_id', request('delivery_man_id'));
        }

        if (request()->filled('store_id')) {
            $query->where('store_id', request('store_id'));
        }

        return $query->orderBy('collected_at', 'desc');
    }

    /**
     * HTML Builder.
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

                'buttons' => [

                    Button::make('reload'),

                    [
                        'extend' => 'excel',
                        'text' => '<i class="fal fa-file-spreadsheet"></i> Excel',
                        'footer' => true,
                    ],

                    [
                        'text' => '<i class="fal fa-file-pdf"></i> Print',
                        'className' => 'getPdf',
                    ],

                ],

                'responsive' => true,

                'processing' => true,

                'serverSide' => true,

                'drawCallback' => 'function() {

                    let api = this.api();

                    let total_subtotal = 0;
                    let total_discount = 0;
                    let total_shipping = 0;
                    let total = 0;

                    api.rows({ search: "applied" }).data().each(function(item) {

                        total_subtotal += parseFloat(item.sub_total) || 0;
                        total_discount += parseFloat(item.discount) || 0;
                        total_shipping += parseFloat(item.shipping_charge) || 0;
                        total += parseFloat(item.due) || 0;

                    });

                    $("#total_subtotal").html(total_subtotal.toFixed(2));
                    $("#total_discount").html(total_discount.toFixed(2));
                    $("#total_shipping").html(total_shipping.toFixed(2));
                    $("#total").html(total.toFixed(2));

                }',

            ]);
    }

    /**
     * Columns.
     */
    public function getColumns(): array
    {
        return [

            Column::make([
                'data' => 'date',
                'name' => 'collected_at',
                'title' => 'Collection Date',
                'orderable' => false,
                'searchable' => false,
            ]),

            Column::make([
                'data' => 'invoice',
                'name' => 'invoice',
                'title' => 'Invoice',
                'class' => 'text-nowrap',
            ]),

            Column::make([
                'data' => 'user_name',
                'name' => 'user_name',
                'title' => 'Customer Name',
                'class' => 'text-nowrap',
            ]),

            Column::make([
                'data' => 'user_phone',
                'name' => 'user_phone',
                'title' => 'Phone',
                'class' => 'text-nowrap',
            ]),

            Column::make([
                'data' => 'store.name',
                'name' => 'store.name',
                'title' => 'Store',
                'class' => 'text-nowrap',
                'defaultContent' => '',
            ]),

            Column::make([
                'data' => 'sub_total',
                'name' => 'sub_total',
                'title' => 'Product Amount',
                'class' => 'text-center',
                'footer' => '<span id="total_subtotal">0.00</span>',
            ]),

            Column::make([
                'data' => 'discount',
                'name' => 'discount',
                'title' => 'Discount',
                'class' => 'text-center',
                'footer' => '<span id="total_discount">0.00</span>',
            ]),

            Column::make([
                'data' => 'shipping_charge',
                'name' => 'shipping_charge',
                'title' => 'Shipping Charge',
                'class' => 'text-center',
                'footer' => '<span id="total_shipping">0.00</span>',
            ]),

            Column::make([
                'data' => 'due',
                'name' => 'due',
                'title' => 'Total Amount',
                'class' => 'text-center',
                'footer' => '<span id="total">0.00</span>',
            ]),

        ];
    }

    /**
     * Export filename.
     */
    protected function filename(): string
    {
        return 'collection_report_' . date('d_m_Y_h_i_s_A');
    }
}