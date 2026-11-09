<?php

namespace App\DataTables;

use App\Models\SalesHistory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalesSummaryDataTable extends DataTable
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
            ->addColumn('total_ctn', function ($row) {
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
                } else {
                    $query->where('sales_type', '!=', 'sample');
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
                $totals = $query->select('*', DB::raw('SUM(qty) as total_qty'))->groupBy('product_id')->get();
                $ctn = 0;
                foreach ($totals as $item) {
                    if ($item->total_qty > 0 && $row->ctn_size > 0) {
                        $ctn += floor($item->total_qty / $row->ctn_size);
                    }
                }
                return number_format($ctn, 2, '.', ',');
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
                } else {
                    $query->where('sales_type', '!=', 'sample');
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
            ->addColumn('ctn_qty', function ($row) {
                if ($row->group_qty > 0 && $row->ctn_size > 0) {
                    $ctn = floor($row->group_qty / $row->ctn_size);
                    $ctn_sizes = $ctn * $row->ctn_size;
                    $extra = $row->group_qty - $ctn_sizes;
                    return $ctn . ' CTN ' . ($extra > 0 ? $extra . ' ' . $row->attribute_name : '');
                }
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SalesHistory $model): QueryBuilder
    {
        $query = $model->query();
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

        if (!is_null($sales_type) && $sales_type == 'sample') {
            $query->where('sales_type', $sales_type);
        } else {
            $query->where('sales_type', '!=', 'sample');
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
        return $query->select('*', DB::raw('SUM(amount) as group_amount'))->groupBy('client_id');
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
                    var total_qty = 0;
                    var total_amount = 0;
                    data.forEach(function(item, index){
                        total_qty = item.total_ctn;
                        total_amount = item.total_amount;
                    });
                    $("#total_amount").html(total_amount);
                    $("#total_qty").html(total_qty+" CTN");
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
                'data'      => 'client_name',
                'name'      => 'client_name',
                'title'     => 'Client Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'group_amount',
                'name'      => 'group_amount',
                'title'     => 'Amount',
                'width'     => '200',
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
        return 'Sales_Report_' . date('d_m_Y_h_i_s_A');
    }
}
