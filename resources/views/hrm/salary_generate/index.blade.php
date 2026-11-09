@extends('layouts.admin.app')

@section('content')
<style>
    .card-header{
      margin-top:10px;
    }
    </style>
<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-user-check text-success"></i>
                    Generate Salary for All Employee for selected month
                </h5>

            </div>

            <div class="card-body">
                <form action="{{ route('admin.salary.generate') }}" method="GET">
                    @csrf
                    <div class="row g-3">
                            <div class="col-lg-4">
                                <label><b>Payroll Month</b></label>

                                <select name="payroll_month" class="form-control" required>
                                    @for($i=1;$i<=12;$i++)
                                        <option value="{{ $i }}"
                                            {{ request('payroll_month', date('n')) == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0,0,0,$i,1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label><b>Payroll Year</b></label>

                                <select name="payroll_year" class="form-control">
                                    @for($i=date('Y')-2;$i<=date('Y')+2;$i++)
                                        <option value="{{ $i }}"
                                            {{ request('payroll_year', date('Y')) == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-4" style="margin-top:35px">
                                <button class="btn btn-success">Show Previeous Data</button>
                            </div>
                    </div>
                </form>
            </div>

           @if(isset($payrolls) && count($payrolls))

            <div class="card mt-3">

                <div class="card-header bg-primary text-white">

                    Previous Payroll at last month:
                    {{ date('F', mktime(0, 0, 0, $previousMonth, 1))  }}-{{$previousYear}}

                </div>

                <div class="card-body">

                    <form action="{{ route('admin.salary.generate.store') }}" method="POST">

                        @csrf

                        <input type="hidden"
                            name="payroll_month"
                            value="{{ request('payroll_month') }}">

                        <input type="hidden"
                            name="payroll_year"
                            value="{{ request('payroll_year') }}">

                        <table class="table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>#SL</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Basic Salary</th>
                                    <th>House Rent</th>
                                    <th>Medical Allowance</th>
                                    <th>Other Allowance</th>
                                    <th>Deduction</th>
                                    <th>Net Salary</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($payrolls as $row)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $row->employee_code }}</td>

                                    <td>{{ $row->name }}</td>

                                    <td>{{ number_format($row->basic_salary,2) }}</td>
                                    <td>{{ number_format($row->house_rent,2) }}</td>
                                    <td>{{ number_format($row->medical_allowance,2) }}</td>
                                    <td>{{ number_format($row->other_allowance,2) }}</td>
                                    <td>{{ number_format($row->total_deduction,2) }}</td>
                                    <td>{{ number_format($row->net_salary,2) }}</td>

                                </tr>

                                <input type="hidden"
                                    name="employees[]"
                                    value="{{ $row->employee_id }}">

                                @endforeach
                                 <tr>

                                    <th colspan="9"><textarea name="remarks" class="form-control" rows="1" placeholder="Write here somthing note.."></textarea></th>

                                </tr>
                                <tr>

                                    <th colspan="3">Total</th>
                                    <th>{{number_format($payrolls->sum('basic_salary'),2) }}</th>
                                    <th>{{number_format($payrolls->sum('house_rent'),2) }}</th>
                                    <th>{{number_format($payrolls->sum('medical_allowance'),2) }}</th>
                                    <th>{{number_format($payrolls->sum('other_allowance'),2) }}</th>
                                    <th>{{number_format($payrolls->sum('total_deduction'),2) }}</th>
                                    <th><h2>{{number_format($payrolls->sum('net_salary'),2) }}</h2></th>

                                </tr>

                            </tbody>

                        </table>

                        <button class="btn btn-success">

                            <i class="fas fa-save"></i>

                            Salary Generate Confirm

                        </button>
                        <a href="{{ route('admin.salary.sheet',[
                            'payroll_month'=>request('payroll_month'),
                            'payroll_year'=>request('payroll_year')
                        ]) }}"
                        class="btn btn-primary"
                        target="_blank">
                            <i class="fas fa-print"></i>
                            Print Salary Sheet
                        </a>

                    </form>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection
