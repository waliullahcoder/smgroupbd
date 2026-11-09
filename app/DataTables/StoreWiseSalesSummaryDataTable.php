<?php

namespace App\DataTables;

use App\Models\Store;
use App\Models\Order;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class StoreWiseSalesSummaryDataTable extends DataTable
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
            ->addColumn('total_sum_amount', function ($row) use ($year, $month) {
                $start_date = $year . '-' . $month . '-01';
                $end_date = date('Y-m-t', strtotime($year . '-' . $month));
                $query = Order::where('date', '>=', $start_date)->where('date', '<=', $end_date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                return $query->whereNotNull('store_id')->whereIn('status', ['delivered', 'Collected'])->count();
            })
            ->addColumn('total_count', function ($row) use ($year, $month) {
                $start_date = $year . '-' . $month . '-01';
                $end_date = date('Y-m-t', strtotime($year . '-' . $month));
                $count = Order::where('store_id', $row->id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&start_date=' . $start_date . '&end_date=' . $end_date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-01';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-01';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-02';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-02';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-03';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-03';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-04';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-04';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-05';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-05';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-06';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-06';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-07';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-07';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-08';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-08';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_nine', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-09';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('nine', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-09';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_ten', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-10';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('ten', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-10';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_eleven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-11';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('eleven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-11';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twelve', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-12';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twelve', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-12';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_thirteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-13';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('thirteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-13';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_fourteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-14';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('fourteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-14';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_fifteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-15';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('fifteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-15';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_sixteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-16';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('sixteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-16';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_seventeen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-17';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('seventeen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-17';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_eighteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-18';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('eighteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-18';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_nineteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-19';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('nineteen', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-19';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-20';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-20';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-21';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_one', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-21';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-22';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_two', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-22';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-23';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_three', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-23';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-24';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_four', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-24';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-25';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_five', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-25';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-26';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_six', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-26';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-27';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_seven', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-27';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-28';
                $query = Order::where('date', $date);
                if (request('store_id')) {
                    $query->whereIn('store_id', request('store_id'));
                }
                $count = $query->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return $count;
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_eight', function ($row) use ($month, $year) {
                $date = $year . '-' . $month . '-28';
                $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                if ($count > 0) {
                    return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('total_twenty_nine', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-29'));
                if ($date == $year . '-' . $month . '-29') {
                    $count = Order::where('date', $date)->count();
                    if ($count > 0) {
                        return $count;
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->addColumn('twenty_nine', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-29'));
                if ($date == $year . '-' . $month . '-29') {
                    $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                    if ($count > 0) {
                        return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->addColumn('total_thirty', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-30'));
                if ($date == $year . '-' . $month . '-30') {
                    $count = Order::where('date', $date)->count();
                    if ($count > 0) {
                        return $count;
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->addColumn('thirty', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-30'));
                if ($date == $year . '-' . $month . '-30') {
                    $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                    if ($count > 0) {
                        return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->addColumn('total_thirty_one', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-31'));
                if ($date == $year . '-' . $month . '-31') {
                    $count = Order::where('date', $date)->count();
                    if ($count > 0) {
                        return $count;
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->addColumn('thirty_one', function ($row) use ($month, $year) {
                $date = date('Y-m-d', strtotime($year . '-' . $month . '-31'));
                if ($date == $year . '-' . $month . '-31') {
                    $count =  Order::where('store_id', $row->id)->where('date', $date)->whereIn('status', ['delivered', 'Collected'])->count();
                    if ($count > 0) {
                        return '<a href="' . Route('admin.store-wise-sales-statement.index') . '?view_orders=true&date=' . $date . '&store_id=' . $row->id . '">' . $count . '</a>';
                    } else {
                        return '-';
                    }
                } else {
                    return '-';
                }
            })
            ->rawColumns(['total_count', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 'twenty_one', 'twenty_two', 'twenty_three', 'twenty_four', 'twenty_five', 'twenty_six', 'twenty_seven', 'twenty_eight', 'twenty_nine', 'thirty', 'thirty_one']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Store $model): QueryBuilder
    {
        $query = $model->where('status', 1);
        if (request('store_id')) {
            $query->whereIn('id', request('store_id'));
        }
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
                'drawCallback' => 'function() {
                    let data = this.api().ajax.json().data;
                    var total_count = 0;
                    var total_1 = 0;
                    var total_2 = 0;
                    var total_3 = 0;
                    var total_4 = 0;
                    var total_5 = 0;
                    var total_6 = 0;
                    var total_7 = 0;
                    var total_8 = 0;
                    var total_9 = 0;
                    var total_10 = 0;
                    var total_11 = 0;
                    var total_12 = 0;
                    var total_13 = 0;
                    var total_14 = 0;
                    var total_15 = 0;
                    var total_16 = 0;
                    var total_17 = 0;
                    var total_18 = 0;
                    var total_19 = 0;
                    var total_20 = 0;
                    var total_21 = 0;
                    var total_22 = 0;
                    var total_23 = 0;
                    var total_24 = 0;
                    var total_25 = 0;
                    var total_26 = 0;
                    var total_27 = 0;
                    var total_28 = 0;
                    var total_29 = 0;
                    var total_30 = 0;
                    var total_31 = 0;
                    data.forEach(function(item, index){
                        total_count = item.total_sum_amount;
                        total_1 = item.total_one;
                        total_2 = item.total_two;
                        total_3 = item.total_three;
                        total_4 = item.total_four;
                        total_5 = item.total_five;
                        total_6 = item.total_six;
                        total_7 = item.total_seven;
                        total_8 = item.total_eight;
                        total_9 = item.total_nine;
                        total_10 = item.total_ten;
                        total_11 = item.total_eleven;
                        total_12 = item.total_twelve;
                        total_13 = item.total_thirteen;
                        total_14 = item.total_fourteen;
                        total_15 = item.total_fifteen;
                        total_16 = item.total_sixteen;
                        total_17 = item.total_seventeen;
                        total_18 = item.total_eighteen;
                        total_19 = item.total_nineteen;
                        total_20 = item.total_twenty;
                        total_21 = item.total_twenty_one;
                        total_22 = item.total_twenty_two;
                        total_23 = item.total_twenty_three;
                        total_24 = item.total_twenty_four;
                        total_25 = item.total_twenty_five;
                        total_26 = item.total_twenty_six;
                        total_27 = item.total_twenty_seven;
                        total_28 = item.total_twenty_eight;
                        total_29 = item.total_twenty_nine;
                        total_30 = item.total_thirty;
                        total_31 = item.total_thirty_one;
                    });
                    $("#total_count").html(total_count);
                    $("#total_one").html(total_1);
                    $("#total_two").html(total_2);
                    $("#total_three").html(total_3);
                    $("#total_four").html(total_4);
                    $("#total_five").html(total_5);
                    $("#total_six").html(total_6);
                    $("#total_seven").html(total_7);
                    $("#total_eight").html(total_8);
                    $("#total_nine").html(total_9);
                    $("#total_ten").html(total_10);
                    $("#total_eleven").html(total_11);
                    $("#total_twelve").html(total_12);
                    $("#total_thirteen").html(total_13);
                    $("#total_fourteen").html(total_14);
                    $("#total_fifteen").html(total_15);
                    $("#total_sixteen").html(total_16);
                    $("#total_seventeen").html(total_17);
                    $("#total_eighteen").html(total_18);
                    $("#total_nineteen").html(total_19);
                    $("#total_twenty").html(total_20);
                    $("#total_twenty_one").html(total_21);
                    $("#total_twenty_two").html(total_22);
                    $("#total_twenty_three").html(total_23);
                    $("#total_twenty_four").html(total_24);
                    $("#total_twenty_five").html(total_25);
                    $("#total_twenty_six").html(total_26);
                    $("#total_twenty_seven").html(total_27);
                    $("#total_twenty_eight").html(total_28);
                    $("#total_twenty_nine").html(total_29);
                    $("#total_thirty").html(total_30);
                    $("#total_thirty_one").html(total_31);
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
                'width'     => '30',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'name',
                'name'      => 'name',
                'title'     => 'Area Name',
                'orderable' => false,
                'searchable' => false,
                'footer'     => 'Total Summary',
            ]),
            Column::make([
                'data'      => 'total_count',
                'name'      => 'total_count',
                'title'     => 'Total',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_count"></span>',
            ]),
            Column::make([
                'data'      => 'one',
                'name'      => 'one',
                'title'     => '01',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_one"></span>',
            ]),
            Column::make([
                'data'      => 'two',
                'name'      => 'two',
                'title'     => '02',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_two"></span>',
            ]),
            Column::make([
                'data'      => 'three',
                'name'      => 'three',
                'title'     => '03',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_three"></span>',
            ]),
            Column::make([
                'data'      => 'four',
                'name'      => 'four',
                'title'     => '04',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_four"></span>',
            ]),
            Column::make([
                'data'      => 'five',
                'name'      => 'five',
                'title'     => '05',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_five"></span>',
            ]),
            Column::make([
                'data'      => 'six',
                'name'      => 'six',
                'title'     => '06',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_six"></span>',
            ]),
            Column::make([
                'data'      => 'seven',
                'name'      => 'seven',
                'title'     => '07',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_seven"></span>',
            ]),
            Column::make([
                'data'      => 'eight',
                'name'      => 'eight',
                'title'     => '08',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_eight"></span>',
            ]),
            Column::make([
                'data'      => 'nine',
                'name'      => 'nine',
                'title'     => '09',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_nine"></span>',
            ]),
            Column::make([
                'data'      => 'ten',
                'name'      => 'ten',
                'title'     => '10',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_ten"></span>',
            ]),
            Column::make([
                'data'      => 'eleven',
                'name'      => 'eleven',
                'title'     => '11',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_eleven"></span>',
            ]),
            Column::make([
                'data'      => 'twelve',
                'name'      => 'twelve',
                'title'     => '12',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twelve"></span>',
            ]),
            Column::make([
                'data'      => 'thirteen',
                'name'      => 'thirteen',
                'title'     => '13',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_thirteen"></span>',
            ]),
            Column::make([
                'data'      => 'fourteen',
                'name'      => 'fourteen',
                'title'     => '14',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_fourteen"></span>',
            ]),
            Column::make([
                'data'      => 'fifteen',
                'name'      => 'fifteen',
                'title'     => '15',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_fifteen"></span>',
            ]),
            Column::make([
                'data'      => 'sixteen',
                'name'      => 'sixteen',
                'title'     => '16',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_sixteen"></span>',
            ]),
            Column::make([
                'data'      => 'seventeen',
                'name'      => 'seventeen',
                'title'     => '17',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_seventeen"></span>',
            ]),
            Column::make([
                'data'      => 'eighteen',
                'name'      => 'eighteen',
                'title'     => '18',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_eighteen"></span>',
            ]),
            Column::make([
                'data'      => 'nineteen',
                'name'      => 'nineteen',
                'title'     => '19',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_nineteen"></span>',
            ]),
            Column::make([
                'data'      => 'twenty',
                'name'      => 'twenty',
                'title'     => '20',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_one',
                'name'      => 'twenty_one',
                'title'     => '21',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_one"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_two',
                'name'      => 'twenty_two',
                'title'     => '22',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_two"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_three',
                'name'      => 'twenty_three',
                'title'     => '23',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_three"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_four',
                'name'      => 'twenty_four',
                'title'     => '24',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_four"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_five',
                'name'      => 'twenty_five',
                'title'     => '25',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_five"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_six',
                'name'      => 'twenty_six',
                'title'     => '26',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_six"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_seven',
                'name'      => 'twenty_seven',
                'title'     => '27',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_seven"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_eight',
                'name'      => 'twenty_eight',
                'title'     => '28',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_eight"></span>',
            ]),
            Column::make([
                'data'      => 'twenty_nine',
                'name'      => 'twenty_nine',
                'title'     => '29',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_twenty_nine"></span>',
            ]),
            Column::make([
                'data'      => 'thirty',
                'name'      => 'thirty',
                'title'     => '30',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_thirty"></span>',
            ]),
            Column::make([
                'data'      => 'thirty_one',
                'name'      => 'thirty_one',
                'title'     => '31',
                'orderable' => false,
                'searchable' => false,
                'class'     => 'text-center',
                'footer'    => '<span id="total_thirty_one"></span>',
            ])
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'store_wise_sales_summary' . date('d_m_Y_h_i_s_A');
    }
}
