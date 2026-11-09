<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Staff;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HrmReportController extends Controller
{
   

    public function hrmReport()
    {
        if (request()->ajax()) {

            $model = DB::table('hrm_employee_payrolls as p')
                ->leftJoin('staff as s', 's.id', '=', 'p.employee_id')
                ->select(
                    'p.id',
                    's.code as employee_code',
                    's.name as employee_name',
                    'p.payroll_month',
                    'p.payroll_year',
                    'p.gross_salary',
                    'p.total_deduction',
                    'p.net_salary',
                    'p.payment_date',
                    'p.payment_status',
                    'p.remarks'
                );

            if (request()->filled('employee_id')) {
                $model->where('p.employee_id', request('employee_id'));
            }
            if (request()->filled('payment_status')) {
                $model->where('p.payment_status', request('payment_status'));
            }

            if (request()->filled('from_date')) {
                $model->whereDate('p.payment_date', '>=', request('from_date'));
            }

            if (request()->filled('to_date')) {
                $model->whereDate('p.payment_date', '<=', request('to_date'));
            }

            $model->orderByDesc('p.id');

            return DataTables::of($model)

                ->addIndexColumn()

                ->editColumn('payroll_month', function ($row) {
                    return $row->payroll_month
                        ? date('F', mktime(0, 0, 0, $row->payroll_month, 1))
                        : '-';
                })

                ->editColumn('gross_salary', function ($row) {
                    return number_format($row->gross_salary, 2);
                })

                ->editColumn('total_deduction', function ($row) {
                    return number_format($row->total_deduction, 2);
                })

                ->editColumn('net_salary', function ($row) {
                    return number_format($row->net_salary, 2);
                })

                ->editColumn('payment_date', function ($row) {
                    return $row->payment_date
                        ? date('F j, Y', strtotime($row->payment_date))
                        : '-';
                })

                ->editColumn('payment_status', function ($row) {

                    $status = strtolower($row->payment_status);

                    if ($status == 'paid') {
                        $color = '#198754';
                    } elseif ($status == 'pending') {
                        $color = '#ffc107';
                    } elseif ($status == 'cancelled') {
                        $color = '#dc3545';
                    } else {
                        $color = '#6c757d';
                    }

                    $textColor = $status == 'pending' ? '#000' : '#fff';

                    return '<span class="badge"
                                style="background-color:' . $color . ';
                                    color:' . $textColor . ';
                                    padding:6px 12px;
                                    border-radius:20px;">
                                ' . ucfirst($row->payment_status) . '
                            </span>';
                })

                ->rawColumns([
                    'payment_status'
                ])

                ->make(true);
        }

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.reports.hrm', compact('employees'));
    }







}
