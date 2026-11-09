<?php

namespace App\DataTables;

use App\Models\Order;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OfflineOrderListDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function ($row) {
                $checkbox = '<div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                return $checkbox;
            })
            ->addColumn('date', function ($row) {
                return date('d-m-Y', strtotime($row->date));
            })
            ->addColumn('actions', function ($row) {
                $type = request('type');
                $data = [
                    'id' => $row->id,
                    'edit' => !empty($type) && $type == 'trash' ? false : true,
                ];
                $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.offline-order.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                return ActionButtons::actions($data, $actionBtn);
            })
            ->rawColumns(['checkbox', 'actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        $query = $model->with(['company', 'client', 'staff'])->where('order_type', 'offline')->orderBy('date', 'desc');
        $query->whereHas('products', function ($query) {
            $query->where('delivered', 0);
        });
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
                'buttons'   => [
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
        $currentRouteName = \Request::route()->getName();
        $delete_link = str_replace('index', 'destroy', $currentRouteName);
        if (Auth::user()->hasRole('Software Admin')) {
            return [
                Column::make([
                    'data'      => "checkbox",
                    'name'      => "checkbox",
                    'title'     => '',
                    'orderable' => false,
                    'searchable' => false,
                    'width'     => '60',
                    'class'     => 'text-center',
                    'footer'    => '<div class="custom-control custom-checkbox">
                                    <div id="regular_all_select">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                    <div id="trash_all_select" style="display: none;">
                                        <input type="checkbox" class="custom-control-input" id="trash_selectAll">
                                        <label class="custom-control-label" for="trash_selectAll"></label>
                                    </div>
                                </div>',
                ]),
                Column::make([
                    'data'      => 'company.name',
                    'name'      => 'company.name',
                    'title'     => 'Company',
                    'class'     => 'text-nowrap',
                ]),
                Column::make([
                    'data'      => 'date',
                    'name'      => 'date',
                    'title'     => 'Order Date',
                    'class'     => 'text-nowrap',
                ]),
                Column::make([
                    'data'      => 'client.name',
                    'name'      => 'client.name',
                    'title'     => 'Client',
                    'class'     => 'text-nowrap',
                ]),
                Column::make([
                    'data'      => 'staff.name',
                    'name'      => 'staff.name',
                    'title'     => 'Staff',
                    'class'     => 'text-nowrap',
                ]),
                Column::make([
                    'data'      => "actions",
                    'name'      => "actions",
                    'title'     => 'Actions',
                    'orderable' => false,
                    'searchable' => false,
                    'width'     => '60',
                    'class'     => 'text-center',
                    'footer'    => '<div class="text-end"><button type="button" name="bulk_delete" data-url="' . Route($delete_link, '0') . '" id="bulk_delete"
                    class="btn btn btn-xs btn-danger">Delete</button>
                <button type="button" name="bulk_delete" data-url="' . Route($delete_link, '0') . '"
                    style="display: none;" id="trash_bulk_delete" class="btn btn btn-xs btn-danger">Delete</button></div>',
                ]),
            ];
        } else {
            return [
                Column::make([
                    'data'      => "checkbox",
                    'name'      => "checkbox",
                    'title'     => '',
                    'orderable' => false,
                    'searchable' => false,
                    'width'     => '60',
                    'class'     => 'text-center',
                    'footer'    => '<div class="custom-control custom-checkbox">
                                    <div id="regular_all_select">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                    <div id="trash_all_select" style="display: none;">
                                        <input type="checkbox" class="custom-control-input" id="trash_selectAll">
                                        <label class="custom-control-label" for="trash_selectAll"></label>
                                    </div>
                                </div>',
                ]),
                Column::make([
                    'data'      => 'date',
                    'name'      => 'date',
                    'title'     => 'Order Date',
                    'class'     => 'text-nowrap',
                ]),
                Column::make([
                    'data'      => 'client.name',
                    'name'      => 'client.name',
                    'title'     => 'Client',
                    'class'     => 'text-nowrap',
                ]),
                Column::make([
                    'data'      => 'staff.name',
                    'name'      => 'staff.name',
                    'title'     => 'Staff',
                    'class'     => 'text-nowrap',
                ]),
                Column::make([
                    'data'      => "actions",
                    'name'      => "actions",
                    'title'     => 'Actions',
                    'orderable' => false,
                    'searchable' => false,
                    'width'     => '60',
                    'class'     => 'text-center',
                    'footer'    => '<div class="text-end"><button type="button" name="bulk_delete" data-url="' . Route($delete_link, '0') . '" id="bulk_delete"
                    class="btn btn btn-xs btn-danger">Delete</button>
                <button type="button" name="bulk_delete" data-url="' . Route($delete_link, '0') . '"
                    style="display: none;" id="trash_bulk_delete" class="btn btn btn-xs btn-danger">Delete</button></div>',
                ]),
            ];
        }
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Offline_order_list_' . date('d_m_Y_h_i_s_A');
    }
}
