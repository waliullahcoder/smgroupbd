<?php

namespace App\DataTables;

use App\Models\DeliveryList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DeliveryStatementDataTable extends DataTable
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
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->sales->date));
            })
            ->addColumn('delivery_date', function ($row) {
                return date('d-m-Y', strtotime($row->delivery->date));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(DeliveryList $model): QueryBuilder
    {
        $query = $model->with(['sales', 'delivery']);

        $client_id = request('client_id');
        $date_range = explode('to', request('date_range'));
        $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : null;
        $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : null;

        if (!empty($client_id)) {
            $query->where('client_id', $client_id);
        }
        if (!is_null($start_date) && !is_null($end_date)) {
            $query->whereHas('delivery', function ($squery) use ($start_date, $end_date) {
                $squery->where('date', '>=', $start_date)->where('date', '<=', $end_date);
            });
        }
        return $query->latest('id');
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
                'data'      => 'delivery_date',
                'name'      => 'delivery_date',
                'title'     => 'Delivery Date',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'date',
                'name'      => 'date',
                'title'     => 'Invoice Date',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'sales.invoice',
                'name'      => 'sales.invoice',
                'title'     => 'Invoice',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'sales.total_amount',
                'name'      => 'sales.total_amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'delivery_statement_' . date('d_m_Y_h_i_s_A');
    }
}
