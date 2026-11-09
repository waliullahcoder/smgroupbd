<?php

namespace App\DataTables;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ClientListDataTable extends DataTable
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
    public function query(Client $model): QueryBuilder
    {
        // client_category_id
        $query = $model->with(['reference', 'client_category', 'area', 'territory']);
        $region_id = request('region_id');
        $area_id = request('area_id');
        $territory_id = request('territory_id');
        $category_id = request('category_id');
        $staff_id = request('staff_id');
        $client_type = request('client_type');
        $start_date = request('start_date');
        if (!empty($region_id)) {
            $query->whereHas('area', function ($squery) use ($region_id) {
                $squery->where('region_id', $region_id);
            });
        }
        if (!empty($area_id)) {
            $query->where('area_id', $area_id);
        }
        if (!empty($territory_id)) {
            $query->where('territory_id', $territory_id);
        }
        if (!empty($category_id)) {
            $query->where('client_category_id', $category_id);
        }
        if (!empty($staff_id)) {
            $query->where('reference_by', $staff_id);
        }
        if (!empty($client_type)) {
        }
        if (!empty($start_date)) {
            $query->where('created_at', '>=', date('Y-m-d', strtotime($start_date)));
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
                'data'      => 'area.region.name',
                'name'      => 'area.region.name',
                'title'     => 'Region',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'area.name',
                'name'      => 'area.name',
                'title'     => 'Area',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'territory.name',
                'name'      => 'territory.name',
                'title'     => 'Territory',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'name',
                'name'      => 'name',
                'title'     => 'Client Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'phone',
                'name'      => 'phone',
                'title'     => 'Contact Number',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'address',
                'name'      => 'address',
                'title'     => 'Address',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'credit_limit',
                'name'      => 'credit_limit',
                'title'     => 'Credit Limit',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'reference.name',
                'name'      => 'reference.name',
                'title'     => 'Reference',
                'class'     => 'text-nowrap',
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'client_list_' . date('d_m_Y_h_i_s_A');
    }
}
