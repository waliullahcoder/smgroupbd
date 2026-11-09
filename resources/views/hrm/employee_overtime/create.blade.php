@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Add Employee overtime
        </h5>

        <a href="{{ route('admin.employee-overtime.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.employee-overtime.store') }}" method="POST">

        @csrf

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Employee <span class="text-danger">*</span></label>
                    <select name="employee_id" class="form-select select" required>
                        <option value="">Select Employee</option>

                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->id }} - {{ $employee->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Overtime Type <span class="text-danger">*</span></label>

                    <select name="overtime_type" class="form-select" required>
                        <option value="">Select Overtime Type</option>
                        <option value="Regular Overtime">Regular Overtime</option>
                        <option value="Weekend Overtime">Weekend Overtime</option>
                        <option value="Holiday Overtime">Holiday Overtime</option>
                        <option value="Night Overtime">Night Overtime</option>
                        <option value="Emergency Overtime">Emergency Overtime</option>
                        <option value="Special Project Overtime">Special Project Overtime</option>
                        <option value="Festival Overtime">Festival Overtime</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Payroll Month <span class="text-danger">*</span></label>

                    <select name="payroll_month" class="form-select" required>

                        @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}">{{ date('F', mktime(0,0,0,$i,1)) }}</option>
                        @endfor

                    </select>

                </div>

                <div class="col-md-3 mb-3">
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

                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        Overtime Hour <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="overtime_hour"
                        id="overtime_hour"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        Rate Per Hour <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="overtime_rate"
                        id="overtime_rate"
                        class="form-control"
                        required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        Overtime Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="overtime_amount"
                        id="overtime_amount"
                        class="form-control"
                        required
                        readonly>
                </div>

                

                <div class="col-md-3 mb-3">
                    <label class="form-label">Overtime Date <span class="text-danger">*</span></label>

                    <input type="date"
                           name="overtime_date"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Paid">Paid</option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Remarks</label>

                    <textarea name="remarks"
                              rows="1"
                              class="form-control"></textarea>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save overtime
            </button>

        </div>

    </form>

</div>

@endsection
                <script>
                    document.addEventListener('DOMContentLoaded', function () {

                        const overtimeHour = document.getElementById('overtime_hour');
                        const overtimeRate = document.getElementById('overtime_rate');
                        const overtimeAmount = document.getElementById('overtime_amount');

                        function calculateOvertimeAmount() {

                            let hour = parseFloat(overtimeHour.value) || 0;
                            let rate = parseFloat(overtimeRate.value) || 0;

                            let amount = hour * rate;

                            overtimeAmount.value = amount.toFixed(2);
                        }

                        overtimeHour.addEventListener('input', calculateOvertimeAmount);
                        overtimeRate.addEventListener('input', calculateOvertimeAmount);

                    });
                </script>