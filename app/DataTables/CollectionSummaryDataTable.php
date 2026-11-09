<?php

namespace App\DataTables;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CollectionSummaryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Collection $model): QueryBuilder
    {
        $query = $model->with(['client', 'client.area', 'client.territory', 'client.client_category']);

        $collection_type = request('collection_type');
        $client_id = request('client_id');
        $staff_id = request('staff_id');
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');

        if (!empty($collection_type)) {
            $query->where('collection_type', $collection_type);
        }
        if (!empty($client_id)) {
            $query->whereIn('client_id', $client_id);
        }
        if (!empty($staff_id)) {
            $query->whereIn('created_by', $staff_id);
        }
        if (!is_null($start_date) && !is_null($end_date)) {
            $query->where('payment_date', '>=', $start_date)->where('payment_date', '<=', $end_date);
        }
        return $query->select('collections.client_id', DB::raw('SUM(collections.amount) as total_amount'))->groupBy('client_id');
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
                'data'      => 'client.area.name',
                'name'      => 'client.area.name',
                'title'     => 'Area',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'client.territory.name',
                'name'      => 'client.territory.name',
                'title'     => 'Territory',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'client.client_category.name',
                'name'      => 'client.client_category.name',
                'title'     => 'Client Type',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'client.name',
                'name'      => 'client.name',
                'title'     => 'Client Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
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
        return 'collection_summary_' . date('d_m_Y_h_i_s_A');
    }
}
