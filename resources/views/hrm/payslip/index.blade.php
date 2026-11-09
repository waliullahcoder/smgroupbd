@extends('layouts.admin.app')

@section('content')
<style>
.card-header {
    margin-top: 10px;
}
</style>
<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-user-check text-success"></i>
                    Generate Payslip for selected Employee and month
                </h5>

            </div>

            <div class="card-body">
                <form action="{{ route('admin.pay.slip.print') }}" method="GET">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-3">
                            <label><b>Select Employee</b></label>
                            <select name="employee_id" id="employee_id" class="form-select select"
                                data-placeholder="Select Employee">
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('employee_id', request('employee_id')) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->employee_code ?? $employee->id }} - {{ $employee->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label><b>Payroll Month</b></label>

                            <select name="payroll_month" class="form-control" required>
                                @for($i=1;$i<=12;$i++) <option value="{{ $i }}"
                                    {{ request('payroll_month', date('n')) == $i ? 'selected' : '' }}>
                                    {{ date('F', mktime(0,0,0,$i,1)) }}
                                    </option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label><b>Payroll Year</b></label>

                            <select name="payroll_year" class="form-control">
                                @for($i=date('Y')-2;$i<=date('Y')+2;$i++) <option value="{{ $i }}"
                                    {{ request('payroll_year', date('Y')) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                    </option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-lg-3" style="margin-top:35px">
                            <button class="btn btn-success">Show Previeous Data</button>
                        </div>
                    </div>
                </form>
            </div>

          




        </div>

    </div>

</div>

@endsection