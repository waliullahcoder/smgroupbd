@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-edit text-warning"></i>
            Edit Employee Overtime
        </h5>

        <a href="{{ route('admin.employee-overtime.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.employee-overtime.update',$overtime->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Employee <span class="text-danger">*</span>
                    </label>

                    <select name="employee_id" class="form-select select" required>

                        <option value="">Select Employee</option>

                        @foreach($employees as $employee)

                            <option value="{{ $employee->id }}"
                                {{ $overtime->employee_id == $employee->id ? 'selected' : '' }}>

                                {{ $employee->id }} - {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Overtime Type <span class="text-danger">*</span>
                    </label>

                    <select name="overtime_type" class="form-select" required>
                        <option value="">Select Overtime Type</option>
                        <option value="Regular Overtime" {{ $overtime->overtime_type == 'Regular Overtime' ? 'selected' : '' }}>Regular Overtime</option>
                        <option value="Weekend Overtime" {{ $overtime->overtime_type == 'Weekend Overtime' ? 'selected' : '' }}>Weekend Overtime</option>
                        <option value="Holiday Overtime" {{ $overtime->overtime_type == 'Holiday Overtime' ? 'selected' : '' }}>Holiday Overtime</option>
                        <option value="Night Overtime" {{ $overtime->overtime_type == 'Night Overtime' ? 'selected' : '' }}>Night Overtime</option>
                        <option value="Emergency Overtime" {{ $overtime->overtime_type == 'Emergency Overtime' ? 'selected' : '' }}>Emergency Overtime</option>
                        <option value="Special Project Overtime" {{ $overtime->overtime_type == 'Special Project Overtime' ? 'selected' : '' }}>Special Project Overtime</option>
                        <option value="Festival Overtime" {{ $overtime->overtime_type == 'Festival Overtime' ? 'selected' : '' }}>Festival Overtime</option>
                        <option value="Other" {{ $overtime->overtime_type == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Payroll Month <span class="text-danger">*</span>
                    </label>

                    <select name="payroll_month" class="form-select" required>

                        @for($i=1;$i<=12;$i++)

                            <option value="{{ $i }}"
                                {{ $overtime->payroll_month == $i ? 'selected' : '' }}>

                                {{ date('F', mktime(0,0,0,$i,1)) }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label><b>Payroll Year</b></label>

                    <select name="payroll_year" class="form-control">

                        @for($i=date('Y')-2;$i<=date('Y')+2;$i++)

                            <option value="{{ $i }}"
                                {{ $overtime->payroll_year == $i ? 'selected' : '' }}>

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
                           name="overtime_hour"
                           class="form-control"
                           min="0"
                           step="0.01"
                           id="overtime_hour"
                           value="{{ $overtime->overtime_hour }}"
                           required>
                </div>
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Overtime Rate <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="overtime_rate"
                           class="form-control"
                           min="0"
                           step="0.01"
                           id="overtime_rate"
                           value="{{ $overtime->overtime_rate }}"
                           required>
                </div>
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Overtime Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="overtime_amount"
                           class="form-control"
                           min="0"
                           step="0.01"
                           id="overtime_amount"
                           value="{{ $overtime->overtime_amount }}"
                           required readonly>
                </div>
               

                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        Overtime Date <span class="text-danger">*</span>
                    </label>
                    <input type="date"
                           name="overtime_date"
                           class="form-control"
                           value="{{ $overtime->overtime_date }}"
                           required>
                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Pending"
                            {{ $overtime->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="Approved"
                            {{ $overtime->status=='Approved'?'selected':'' }}>
                            Approved
                        </option>

                        <option value="Paid"
                            {{ $overtime->status=='Paid'?'selected':'' }}>
                            Paid
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Remarks</label>

                    <textarea name="remarks"
                              rows="1"
                              class="form-control">{{ $overtime->remarks }}</textarea>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-warning">

                <i class="fas fa-save"></i> Update overtime

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