<?php

namespace App\DataTables;

use App\Models\CollectionHistory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollectionHistoryDataTable extends DataTable
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
                return date('d-m-Y', strtotime($row->date));
            })
            ->addColumn('sum_amount', function ($row) {
                $client_id = request('client_id');
                $collection_type = request('collection_type');
                $staff_id = request('staff_id');
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');

                $query = CollectionHistory::query();
                if (!is_null($collection_type)) {
                    $query->where('collection_type', $collection_type);
                }
                if (!is_null($client_id)) {
                    $query->whereIn('client_id', $client_id);
                }
                if (!is_null($staff_id)) {
                    $query->whereIn('staff_id', $staff_id);
                }
                $amount = $query->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
                return number_format($amount, 2, '.', ',');
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CollectionHistory $model): QueryBuilder
    {
        $query = $model->query();
        $report_type = request('report_type');
        $client_id = request('client_id');
        $collection_type = request('collection_type');
        $staff_id = request('staff_id');
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');

        if (!is_null($collection_type)) {
            $query->where('collection_type', $collection_type);
        }
        if (!is_null($client_id)) {
            $query->whereIn('client_id', $client_id);
        }
        if (!is_null($staff_id)) {
            $query->whereIn('staff_id', $staff_id);
        }
        $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        if ($report_type == 'summary') {
            return $query->select('*', DB::raw('SUM(amount) as total_amount'))->groupBy('client_id');
        } else {
            return $query->orderBy('date', 'desc');
        }
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
                    var total_amount = 0;
                    data.forEach(function(item, index){
                        total_amount = item.sum_amount;
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
        $history = [
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
                'data'      => 'client_name',
                'name'      => 'client_name',
                'title'     => 'Client Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'staff_name',
                'name'      => 'staff_name',
                'title'     => 'Employee Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'payment_no',
                'name'      => 'payment_no',
                'title'     => 'Payment No',
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
                'footer'    => '<span id="total_amount"></span>',
            ]),
        ];

        $summary = [
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
                'data'      => 'area_name',
                'name'      => 'area_name',
                'title'     => 'Area',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'territory_name',
                'name'      => 'territory_name',
                'title'     => 'Territory',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'client_category_name',
                'name'      => 'client_category_name',
                'title'     => 'Client Type',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'client_name',
                'name'      => 'client_name',
                'title'     => 'Client Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_amount"></span>',
            ]),
        ];

        if (request('report_type') == 'summary') {
            return $summary;
        } else {
            return $history;
        }
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'collection_history_' . date('d_m_Y_h_i_s_A');
    }
}
