<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductListDataTable extends DataTable
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
    public function query(Product $model): QueryBuilder
    {
        $query = $model->with(['category', 'attribute', 'price']);

        $category_id = request('category_id');
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
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
                'width'     => '20',
                'class'     => 'text-center',
            ]),
            Column::make([
                'data'      => 'code',
                'name'      => 'code',
                'title'     => 'Product Code',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'name',
                'name'      => 'name',
                'title'     => 'Product Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'category.name',
                'name'      => 'category.name',
                'title'     => 'Product Category',
                'class'     => 'text-nowrap',
                'defaultContent' => ''
            ]),
            Column::make([
                'data'      => 'attribute.name',
                'name'      => 'attribute.name',
                'title'     => 'UOM',
                'class'     => 'text-nowrap',
                'defaultContent' => ''
            ]),
            Column::make([
                'data'      => 'price.sale_price',
                'name'      => 'price.sale_price',
                'title'     => 'Product Price',
                'class'     => 'text-nowrap',
                'defaultContent' => ''
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'product_list_' . date('d_m_Y_h_i_s_A');
    }
}
