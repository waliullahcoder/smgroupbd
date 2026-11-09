<?php

namespace App\DataTables;

use App\Models\TransferProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransferLogDataTable extends DataTable
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
            ->addColumn('code_variant', function ($row) {
                if (is_null(request('product_type')) || request('product_type') == 'Consumer') {
                    return @$row->product->code;
                } else {
                    return @$row->variant->sku;
                }
            })
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->transfer->date));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TransferProduct $model): QueryBuilder
    {
        $query = $model->with(['transfer', 'product', 'variant']);

        $host_id = request('host_id');
        $destination_id = request('destination_id');
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $query->where('product_type', request('product_type') ?? 'Consumer');

        if (!is_null($start_date) && !is_null($end_date)) {
            $query->whereHas('transfer', function ($squery) use ($start_date, $end_date) {
                $squery->where('date', '>=', $start_date)->where('date', '<=', $end_date);
            });
        }
        $query->whereHas('transfer', function ($squery) use ($host_id, $destination_id) {
            if (!is_null($host_id)) {
                $squery->where('host_id', $host_id);
            }
            if (!is_null($destination_id)) {
                $squery->where('destination_id', $destination_id);
            }
        });
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
            ]),
            Column::make([
                'data'      => 'transfer.host.name',
                'name'      => 'transfer.host.name',
                'title'     => 'Host Store',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'transfer.destination.name',
                'name'      => 'transfer.destination.name',
                'title'     => 'Destination Store',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'transfer.transfer_no',
                'name'      => 'transfer.transfer_no',
                'title'     => 'Transfer No',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'code_variant',
                'name'      => 'code_variant',
                'title'     => 'Code / Variant',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'qty',
                'name'      => 'qty',
                'title'     => 'Qty',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'transfer_log_' . date('d_m_Y_h_i_s_A');
    }
}
