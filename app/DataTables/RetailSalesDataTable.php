<?php

namespace App\DataTables;

use App\Models\RetailSaleList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RetailSalesDataTable extends DataTable
{
    protected $summaryTotals;

    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // Calculate summary totals (fetch once and store)
        $this->summaryTotals = RetailSaleList::whereHas('sales', function ($q) {
            $start_date = request('start_date') ? date('Y-m-d', strtotime(request('start_date'))) : date('Y-m-d');
            $end_date = request('end_date') ? date('Y-m-d', strtotime(request('end_date'))) : date('Y-m-d');
            $q->whereBetween('date', [$start_date, $end_date]);

            if (request('staff_id')) {
                $q->where('staff_id', request('staff_id'));
            }
        })->whereHas('product', function ($query) {
            if (request('category_id')) {
                $query->whereIn('category_id', request('category_id'));
            }
        })
            ->select(
                DB::raw('SUM(amount - returned_amount) as total_amount'),
                DB::raw('SUM(qty - returned_qty) as total_qty'),
                DB::raw('SUM(COALESCE(product_discount, 0) * (COALESCE(qty, 0) - COALESCE(returned_qty, 0))) as total_product_discount'),
                DB::raw('SUM(discount) as total_discount')
            )->first();

        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('total_amount', fn($row) => number_format($row->total_amount, 2))
            ->editColumn('total_product_discount', fn($row) => number_format($row->total_product_discount, 2))
            ->editColumn('total_discount', fn($row) => number_format($row->total_discount, 2))
            ->addColumn('product.name', fn($row) => optional($row->product)->name)
            ->addColumn('ttotal_amount', fn() => number_format($this->summaryTotals->total_amount ?? 0, 2))
            ->addColumn('ttotal_product_discount', fn() => number_format($this->summaryTotals->total_product_discount ?? 0, 2))
            ->addColumn('ttotal_discount', fn() => number_format($this->summaryTotals->total_discount ?? 0, 2))
            ->setRowId('product_id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RetailSaleList $model): QueryBuilder
    {
        $start_date = request('start_date') ? date('Y-m-d', strtotime(request('start_date'))) : date('Y-m-d');
        $end_date = request('end_date') ? date('Y-m-d', strtotime(request('end_date'))) : date('Y-m-d');

        $query = $model->with(['product']);
        $query->whereHas('product', function ($query) {
            if (request('category_id')) {
                $query->whereIn('category_id', request('category_id'));
            }
        });
        if (request('product_id')) {
            $query->where('product_id', request('product_id'));
        }

        $query->whereHas('sales', function ($q) use ($start_date, $end_date) {
            $q->whereBetween('date', [$start_date, $end_date]);

            if (request('staff_id')) {
                $q->where('staff_id', request('staff_id'));
            }
        })
            ->select(
                'product_id',
                DB::raw('SUM(amount - returned_amount) as total_amount'),
                DB::raw('SUM(qty - returned_qty) as total_qty'),
                DB::raw('SUM(COALESCE(product_discount, 0) * (COALESCE(qty, 0) - COALESCE(returned_qty, 0))) as total_product_discount'),
                DB::raw('SUM(discount) as total_discount')
            )
            ->groupBy('product_id');

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
                'buttons' => [
                    Button::make('reload'),
                    [
                        'extend' => 'excel',
                        'text'   => '<i class="fal fa-file-spreadsheet"></i> Excel',
                    ],
                    [
                        'text'      => '<i class="fal fa-file-pdf"></i> Print',
                        'className' => 'getPdf',
                    ],
                ],
                'responsive' => true,
                'drawCallback' => 'function() {
                    let data = this.api().ajax.json().data;
                    if (data.length > 0) {
                        $("#total_amount").html(data[0].ttotal_amount);
                        $("#total_discount").html(data[0].ttotal_discount);
                        $("#total_product_discount").html(data[0].ttotal_product_discount);
                    } else {
                        $("#total_amount").html(0);
                        $("#total_discount").html(0);
                        $("#total_product_discount").html(0);
                    }
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
                'data'      => 'DT_RowIndex',
                'name'      => 'DT_RowIndex',
                'title'     => 'SL#',
                'orderable' => false,
                'searchable' => false,
                'className' => 'text-center',
                'width'     => '30',
            ]),
            Column::make([
                'data'          => 'product.name',
                'name'          => 'product.name',
                'title'         => 'Product',
                'defaultContent' => '',
                'class'         => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_qty',
                'name'      => 'total_qty',
                'title'     => 'Total Qty',
                'class'     => 'text-center',
                'footer'    => '<div class="text-end">Total</div>',
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Total Amount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_amount"></span>',
            ]),
            Column::make([
                'data'      => 'total_product_discount',
                'name'      => 'total_product_discount',
                'title'     => 'Product Discount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_product_discount"></span>',
            ]),
            Column::make([
                'data'      => 'total_discount',
                'name'      => 'total_discount',
                'title'     => 'Discount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_discount"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'retail_sales_report_' . date('d_m_Y_h_i_s_A');
    }
}
