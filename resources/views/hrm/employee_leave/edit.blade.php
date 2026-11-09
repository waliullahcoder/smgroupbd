@extends('layouts.admin.app')

@section('content')

<div class="row g-3">
    <div class="col-12">

        <form action="{{ route('admin.employee-leave.update',$leave->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">

                <div class="card-header py-2">

                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0 text-uppercase">
                           Update Leave Application
                        </h6>

                        <div>

                            <a href="{{ route('admin.employee-leave.index') }}"
                               class="btn btn-primary btn-sm">
                                Go Back
                            </a>

                            <button class="btn btn-primary btn-sm">
                                Save
                            </button>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-3">
                            <label class="form-label"><b>Employee</b></label>

                            <select name="employee_id"  id="employee_id" class="form-select select">

                                @foreach($employees as $employee)

                                <option value="{{ $employee->id }}"
                                      data-balance="{{ $employee->leave_balance }}"
                                    {{ $leave->employee_id==$employee->id ? 'selected' : '' }}>

                                    {{ $employee->id }} - {{ $employee->name }}

                                </option>

                                @endforeach

                                </select>

                        </div>

                        <div class="col-md-3">
                            <label class="form-label">
                                <b>Leave Type</b>
                            </label>

                            <select name="leave_type"
                                    class="form-select"
                                    required>
                                <option value="Casual Leave" {{ $leave->leave_type=='Casual Leave'?'selected':'' }}>Casual Leave</option>
                                <option value="Sick Leave" {{ $leave->leave_type=='Sick Leave'?'selected':'' }}>Sick Leave</option>
                                <option value="Earn Leave" {{ $leave->leave_type=='Earn Leave'?'selected':'' }}>Earn Leave</option>
                                <option value="Annual Leave" {{ $leave->leave_type=='Annual Leave'?'selected':'' }}>Annual Leave</option>
                                <option value="Maternity Leave" {{ $leave->leave_type=='Maternity Leave'?'selected':'' }}>Maternity Leave</option>
                                <option value="Paternity Leave" {{ $leave->leave_type=='Paternity Leave'?'selected':'' }}>Paternity Leave</option>
                                <option value="Without Pay" {{ $leave->leave_type=='Without Pay'?'selected':'' }}>Without Pay</option>

                            </select>

                        </div>
                        <div class="col-md-3">

                            <label class="form-label">
                                <b>Attachment</b>
                            </label>

                            <input type="file"
                                   class="form-control"
                                   name="attachment">
                                   @if($leave->attachment)
                                    <div class="mt-2">
                                        <a href="{{ asset('uploads/employee_leave/'.$leave->attachment) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-info">
                                            <i class="fas fa-paperclip"></i> View Attachment
                                        </a>
                                    </div>
                                    @endif

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                <b>Day Type</b>
                            </label>

                            <select name="day_type" id="day_type" class="form-select">

                            <option value="Full Day" {{ $leave->day_type=='Full Day'?'selected':'' }}>Full Day</option>

                            <option value="First Half" {{ $leave->day_type=='First Half'?'selected':'' }}>First Half</option>

                            <option value="Second Half" {{ $leave->day_type=='Second Half'?'selected':'' }}>Second Half</option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                <b>From Date</b>
                            </label>

                           <input type="date"
                                id="from_date"
                                name="from_date"
                                class="form-control"
                                value="{{ $leave->from_date }}">

                        </div>

                        <div class="col-md-2">

                            <label class="form-label">
                                <b>To Date</b>
                            </label>

                           <input type="date"
                                    id="to_date"
                                    name="to_date"
                                    class="form-control"
                                    value="{{ $leave->to_date }}">
                        </div>

                        <div class="col-md-2">

                            <label class="form-label">
                                <b>Total Days</b>
                            </label>

                            <input type="number"
                                    id="total_days"
                                    name="total_days"
                                    class="form-control"
                                    value="{{ $leave->total_days }}"
                                    readonly>

                        </div>
                        <div class="col-md-2">
                            <label class="form-label">
                                <b>Leave Balance</b>
                            </label>
                            <input type="text"
                                id="leave_balance"
                                class="form-control" value="{{\App\Models\Staff::find($leave->employee_id)->leave_balance}}"
                                readonly>
                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                <b>Status</b>
                            </label>

                            <select name="status" class="form-select">

                                <option value="Pending" {{ $leave->status=='Pending'?'selected':'' }}>Pending</option>

                                <option value="Approved" {{ $leave->status=='Approved'?'selected':'' }}>Approved</option>

                                <option value="Rejected" {{ $leave->status=='Rejected'?'selected':'' }}>Rejected</option>

                                </select>

                        </div>

                        

                        <div class="col-md-6">

                            <label class="form-label">
                                <b>Remarks</b>
                            </label>

                            <textarea class="form-control"
                                    rows="5"
                                    name="remarks">{{ $leave->remarks }}</textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                <b>Reason</b>
                            </label>

                            <textarea class="form-control"
                                        rows="5"
                                        name="reason">{{ $leave->reason }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button class="btn btn-primary btn-sm">
                        Save
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection

@push('js')
<script>

$(document).ready(function () {

    calculateDays();
    getLeaveBalance();

    $('#employee_id').on('change', function () {
        getLeaveBalance();
        validateLeave();
    });

    $('#from_date,#to_date,#day_type').on('change', function () {
        calculateDays();
    });

    function getLeaveBalance() {

        let balance = $('#employee_id option:selected').data('balance') || 0;

        $('#leave_balance').val(balance);

        validateLeave();
    }

    function calculateDays() {

        let from = $('#from_date').val();
        let to = $('#to_date').val();
        let type = $('#day_type').val();

        if (from && to) {

            let start = new Date(from);
            let end = new Date(to);

            let diff = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;

            if (diff < 0) diff = 0;

            if (type == 'First Half' || type == 'Second Half') {
                diff -= 0.5;
            }

            $('#total_days').val(diff);

            validateLeave();

        } else {

            $('#total_days').val('');

        }

    }

   function validateLeave() {

    let balance = parseFloat($('#leave_balance').val()) || 0;
    let days = parseFloat($('#total_days').val()) || 0;

    if (days > balance) {

        alert('Leave balance is only ' + balance + ' day(s).');

        $('#to_date').val('');
        $('#total_days').val('');

        $('#to_date').focus();

         }
    }

});
</script>

@endpush