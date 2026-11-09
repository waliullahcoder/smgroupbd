<?php

namespace App\DataTables;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PurchaseLogDataTable extends DataTable
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
            ->addColumn('products', function ($row) {
                return json_decode($row->list->pluck('product.name'));
            })
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->date));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Sales $model): QueryBuilder
    {
        $query = $model->with(['list', 'list.product']);
        $client_id = Auth::user()->client->id;
        $query->where('client_id', $client_id);

        $date_range = explode('to', request('date_range'));
        $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : NULL;
        $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : NULL;
        $category_id = request('category_id');
        $product_id = request('product_id');
        if (!is_null($product_id)) {
            $query->whereHas('list', function ($squery) use ($product_id) {
                $squery->whereIn('product_id', $product_id);
            });
        }
        if (!is_null($category_id)) {
            $query->whereHas('list.product', function ($squery) use ($category_id) {
                $squery->whereIn('category_id', $category_id);
            });
        }
        if (!is_null($start_date) && !is_null($end_date)) {
            $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-t');
            $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
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
                'data'      => 'invoice',
                'name'      => 'invoice',
                'title'     => 'Invoice',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'sales_type',
                'name'      => 'sales_type',
                'title'     => 'Sales Type',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'products',
                'name'      => 'products',
                'title'     => 'Products',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'total_amount',
                'name'      => 'total_amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'discount',
                'name'      => 'discount',
                'title'     => 'Discount',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'purchase_log_' . date('d_m_Y_h_i_s_A');
    }
}
