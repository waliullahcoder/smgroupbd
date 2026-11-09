<?php

namespace App\DataTables;

use App\Models\SalesReturnList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReturnHistoryDataTable extends DataTable
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
                return date('d-m-Y', strtotime($row->return->date));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SalesReturnList $model): QueryBuilder
    {
        $query = $model->with(['return', 'client', 'client.area', 'product']);

        $category_id = request('category_id');
        $client_id = request('client_id');
        $product_id = request('product_id');
        $region_id = request('region_id');
        $area_id = request('area_id');
        $territory_id = request('territory_id');

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
                'data'      => 'client.name',
                'name'      => 'client.name',
                'title'     => 'Client Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product.category.name',
                'name'      => 'product.category.name',
                'title'     => 'Category Name',
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
                'data'      => 'qty',
                'name'      => 'qty',
                'title'     => 'Qty',
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
        return 'return_history_' . date('d_m_Y_h_i_s_A');
    }
}
