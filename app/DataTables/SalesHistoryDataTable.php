<?php

namespace App\DataTables;

use App\Models\SalesHistory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalesHistoryDataTable extends DataTable
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
            ->addColumn('total_amount', function ($row) {
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $category_id = request('category_id');
                $store_id = request('store_id');
                $client_id = request('client_id');
                $product_id = request('product_id');
                $region_id = request('region_id');
                $area_id = request('area_id');
                $territory_id = request('territory_id');
                $staff_id = request('staff_id');
                $sales_type = request('sales_type');

                $query = SalesHistory::query();
                if (!is_null($sales_type) && $sales_type == 'sample') {
                    $query->where('sales_type', $sales_type);
                } elseif (!is_null($sales_type) && $sales_type == 'POS') {
                    $query->where('sales_type', 'POS');
                } else {
                    $query->whereNotIn('sales_type', ['sample', 'POS']);
                }
                if (!is_null($region_id)) {
                    $query->where('region_id', $region_id);
                }
                if (!is_null($area_id)) {
                    $query->where('area_id', $area_id);
                }
                if (!is_null($territory_id)) {
                    $query->where('territory_id', $territory_id);
                }
                if (!is_null($category_id)) {
                    $query->whereIn('category_id', $category_id);
                }
                if (!is_null($product_id)) {
                    $query->whereIn('product_id', $product_id);
                }
                if (!is_null($client_id)) {
                    $query->whereIn('client_id', $client_id);
                }
                if (!is_null($store_id)) {
                    $query->where('store_id', $store_id);
                }
                if (!is_null($staff_id)) {
                    $query->whereIn('staff_id', $staff_id);
                }
                $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                $total = $query->sum('amount');
                return number_format($total, 2, '.', ',');
            })
            ->addColumn('total_qty', function ($row) {
                $date_range = explode('to', request('date_range'));
                $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
                $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
                $category_id = request('category_id');
                $store_id = request('store_id');
                $client_id = request('client_id');
                $product_id = request('product_id');
                $region_id = request('region_id');
                $area_id = request('area_id');
                $territory_id = request('territory_id');
                $staff_id = request('staff_id');
                $sales_type = request('sales_type');

                $query = SalesHistory::query();
                if (!is_null($sales_type) && $sales_type == 'sample') {
                    $query->where('sales_type', $sales_type);
                } elseif (!is_null($sales_type) && $sales_type == 'POS') {
                    $query->where('sales_type', 'POS');
                } else {
                    $query->whereNotIn('sales_type', ['sample', 'POS']);
                }
                if (!is_null($region_id)) {
                    $query->where('region_id', $region_id);
                }
                if (!is_null($area_id)) {
                    $query->where('area_id', $area_id);
                }
                if (!is_null($territory_id)) {
                    $query->where('territory_id', $territory_id);
                }
                if (!is_null($category_id)) {
                    $query->whereIn('category_id', $category_id);
                }
                if (!is_null($product_id)) {
                    $query->whereIn('product_id', $product_id);
                }
                if (!is_null($client_id)) {
                    $query->whereIn('client_id', $client_id);
                }
                if (!is_null($store_id)) {
                    $query->where('store_id', $store_id);
                }
                if (!is_null($staff_id)) {
                    $query->whereIn('staff_id', $staff_id);
                }
                $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                $total = $query->sum('qty');
                return number_format($total, 2, '.', ',');
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Request $request, SalesHistory $model): QueryBuilder
    {
        $query = $model->query();
        $date_range = explode('to', $request->date_range);
        $start_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $category_id = $request->category_id;
        $store_id = $request->store_id;
        $client_id = $request->client_id;
        $product_id = $request->product_id;
        $region_id = $request->region_id;
        $area_id = $request->area_id;
        $territory_id = $request->territory_id;
        $staff_id = $request->staff_id;
        $sales_type = $request->sales_type;
        if (!is_null($sales_type) && $sales_type == 'sample') {
            $query->where('sales_type', $sales_type);
        } elseif (!is_null($sales_type) && $sales_type == 'POS') {
            $query->where('sales_type', 'POS');
        } else {
            $query->whereNotIn('sales_type', ['sample', 'POS']);
        }
        if (!is_null($region_id)) {
            $query->where('region_id', $region_id);
        }
        if (!is_null($area_id)) {
            $query->where('area_id', $area_id);
        }
        if (!is_null($territory_id)) {
            $query->where('territory_id', $territory_id);
        }
        if (!is_null($category_id)) {
            $query->whereIn('category_id', $category_id);
        }
        if (!is_null($product_id)) {
            $query->whereIn('product_id', $product_id);
        }
        if (!is_null($client_id)) {
            $query->whereIn('client_id', $client_id);
        }
        if (!is_null($store_id)) {
            $query->where('store_id', $store_id);
        }
        if (!is_null($staff_id)) {
            $query->whereIn('staff_id', $staff_id);
        }
        return $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
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
                    var total_qty = 0;
                    data.forEach(function(item, index){
                        total_amount = item.total_amount;
                        total_qty = item.total_qty;
                    });
                    $("#total_amount").html(total_amount);
                    $("#total_qty").html(total_qty);
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
                'data'      => 'client_name',
                'name'      => 'client_name',
                'title'     => 'Client Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product_name',
                'name'      => 'product_name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'product_code',
                'name'      => 'product_code',
                'title'     => 'Code',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'attribute_name',
                'name'      => 'attribute_name',
                'title'     => 'UOM',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'qty',
                'name'      => 'qty',
                'title'     => 'Quantity',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_qty"></span>',
            ]),
            Column::make([
                'data'      => 'rate',
                'name'      => 'rate',
                'title'     => 'Rate',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'amount',
                'name'      => 'amount',
                'title'     => 'Amount',
                'class'     => 'text-nowrap',
                'footer'    => '<span id="total_amount"></span>',
            ]),
            Column::make([
                'data'      => 'sales_type',
                'name'      => 'sales_type',
                'title'     => 'Sales Type',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'staff_name',
                'name'      => 'staff_name',
                'title'     => 'Staff',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'sales_history_' . date('d_m_Y_h_i_s_A');
    }
}
