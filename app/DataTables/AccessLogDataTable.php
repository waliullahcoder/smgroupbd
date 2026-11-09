<?php

namespace App\DataTables;

use App\Models\AccessLog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AccessLogDataTable extends DataTable
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
            ->addColumn('date_time', function ($row) {
                return date('d-m-Y h:i A', strtotime($row->date_time));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AccessLog $model): QueryBuilder
    {
        $query = $model->with(['user']);
        $user_id = request('user_id');
        $date_range = explode('to', request('date_range'));
        $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : NULL;
        $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : NULL;
        if (!is_null($user_id)) {
            $query->where('user_id', '>=', $user_id);
        }
        if (!is_null($start_date) && !is_null($end_date)) {
            $query->where('date_time', '>=', $start_date)->where('date_time', '<=', $end_date);
        }
        return $query->orderBy('date_time', 'desc');
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
                'data'      => 'date_time',
                'name'      => 'date_time',
                'title'     => 'Date Time',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'user.name',
                'name'      => 'user.name',
                'title'     => 'User',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'page',
                'name'      => 'page',
                'title'     => 'Page',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'action',
                'name'      => 'action',
                'title'     => 'Action',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'description',
                'name'      => 'description',
                'title'     => 'Details',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'access_log_' . date('d_m_Y_h_i_s_A');
    }
}
