@extends('layouts.admin.app')

@section('title','Edit Employee Bonus')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-edit text-warning"></i>
            Edit Employee Bonus
        </h5>

        <a href="{{ route('admin.employee-bonus.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.employee-bonus.update',$bonus->id) }}" method="POST">

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
                                {{ $bonus->employee_id == $employee->id ? 'selected' : '' }}>

                                {{ $employee->id }} - {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Bonus Type <span class="text-danger">*</span>
                    </label>

                    <select name="bonus_type" class="form-select" required>

                        <option value="">Select Bonus Type</option>

                        <option value="Festival"
                            {{ $bonus->bonus_type=='Festival'?'selected':'' }}>
                            Festival
                        </option>

                        <option value="Performance"
                            {{ $bonus->bonus_type=='Performance'?'selected':'' }}>
                            Performance
                        </option>

                        <option value="Yearly"
                            {{ $bonus->bonus_type=='Yearly'?'selected':'' }}>
                            Yearly
                        </option>

                        <option value="Eid"
                            {{ $bonus->bonus_type=='Eid'?'selected':'' }}>
                            Eid
                        </option>

                        <option value="Puja"
                            {{ $bonus->bonus_type=='Puja'?'selected':'' }}>
                            Puja
                        </option>

                        <option value="Other"
                            {{ $bonus->bonus_type=='Other'?'selected':'' }}>
                            Other
                        </option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Payroll Month <span class="text-danger">*</span>
                    </label>

                    <select name="payroll_month" class="form-select" required>

                        @for($i=1;$i<=12;$i++)

                            <option value="{{ $i }}"
                                {{ $bonus->payroll_month == $i ? 'selected' : '' }}>

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
                                {{ $bonus->payroll_year == $i ? 'selected' : '' }}>

                                {{ $i }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Bonus Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="amount"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ $bonus->amount }}"
                           required>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Payment Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                           name="payment_date"
                           class="form-control"
                           value="{{ $bonus->payment_date }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Pending"
                            {{ $bonus->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="Approved"
                            {{ $bonus->status=='Approved'?'selected':'' }}>
                            Approved
                        </option>

                        <option value="Paid"
                            {{ $bonus->status=='Paid'?'selected':'' }}>
                            Paid
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Remarks</label>

                    <textarea name="remarks"
                              rows="1"
                              class="form-control">{{ $bonus->remarks }}</textarea>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-warning">

                <i class="fas fa-save"></i> Update Bonus

            </button>

        </div>

    </form>

</div>

@endsection