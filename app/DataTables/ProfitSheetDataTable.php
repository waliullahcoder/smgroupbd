<?php

namespace App\DataTables;

use App\Models\InvestorProfitList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProfitSheetDataTable extends DataTable
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
    public function query(InvestorProfitList $model): QueryBuilder
    {
        $query = $model->with(['parent', 'investor', 'product']);

        $investor_id = request('investor_id');
        if (!empty($investor_id)) {
            $query->where('investor_id', $investor_id);
        }

        $month = request('month');
        if (!empty($month)) {
            $query->whereHas('parent', function ($q) use ($month) {
                $q->where('month', $month);
            });
        }

        $year = request('year');
        if (!empty($year)) {
            $query->whereHas('parent', function ($q) use ($year) {
                $q->where('year', $year);
            });
        }
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
                    var total_profit = 0;
                    var total_investor_part = 0;
                    var total_share = 0;
                    var total_individual_share = 0;
                    var total_amount = 0;
                    data.forEach(function(item, index){
                        total_profit += +item.total_profit;
                        total_investor_part += +item.investor_part;
                        total_share += +item.total_share;
                        total_individual_share += +item.individual_share;
                        total_amount += +item.amount;
                    });
                    $("#total_profit").html(total_profit);
                    $("#total_investor_part").html(total_investor_part);
                    $("#total_share").html(total_share);
                    $("#total_individual_share").html(total_individual_share);
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
                'data'      => 'parent.month',
                'name'      => 'parent.month',
                'title'     => 'Month',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'parent.year',
                'name'      => 'parent.year',
                'title'     => 'Year',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'investor.name',
                'name'      => 'investor.name',
                'title'     => 'Investor Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_profit',
                'name'      => 'total_profit',
                'title'     => 'Product Profit',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_profit"></span>',
            ]),
            Column::make([
                'data'      => 'profit_percentage',
                'name'      => 'profit_percentage',
                'title'     => 'Profit %',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'investor_part',
                'name'      => 'investor_part',
                'title'     => 'Investor Part',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_investor_part"></span>',
            ]),
            Column::make([
                'data'      => 'total_share',
                'name'      => 'total_share',
                'title'     => 'Total Share',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_share"></span>',
            ]),
            Column::make([
                'data'      => 'individual_share',
                'name'      => 'individual_share',
                'title'     => 'Individual Share',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_individual_share"></span>',
            ]),
            Column::make([
                'data'      => 'amount',
                'name'      => 'amount',
                'title'     => 'Per Share',
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
        return 'Profit_sheet_' . date('d_m_Y_h_i_s_A');
    }
}
