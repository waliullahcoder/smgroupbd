<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderListDataTable extends DataTable
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
            ->addColumn('items', function ($row) {
                $string = '';
                foreach ($row->products as $key => $item) {
                    $string .= ($key > 0 ? ', ' : '') . @$item->product->name . ' - ' . $item->quantity . ' ' . @$item->product->attribute->name . ' - ' . $item->subtotal . 'Taka ';
                }
                return $string;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        $query = $model->with(['products', 'area']);
        $date_range = explode('to', request('date_range'));
        $start_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null(request('date_range')) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);

        if (request('store_id')) {
            $query->where('store_id', request('store_id'));
        }
        if (Auth::user()->hasRole('Moderator')) {
            $query->where('created_by', Auth::user()->id);
        }
        if (request('area_id')) {
            $query->where('area_id', request('area_id'));
        }
        if (request('created_by')) {
            $query->where('created_by', request('created_by'));
        }
        if (request('status')) {
            $query->where('status', request('status'));
        }
        return $query->orderBy('id', 'desc');
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
                'title'     => 'Order No.',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'user_name',
                'name'      => 'user_name',
                'title'     => 'Customer Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'user_phone',
                'name'      => 'user_phone',
                'title'     => 'Customer Phone',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'area.name',
                'name'      => 'area.name',
                'title'     => 'Area',
                'class'     => 'text-nowrap',
                'defaultContent' => ''
            ]),
            Column::make([
                'data'      => 'shipping_address',
                'name'      => 'shipping_address',
                'title'     => 'Address',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'items',
                'name'      => 'items',
                'title'     => 'Product Details',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'order_list_history' . date('d_m_Y_h_i_s_A');
    }
}
