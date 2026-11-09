@extends('layouts.admin.app')

@section('content')

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-user-check text-success"></i>
                    Employee Attendance
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('admin.employee-attendance.store') }}" method="POST">

                    @csrf

                    <div class="row g-3">

                        <div class="col-lg-4">
                            <label><b>Employee</b></label>
                             <select name="employee_id[]" id="employee_id" class="form-select select" data-placeholder="Select Employee" multiple>
                               @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->id }} - {{ $employee->name }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-lg-4">
                            <label><b>Attendance Date</b></label>

                            <input type="date" name="attendance_date" class="form-control" value="{{ date('Y-m-d') }}"
                                required>

                        </div>

                        <div class="col-lg-4">

                            <label><b>Status</b></label>

                            <select name="attendance_status" class="form-control">

                                <option value="Present">Present</option>
                                <option value="Late">Late</option>
                                <option value="Absent">Absent</option>
                                <option value="Half Day">Half Day</option>
                                <option value="Leave">Leave</option>
                                <option value="Holiday">Holiday</option>
                                <option value="Weekend">Weekend</option>

                            </select>

                        </div>

                        <div class="col-lg-3">

                            <label><b>Check In</b></label>

                            <input type="time" name="check_in" id="check_in" class="form-control">

                        </div>

                        <div class="col-lg-3">

                            <label><b>Check Out</b></label>

                            <input type="time" name="check_out" id="check_out" class="form-control">

                        </div>

                        <div class="col-lg-2">

                            <label><b>Late (Min)</b></label>

                            <input type="number" name="late_minutes" id="late_minutes" class="form-control" readonly>

                        </div>

                        <div class="col-lg-2">

                            <label><b>OT (Min)</b></label>

                            <input type="number" name="overtime_minutes" id="overtime_minutes" class="form-control"
                                readonly>

                        </div>

                        <div class="col-lg-2">

                            <label><b>Worked Hours</b></label>

                            <input type="text" name="worked_hours" id="worked_hours" class="form-control" readonly>

                        </div>

                        <div class="col-lg-12">

                            <label><b>Remarks</b></label>

                            <textarea name="remarks" class="form-control" rows="3"></textarea>

                        </div>

                        <div class="col-lg-12">

                            <button class="btn btn-success">

                                <i class="fas fa-save"></i>

                                Save Attendance

                            </button>

                            <a href="{{ route('admin.employee-attendance.index') }}" class="btn btn-secondary">

                                Back

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

@push('js')

<script>
$(document).on('change', '#check_in, #check_out', function () {

    let inTime = $('#check_in').val();
    let outTime = $('#check_out').val();

    if (inTime && outTime) {

        // Office Time
        let officeIn = new Date("2000-01-01 09:00");
        let officeOut = new Date("2000-01-01 18:00");

        let checkIn = new Date("2000-01-01 " + inTime);
        let checkOut = new Date("2000-01-01 " + outTime);

        // Worked Hours
        let workedMinutes = (checkOut - checkIn) / 1000 / 60;
        $('#worked_hours').val((workedMinutes / 60).toFixed(2));

        // Late Minutes
        let lateMinutes = 0;
        if (checkIn > officeIn) {
            lateMinutes = Math.floor((checkIn - officeIn) / 1000 / 60);
        }
        $('#late_minutes').val(lateMinutes);

        // Overtime Minutes
        let overtimeMinutes = 0;
        if (checkOut > officeOut) {
            overtimeMinutes = Math.floor((checkOut - officeOut) / 1000 / 60);
        }
        $('#overtime_minutes').val(overtimeMinutes);

    }

});
</script>

@endpush