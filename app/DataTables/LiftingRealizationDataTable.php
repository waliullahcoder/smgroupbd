<?php

namespace App\DataTables;

use App\Models\Vendor;
use App\Services\LiftingRealization\LiftingRealization;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LiftingRealizationDataTable extends DataTable
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
            ->addColumn('previousBalance', function ($row) {
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getPreviousBalance($row->id, $year);
            })
            ->addColumn('year_liftings', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getYearlyInfo($row->id, $year, $month)['lifting'];
            })
            ->addColumn('year_payments', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getYearlyInfo($row->id, $year, $month)['payment'];
            })
            ->addColumn('year_return', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getYearlyInfo($row->id, $year, $month)['return'];
            })
            ->addColumn('year_balance', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getYearlyInfo($row->id, $year, $month)['balance'];
            })
            ->addColumn('month_liftings', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getMonthlyInfo($row->id, $year, $month)['lifting'];
            })
            ->addColumn('month_payments', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getMonthlyInfo($row->id, $year, $month)['payment'];
            })
            ->addColumn('month_return', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getMonthlyInfo($row->id, $year, $month)['return'];
            })
            ->addColumn('month_balance', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getMonthlyInfo($row->id, $year, $month)['balance'];
            })
            ->addColumn('currentOutstanding', function ($row) {
                $month = !is_null(request('month')) ? request('month') : date('m');
                $year = !is_null(request('year')) ? request('year') : date('Y');
                return LiftingRealization::getPreviousBalance($row->id, $year) + LiftingRealization::getYearlyInfo($row->id, $year, $month)['balance'] + LiftingRealization::getMonthlyInfo($row->id, $year, $month)['balance'];
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vendor $model): QueryBuilder
    {
        $query = $model->where('status', 1);
        $vendor_id = request('vendor_id');
        if (!is_null($vendor_id)) {
            $query->whereIn('id', $vendor_id);
        }
        // $query->whereColumn('lifting', '>', 'payment')->orWhereColumn('lifting', '<', 'payment');
        return $query->orderBy('name', 'asc');
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
                'data'      => 'name',
                'name'      => 'name',
                'title'     => 'Vendor Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'previousBalance',
                'name'      => 'previousBalance',
                'title'     => 'Previous Year',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'year_liftings',
                'name'      => 'year_liftings',
                'title'     => date('Y', strtotime(!is_null(request('year')) ? request('year') : date('Y'))) . ' Lifting',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'year_payments',
                'name'      => 'year_payments',
                'title'     => date('Y', strtotime(!is_null(request('year')) ? request('year') : date('Y'))) . ' Payment',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'year_return',
                'name'      => 'year_return',
                'title'     => date('Y', strtotime(!is_null(request('year')) ? request('year') : date('Y'))) . ' Return',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'year_balance',
                'name'      => 'year_balance',
                'title'     => date('Y', strtotime(!is_null(request('year')) ? request('year') : date('Y'))) . ' Due',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'month_liftings',
                'name'      => 'month_liftings',
                'title'     => !is_null(request('month')) ? date('F', mktime(0, 0, 0, request('month'), 10)) : date('F', mktime(0, 0, 0, date('m'), 10)) . ' Lifting',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'month_payments',
                'name'      => 'month_payments',
                'title'     => !is_null(request('month')) ? date('F', mktime(0, 0, 0, request('month'), 10)) : date('F', mktime(0, 0, 0, date('m'), 10)) . ' Payment',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'month_return',
                'name'      => 'month_return',
                'title'     => !is_null(request('month')) ? date('F', mktime(0, 0, 0, request('month'), 10)) : date('F', mktime(0, 0, 0, date('m'), 10)) . ' Return',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'month_balance',
                'name'      => 'month_balance',
                'title'     => !is_null(request('month')) ? date('F', mktime(0, 0, 0, request('month'), 10)) : date('F', mktime(0, 0, 0, date('m'), 10)) . ' Due',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'currentOutstanding',
                'name'      => 'currentOutstanding',
                'title'     => 'Vendor Payable',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'lifting_realization_' . date('d_m_Y_h_i_s_A');
    }
}
