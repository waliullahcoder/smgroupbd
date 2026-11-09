<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\OnlineSales;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProductWiseSalesSummaryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $month = request('month') ?? date('m');
        if (Str::length($month) == 1) {
            $month = '0' . $month;
        }
        $year = request('year') ?? $year = date('Y');

        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('sum_total_qty', function ($row) use ($year, $month) {
                $start_date = $year . '-' . $month . '-01';
                $end_date = date('Y-m-t', strtotime($year . '-' . $month));
                $qty = OnlineSales::where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('total_qty', function ($row) use ($year, $month) {
                $start_date = $year . '-' . $month . '-01';
                $end_date = date('Y-m-t', strtotime($year . '-' . $month));
                $total_qty = OnlineSales::where('product_id', $row->id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($total_qty == 0 ? '-' : $total_qty);
            })
            ->addColumn('sum_one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-01';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-01';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-02';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-02';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-03';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-03';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-04';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-04';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-05';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-05';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-06';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-06';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-07';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-07';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-08';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-08';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_nine', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-09';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('nine', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-09';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_ten', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-10';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('ten', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-10';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_eleven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-11';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('eleven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-11';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twelve', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-12';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twelve', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-12';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_thirteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-13';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('thirteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-13';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_fourteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-14';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('fourteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-14';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_fifteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-15';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('fifteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-15';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_sixteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-16';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sixteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-16';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_seventeen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-17';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('seventeen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-17';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_eighteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-18';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('eighteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-18';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_nineteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-19';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('nineteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-19';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-20';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-20';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-21';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-21';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-22';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-22';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-23';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-23';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-24';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-24';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-25';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-25';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-26';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-26';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-27';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-27';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-28';
                $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('twenty_eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-28';
                $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                return ($qty == 0 ? '-' : $qty);
            })
            ->addColumn('sum_twenty_nine', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-29'));
                if ($date == $year . '-' . $month . '-29') {
                    $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                    return ($qty == 0 ? '-' : $qty);
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_nine', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-29'));
                if ($date == $year . '-' . $month . '-29') {
                    $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                    return ($qty == 0 ? '-' : $qty);
                } else {
                    return '-';
                }
            })
            ->addColumn('sum_thirty', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-30'));
                if ($date == $year . '-' . $month . '-30') {
                    $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                    return ($qty == 0 ? '-' : $qty);
                } else {
                    return '-';
                }
            })
            ->addColumn('thirty', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-30'));
                if ($date == $year . '-' . $month . '-30') {
                    $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                    return ($qty == 0 ? '-' : $qty);
                } else {
                    return '-';
                }
            })
            ->addColumn('sum_thirty_one', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-31'));
                if ($date == $year . '-' . $month . '-31') {
                    $qty = OnlineSales::where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                    return ($qty == 0 ? '-' : $qty);
                } else {
                    return '-';
                }
            })
            ->addColumn('thirty_one', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-31'));
                if ($date == $year . '-' . $month . '-31') {
                    $qty = OnlineSales::where('product_id', $row->id)->where('date', $date)->whereIn('status', ['Delivered', 'Collected'])->sum('qty');
                    return ($qty == 0 ? '-' : $qty);
                } else {
                    return '-';
                }
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        $query = $model->where('status', 1);
        if (request('category_id')) {
            $query->whereIn('category_id', request('category_id'));
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
                'drawCallback' => 'function() {
                    let data = this.api().ajax.json().data;
                    var sum_total_qty = 0.00;
                    var sum_one = 0.00;
                    var sum_two = 0.00;
                    var sum_three = 0.00;
                    var sum_four = 0.00;
                    var sum_five = 0.00;
                    var sum_six = 0.00;
                    var sum_seven = 0.00;
                    var sum_eight = 0.00;
                    var sum_nine = 0.00;
                    var sum_ten = 0.00;
                    var sum_eleven = 0.00;
                    var sum_twelve = 0.00;
                    var sum_thirteen = 0.00;
                    var sum_fourteen = 0.00;
                    var sum_fifteen = 0.00;
                    var sum_sixteen = 0.00;
                    var sum_seventeen = 0.00;
                    var sum_eighteen = 0.00;
                    var sum_nineteen = 0.00;
                    var sum_twenty = 0.00;
                    var sum_twenty_one = 0.00;
                    var sum_twenty_two = 0.00;
                    var sum_twenty_three = 0.00;
                    var sum_twenty_four = 0.00;
                    var sum_twenty_five = 0.00;
                    var sum_twenty_six = 0.00;
                    var sum_twenty_seven = 0.00;
                    var sum_twenty_eight = 0.00;
                    var sum_twenty_nine = 0.00;
                    var sum_thirty = 0.00;
                    var sum_thirty_one = 0.00;
                    data.forEach(function(item, index){
                        sum_total_qty = item.sum_total_qty;
                        sum_one = item.sum_one;
                        sum_two = item.sum_two;
                        sum_three = item.sum_three;
                        sum_four = item.sum_four;
                        sum_five = item.sum_five;
                        sum_six = item.sum_six;
                        sum_seven = item.sum_seven;
                        sum_eight = item.sum_eight;
                        sum_nine = item.sum_nine;
                        sum_ten = item.sum_ten;
                        sum_eleven = item.sum_eleven;
                        sum_twelve = item.sum_twelve;
                        sum_thirteen = item.sum_thirteen;
                        sum_fourteen = item.sum_fourteen;
                        sum_fifteen = item.sum_fifteen;
                        sum_sixteen = item.sum_sixteen;
                        sum_seventeen = item.sum_seventeen;
                        sum_eighteen = item.sum_eighteen;
                        sum_nineteen = item.sum_nineteen;
                        sum_twenty = item.sum_twenty;
                        sum_twenty_one = item.sum_twenty_one;
                        sum_twenty_two = item.sum_twenty_two;
                        sum_twenty_three = item.sum_twenty_three;
                        sum_twenty_four = item.sum_twenty_four;
                        sum_twenty_five = item.sum_twenty_five;
                        sum_twenty_six = item.sum_twenty_six;
                        sum_twenty_seven = item.sum_twenty_seven;
                        sum_twenty_eight = item.sum_twenty_eight;
                        sum_twenty_nine = item.sum_twenty_nine;
                        sum_thirty = item.sum_thirty;
                        sum_thirty_one = item.sum_thirty_one;
                        return false;
                    });
                    $("#sum_total_qty").html(sum_total_qty);
                    $("#sum_one").html(sum_one);
                    $("#sum_two").html(sum_two);
                    $("#sum_three").html(sum_three);
                    $("#sum_four").html(sum_four);
                    $("#sum_five").html(sum_five);
                    $("#sum_six").html(sum_six);
                    $("#sum_seven").html(sum_seven);
                    $("#sum_eight").html(sum_eight);
                    $("#sum_nine").html(sum_nine);
                    $("#sum_ten").html(sum_ten);
                    $("#sum_eleven").html(sum_eleven);
                    $("#sum_twelve").html(sum_twelve);
                    $("#sum_thirteen").html(sum_thirteen);
                    $("#sum_fourteen").html(sum_fourteen);
                    $("#sum_fifteen").html(sum_fifteen);
                    $("#sum_sixteen").html(sum_sixteen);
                    $("#sum_seventeen").html(sum_seventeen);
                    $("#sum_eighteen").html(sum_eighteen);
                    $("#sum_nineteen").html(sum_nineteen);
                    $("#sum_twenty").html(sum_twenty);
                    $("#sum_twenty_one").html(sum_twenty_one);
                    $("#sum_twenty_two").html(sum_twenty_two);
                    $("#sum_twenty_three").html(sum_twenty_three);
                    $("#sum_twenty_four").html(sum_twenty_four);
                    $("#sum_twenty_five").html(sum_twenty_five);
                    $("#sum_twenty_six").html(sum_twenty_six);
                    $("#sum_twenty_seven").html(sum_twenty_seven);
                    $("#sum_twenty_eight").html(sum_twenty_eight);
                    $("#sum_twenty_nine").html(sum_twenty_nine);
                    $("#sum_thirty").html(sum_thirty);
                    $("#sum_thirty_one").html(sum_thirty_one);
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
                'title'     => 'SL.',
                'orderable' => false,
                'searchable' => false,
                'width'     => '20',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'name',
                'name'      => 'name',
                'title'     => 'Product Name',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'total_qty',
                'name'      => 'total_qty',
                'title'     => 'Total Qty',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_total_qty"></span>',
            ]),
            Column::make([
                'data'      => 'one',
                'name'      => 'one',
                'title'     => '01',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_one"></span>',
            ]),
            Column::make([
                'data'      => 'two',
                'name'      => 'two',
                'title'     => '02',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_two"></span>',
            ]),
            Column::make([
                'data'      => 'three',
                'name'      => 'three',
                'title'     => '03',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_three"></span>',
            ]),
            Column::make([
                'data'      => 'four',
                'name'      => 'four',
                'title'     => '04',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_four"></span>',
            ]),
            Column::make([
                'data'      => 'five',
                'name'      => 'five',
                'title'     => '05',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_five"></span>',
            ]),
            Column::make([
                'data'      => 'six',
                'name'      => 'six',
                'title'     => '06',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_six"></span>',
            ]),
            Column::make([
                'data'      => 'seven',
                'name'      => 'seven',
                'title'     => '07',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_seven"></span>',
            ]),
            Column::make([
                'data'      => 'eight',
                'name'      => 'eight',
                'title'     => '08',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_eight"></span>',
            ]),
            Column::make([
                'data'      => 'nine',
                'name'      => 'nine',
                'title'     => '09',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_nine"></span>',
            ]),
            Column::make([
                'data'      => 'ten',
                'name'      => 'ten',
                'title'     => '10',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_ten"></span>',
            ]),
            Column::make([
                'data'      => 'eleven',
                'name'      => 'eleven',
                'title'     => '11',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_eleven"></span>',
            ]),
            Column::make([
                'data'      => 'twelve',
                'name'      => 'twelve',
                'title'     => '12',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twelve"></span>',
            ]),
            Column::make([
                'data'      => 'thirteen',
                'name'      => 'thirteen',
                'title'     => '13',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_thirteen"></span>',
            ]),
            Column::make([
                'data'      => 'fourteen',
                'name'      => 'fourteen',
                'title'     => '14',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_fourteen"></span>',
            ]),
            Column::make([
                'data'      => 'fifteen',
                'name'      => 'fifteen',
                'title'     => '15',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_fifteen"></span>',
            ]),
            Column::make([
                'data'      => 'sixteen',
                'name'      => 'sixteen',
                'title'     => '16',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_sixteen"></span>',
            ]),
            Column::make([
                'data'      => 'seventeen',
                'name'      => 'seventeen',
                'title'     => '17',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_seventeen"></span>',
            ]),
            Column::make([
                'data'      => 'eighteen',
                'name'      => 'eighteen',
                'title'     => '18',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_eighteen"></span>',
            ]),
            Column::make([
                'data'      => 'nineteen',
                'name'      => 'nineteen',
                'title'     => '19',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_nineteen"></span>',
            ]),
            Column::make([
                'data'      => 'twenty',
                'name'      => 'twenty',
                'title'     => '20',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_one',
                'name'      => 'twenty_one',
                'title'     => '21',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_one"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_two',
                'name'      => 'twenty_two',
                'title'     => '22',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_two"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_three',
                'name'      => 'twenty_three',
                'title'     => '23',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_three"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_four',
                'name'      => 'twenty_four',
                'title'     => '24',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_four"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_five',
                'name'      => 'twenty_five',
                'title'     => '25',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_five"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_six',
                'name'      => 'twenty_six',
                'title'     => '26',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_six"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_seven',
                'name'      => 'twenty_seven',
                'title'     => '27',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_seven"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_eight',
                'name'      => 'twenty_eight',
                'title'     => '28',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_eight"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_nine',
                'name'      => 'twenty_nine',
                'title'     => '29',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_twenty_nine"></span>',
            ]),
            Column::make([
                'data'      => 'thirty',
                'name'      => 'thirty',
                'title'     => '30',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_thirty"></span>',
            ]),
            Column::make([
                'data'      => 'thirty_one',
                'name'      => 'thirty_one',
                'title'     => '31',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="sum_thirty_one"></span>',
            ])
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'product_wise_sales_summary_' . date('d_m_Y_h_i_s_A');
    }
}
