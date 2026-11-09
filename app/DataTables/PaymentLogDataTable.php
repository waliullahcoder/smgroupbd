<?php

namespace App\DataTables;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentLogDataTable extends DataTable
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
                return date('d-m-Y', strtotime($row->payment_date));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Collection $model): QueryBuilder
    {
        $query = $model->query();
        $client_id = Auth::user()->client->id;
        $query->where('client_id', $client_id);

        $collection_type = request('collection_type');
        $date_range = explode('to', request('date_range'));
        $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : NULL;
        $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : NULL;

        if (!empty($collection_type)) {
            $query->where('collection_type', $collection_type);
        }
        if (!is_null($start_date) && !is_null($end_date)) {
            $query->where('payment_date', '>=', $start_date)->where('payment_date', '<=', $end_date);
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-t');
            $query->where('payment_date', '>=', $start_date)->where('payment_date', '<=', $end_date);
        }
        return $query->orderBy('payment_date', 'desc');
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
                'data'      => 'payment_no',
                'name'      => 'payment_no',
                'title'     => 'Payment No',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'collection_type',
                'name'      => 'collection_type',
                'title'     => 'Collection Type',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'payment_type',
                'name'      => 'payment_type',
                'title'     => 'Pay Mode',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'amount',
                'name'      => 'amount',
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
        return 'payment_log_' . date('d_m_Y_h_i_s_A');
    }
}
