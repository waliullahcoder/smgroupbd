@extends('layouts.admin.app')

@section('content')

<div class="row g-3">
    <div class="col-12">

        <form action="{{ route('admin.employee-leave.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="card">

                <div class="card-header py-2">

                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0 text-uppercase">
                            New Leave Application
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

                           <select name="employee_id"
                                    id="employee_id"
                                    class="form-select select"
                                    required>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                            data-balance="{{ $employee->leave_balance }}">
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
                                <option value="Casual Leave">Casual Leave</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Earn Leave">Earn Leave</option>
                                <option value="Annual Leave">Annual Leave</option>
                                <option value="Maternity Leave">Maternity Leave</option>
                                <option value="Paternity Leave">Paternity Leave</option>
                                <option value="Without Pay">Without Pay</option>

                            </select>

                        </div>
                        <div class="col-md-3">

                            <label class="form-label">
                                <b>Attachment</b>
                            </label>

                            <input type="file"
                                   class="form-control"
                                   name="attachment">

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                <b>Day Type</b>
                            </label>

                            <select name="day_type"
                                    class="form-select">

                                <option value="Full Day">
                                    Full Day
                                </option>

                                <option value="First Half">
                                    First Half
                                </option>

                                <option value="Second Half">
                                    Second Half
                                </option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                <b>From Date</b>
                            </label>

                            <input type="date"
                                class="form-control"
                                id="from_date"
                                name="from_date"
                                value="{{ date('Y-m-d') }}"
                                required>

                        </div>

                        <div class="col-md-2">

                            <label class="form-label">
                                <b>To Date</b>
                            </label>

                           <input type="date"
                                class="form-control"
                                id="to_date"
                                name="to_date"
                                required>
                        </div>

                        <div class="col-md-2">

                            <label class="form-label">
                                <b>Total Days</b>
                            </label>

                            <input type="number"
                                class="form-control"
                                id="total_days"
                                name="total_days"
                                step="0.5"
                                readonly>

                        </div>
                        <div class="col-md-2">
                            <label class="form-label">
                                <b>Leave Balance</b>
                            </label>
                            <input type="text"
                                id="leave_balance"
                                class="form-control"
                                readonly>
                        </div>

                        <div class="col-md-3">

                            <label class="form-label">
                                <b>Status</b>
                            </label>

                            <select name="status"
                                    class="form-select">

                                <option value="Pending">
                                    Pending
                                </option>

                                <option value="Approved">
                                    Approved
                                </option>

                                <option value="Rejected">
                                    Rejected
                                </option>

                            </select>

                        </div>

                        

                        <div class="col-md-6">

                            <label class="form-label">
                                <b>Remarks</b>
                            </label>

                            <textarea class="form-control"
                                      rows="5"
                                      name="remarks"></textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                <b>Reason</b>
                            </label>

                            <textarea class="form-control"
                                      rows="5"
                                      name="reason"
                                      required></textarea>

                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button type="submit" class="btn btn-primary btn-sm">
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