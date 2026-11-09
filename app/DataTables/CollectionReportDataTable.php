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
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->collected_at));
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        $start_date = !is_null(request('start_date')) ? date('Y-m-d', strtotime(request('start_date'))) : date('Y-m-d');
        $end_date = !is_null(request('end_date')) ? date('Y-m-d', strtotime(request('end_date'))) : date('Y-m-d');
        $query = $model->with('store')->where('collected_at', '>=', $start_date)->where('collected_at', '<=', $end_date);
        if (request('delivery_man_id')) $query->where('delivery_man_id', request('delivery_man_id'));
        if (request('store_id')) $query->where('store_id', request('store_id'));
        return $query->where('collected', 1);
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
                    var total_subtotal = 0;
                    var total_discount = 0;
                    var total_shipping = 0;
                    var total = 0;
                    data.forEach(function(item, index){
                        total_subtotal += +item.sub_total;
                        total_discount += +item.discount;
                        total_shipping += +item.shipping_charge;
                        total += +item.due;
                    });
                    $("#total_subtotal").html(total_subtotal);
                    $("#total_discount").html(total_discount);
                    $("#total_shipping").html(total_shipping);
                    $("#total").html(total);
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
                'data'      => 'date',
                'name'      => 'date',
                'title'     => 'Collection Date',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'invoice',
                'name'      => 'invoice',
                'title'     => 'Invoice',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'user_name',
                'name'      => 'user_name',
                'title'     => 'Customer Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'user_phone',
                'name'      => 'user_phone',
                'title'     => 'Phone',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'store.name',
                'name'      => 'store.name',
                'title'     => 'Store',
                'class'     => 'text-nowrap',
                'defaultContent'     => '',
            ]),
            Column::make([
                'data'      => 'sub_total',
                'name'      => 'sub_total',
                'title'     => 'Product Amount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_subtotal"></span>',
            ]),
            Column::make([
                'data'      => 'discount',
                'name'      => 'discount',
                'title'     => 'Discount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_discount"></span>',
            ]),
            Column::make([
                'data'      => 'shipping_charge',
                'name'      => 'shipping_charge',
                'title'     => 'Shipping Charge',
                'class'     => 'text-center',
                'footer'    => '<span id="total_shipping"></span>',
            ]),
            Column::make([
                'data'      => 'due',
                'name'      => 'due',
                'title'     => 'Total Amount',
                'class'     => 'text-center',
                'footer'    => '<span id="total"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'collection_report_' . date('d_m_Y_h_i_s_A');
    }
}
