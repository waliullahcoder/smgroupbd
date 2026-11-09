<?php

namespace App\DataTables;

use App\Models\Order;
use DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CustomerListDataTable extends DataTable
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
                $q = Order::query();
                if (request('area_id')) {
                    $q->where('area_id', request('area_id'));
                }
                return number_format($q->count());
            })
            ->addColumn('total_amount', function ($row) {
                $q = Order::query();
                if (request('area_id')) {
                    $q->where('area_id', request('area_id'));
                }
                return number_format($q->sum('total'));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        $query = $model->with('area');
        if (request('area_id')) {
            $query->where('area_id', request('area_id'));
        }
        return $query->groupBy('user_phone')->select('*', DB::raw('SUM(total) as amount'), DB::raw('count(*) as total_count'))->orderBy('total_count', 'desc');
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
                'width'     => '20',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'user_name',
                'name'      => 'user_name',
                'title'     => 'Customer Name',
            ]),
            Column::make([
                'data'      => 'user_phone',
                'name'      => 'user_phone',
                'title'     => 'Phone',
            ]),
            Column::make([
                'data'      => 'area.name',
                'name'      => 'area.name',
                'title'     => 'Area',
                'defaultContent' => ''
            ]),
            Column::make([
                'data'      => 'shipping_address',
                'name'      => 'shipping_address',
                'title'     => 'Address',
            ]),
            Column::make([
                'data'      => 'total_count',
                'name'      => 'total_count',
                'title'     => 'Order Qty',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_qty"></span>',
            ]),
            Column::make([
                'data'      => 'amount',
                'name'      => 'amount',
                'title'     => 'Order Value',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_amount"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'customer_list_' . date('d_m_Y_h_i_s_A');
    }
}
