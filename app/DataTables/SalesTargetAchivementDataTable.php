<?php

namespace App\DataTables;

use App\Models\Group;
use App\Services\TargetAchievement\TargetAchievement;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalesTargetAchivementDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $month = !is_null(request('month')) ? request('month') : date('m');
        $year = !is_null(request('year')) ? request('year') : date('Y');
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('members', function ($row) {
                $members = '';
                foreach ($row->members as $key => $member) {
                    if ($key > 0) {
                        $members .= ', ';
                    }
                    $members .= $member->staff->name;
                }
                return $members;
            })
            ->addColumn('month_year', function ($row) use ($month, $year) {
                return $month . ' - ' . $year;
            })
            ->addColumn('target', function ($row) use ($month, $year) {
                return @$row->targets->where('month', $month)->where('year', $year)->first()->total_target_amount;
            })
            ->addColumn('achievement', function ($row) use ($month, $year) {
                $staff_id = $row->members->pluck('staff_id');
                return TargetAchievement::achievement($month, $year, $staff_id);
            })
            ->addColumn('difference', function ($row) use ($month, $year) {
                $staff_id = $row->members->pluck('staff_id');
                $target = @$row->targets->where('month', $month)->where('year', $year)->first()->total_target_amount;
                $achievement = TargetAchievement::achievement($month, $year, $staff_id);
                return $target - $achievement;
            })
            ->addColumn('achivement', function ($row) use ($month, $year) {
                $staff_id = $row->members->pluck('staff_id');
                $target = @$row->targets->where('month', $month)->where('year', $year)->first()->total_target_amount;
                $achievement = TargetAchievement::achievement($month, $year, $staff_id);
                $achievement = ($achievement * 100) / $target;
                return '<div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar"
                            style="width:' . round($achievement) . '%; height:5px;"
                            aria-valuenow="' . round($achievement) . '" aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                    <span class="progress-parcent">' . number_format($achievement, 2, '.', ',') . '%</span>';
            })
            ->rawColumns(['achivement']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Group $model): QueryBuilder
    {
        $query = $model->with(['leader', 'members', 'targets']);
        $group_id = request('group_id');
        if (!is_null($group_id)) {
            $query->whereIn('id', $group_id);
        }
        $month = !is_null(request('month')) ? request('month') : date('m');
        $year = !is_null(request('year')) ? request('year') : date('Y');
        $query->whereHas('targets', function ($squery) use ($month, $year) {
            $squery->where('month', $month)->where('year', $year);
        });
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
                'data'      => 'name',
                'name'      => 'name',
                'title'     => 'Group Name',
                'class'     => 'text-nowrap',
            ]),
            Column::make([
                'data'      => 'members',
                'name'      => 'members',
                'title'     => 'Members',
                'class'     => 'text-nowrap',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'month_year',
                'name'      => 'month_year',
                'title'     => 'Month-Year',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'target',
                'name'      => 'target',
                'title'     => 'Target',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'achievement',
                'name'      => 'achievement',
                'title'     => 'Achievement',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'difference',
                'name'      => 'difference',
                'title'     => 'Difference',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
            Column::make([
                'data'      => 'achivement',
                'name'      => 'achivement',
                'title'     => 'Achievement',
                'class'     => 'text-nowrap text-center',
                'orderable' => false,
                'searchable' => false,
            ]),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'sales_target_achivement_' . date('d_m_Y_h_i_s_A');
    }
}
