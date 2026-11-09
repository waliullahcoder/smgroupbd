<?php

namespace App\DataTables;

use App\Models\VendorPayment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VendorPaymentSummaryDataTable extends DataTable
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
            ->addColumn('total', function ($row) {
                $q = VendorPayment::with(['vendor']);
                $vendor_id = request('vendor_id');
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                if (!empty($vendor_id)) {
                    $q->whereIn('vendor_id', $vendor_id);
                }
                $total = $q->where('payment_date', '>=', $start_date)->where('payment_date', '<=', $end_date)->sum('amount');
                return number_format($total, 2, '.', '');
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VendorPayment $model): QueryBuilder
    {
        $query = $model->with(['vendor']);

        $vendor_id = request('vendor_id');
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        if (!empty($vendor_id)) {
            $query->whereIn('vendor_id', $vendor_id);
        }
        if (!is_null($start_date) && !is_null($end_date)) {
            $query->where('payment_date', '>=', $start_date)->where('payment_date', '<=', $end_date);
        }
        return $query->select(
            'vendor_payments.vendor_id',
            DB::raw('SUM(vendor_payments.amount) as total_amount'),
        )->groupBy('vendor_payments.vendor_id');
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
                'buttons'   => [
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
                    var total_amount = 0;
                    data.forEach(function(item, index){
                        total_amount = item.total;
                    });
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
                'data'      => 'vendor.name',
                'name'      => 'vendor.name',
                'title'     => 'Vendor Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Total Paid',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_amount"></span>',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'vendor_payment_summary_' . date('d_m_Y_h_i_s_A');
    }
}
