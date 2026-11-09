<?php

namespace App\DataTables;

use App\Models\RetailSale;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InvoiceRetailSalesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $start_date = request('start_date') ? date('Y-m-d', strtotime(request('start_date'))) : date('Y-m-d');
        $end_date = request('end_date') ? date('Y-m-d', strtotime(request('end_date'))) : date('Y-m-d');

        $summary = RetailSale::query()
            ->whereBetween('date', [$start_date, $end_date])
            ->when(request('staff_id'), fn ($q) =>
                $q->where('staff_id', request('staff_id'))
            )
            ->whereHas('list.product', function ($q) {
                if (request('product_id')) {
                    $q->where('id', request('product_id'));
                }
                if (request('category_id')) {
                    $q->whereIn('category_id', request('category_id'));
                }
            })
            ->selectRaw('
                COALESCE(SUM(total_amount),0) as total_amount,
                COALESCE(SUM(discount),0) as total_discount,
                COALESCE(SUM(net_amount),0) as total_net_amount
            ')
            ->first();



        return (new EloquentDataTable($query))
            ->with([
                'summary' => $summary
            ])
            ->addIndexColumn()
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->date));
            })
            ->addColumn('products', function ($row) {
                $html = '';
                foreach ($row->list as $key => $item) {
                    if ($key > 0) {
                        $html .= '<br>';
                    }
                    $html .= $key + 1 . '. ' . @$item->product->name;
                }
                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['products']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RetailSale $model): QueryBuilder
    {
        $start_date = !is_null(request('start_date')) ? date('Y-m-d', strtotime(request('start_date'))) : date('Y-m-d');
        $end_date = !is_null(request('end_date')) ? date('Y-m-d', strtotime(request('end_date'))) : date('Y-m-d');
        $query = $model->with(['staff', 'list', 'list.product']);
        if (request('staff_id')) {
            $query->where('staff_id', request('staff_id'));
        }
        $query->whereHas('list.product', function ($q) {
            if (request('product_id')) {
                $q->where('id', request('product_id'));
            }
            if (request('category_id')) {
                $q->whereIn('category_id', request('category_id'));
            }
        });
        return $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
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
                'drawCallback' => 'function () {
                    let json = this.api().ajax.json();

                    $("#total_amount").html(json.summary.total_amount);
                    $("#total_discount").html(json.summary.total_discount);
                    $("#total_net_amount").html(json.summary.total_net_amount);
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
                'className' => 'text-center',
                'title'     => 'SL#',
                'orderable' => false,
                'searchable' => false,
                'width' => '30',
            ]),
            Column::make([
                'data'      => 'date',
                'name'      => 'date',
                'title'     => 'Date',
                'className' => 'text-nowrap',
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
                'data'      => 'client_name',
                'name'      => 'client_name',
                'title'     => 'Customer Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'client_phone',
                'name'      => 'client_phone',
                'title'     => 'Phone',
                'class'     => 'text-nowrap',
                'footer'    => '<div class="text-end">Total</div>',
            ]),
            Column::make([
                'data'      => 'products',
                'name'      => 'products',
                'title'     => 'Products',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Total Amount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_amount"></span>',
            ]),
            Column::make([
                'data'      => 'discount',
                'name'      => 'discount',
                'title'     => 'Discount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_discount"></span>',
            ]),
            Column::make([
                'data'      => 'net_amount',
                'name'      => 'net_amount',
                'title'     => 'Net Amount',
                'class'     => 'text-center',
                'footer'    => '<span id="total_net_amount"></span>',
            ]),
            Column::make([
                'data'      => 'staff.name',
                'name'      => 'staff.name',
                'title'     => 'Staff',
                'class'     => 'text-center',
                'defaultContent' => ''
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
