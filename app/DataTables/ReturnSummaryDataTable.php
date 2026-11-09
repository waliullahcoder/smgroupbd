<?php

namespace App\DataTables;

use App\Models\SalesReturnList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReturnSummaryDataTable extends DataTable
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
    public function query(SalesReturnList $model): QueryBuilder
    {
        $query = $model->with(['return', 'client', 'client.client_category', 'client.area', 'client.territory', 'product']);
        $category_id = request('category_id');
        $client_id = request('client_id');
        $product_id = request('product_id');
        $region_id = request('region_id');
        $area_id = request('area_id');
        $territory_id = request('territory_id');
        $report_type = request('report_type');

        $date_range = explode('to', request('date_range'));
        $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : NULL;
        $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : NULL;

        if (!is_null($region_id)) {
            $query->whereHas('client.area', function ($squery) use ($region_id) {
                $squery->where('region_id', $region_id);
            });
        }
        if (!is_null($area_id)) {
            $query->whereHas('client', function ($squery) use ($area_id) {
                $squery->where('area_id', $area_id);
            });
        }
        if (!is_null($territory_id)) {
            $query->whereHas('client', function ($squery) use ($territory_id) {
                $squery->where('territory_id', $territory_id);
            });
        }
        if (!is_null($client_id)) {
            $query->whereIn('client_id', $client_id);
        }
        if (!is_null($category_id)) {
            $query->whereHas('product', function ($squery) use ($category_id) {
                $squery->whereIn('category_id', $category_id);
            });
        }
        if (!is_null($product_id)) {
            $query->whereIn('product_id', $product_id);
        }
        if (!is_null($start_date) && !is_null($end_date)) {
            $query->whereHas('return', function ($squery) use ($start_date, $end_date) {
                $squery->where('date', '>=', $start_date)->where('date', '<=', $end_date);
            });
        }

        if ($report_type == 'product_summary') {
            $query->select(
                'sales_return_lists.product_id',
                DB::raw('SUM(sales_return_lists.qty) as total_qty'),
                DB::raw('SUM(sales_return_lists.amount) as total_amount'),
            );
            $query->groupBy('sales_return_lists.product_id');
        }
        if ($report_type == 'client_summary') {
            $query->select(
                'sales_return_lists.client_id',
                DB::raw('SUM(sales_return_lists.qty) as total_qty'),
                DB::raw('SUM(sales_return_lists.amount) as total_amount'),
            );
            $query->groupBy('sales_return_lists.client_id');
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
                'pageLength' => 20,
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $product_wise = [
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
                'data'      => 'product.category.name',
                'name'      => 'product.category.name',
                'title'     => 'Category',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.vendor.name',
                'name'      => 'product.vendor.name',
                'title'     => 'Vendor',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.name',
                'name'      => 'product.name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.code',
                'name'      => 'product.code',
                'title'     => 'Product Code',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_qty',
                'name'      => 'total_qty',
                'title'     => 'Qty',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap',
            ]),
        ];

        $client_wise = [
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

        if (request('report_type') == 'product_summary') {
            return $product_wise;
        } else {
            return $client_wise;
        }
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'return_summary_' . date('d_m_Y_h_i_s_A');
    }
}
