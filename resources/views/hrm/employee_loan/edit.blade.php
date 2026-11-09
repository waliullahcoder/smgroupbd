@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-edit text-warning"></i>
            Edit Employee loan
        </h5>

        <a href="{{ route('admin.employee-loan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.employee-loan.update',$loan->id) }}" method="POST">

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
                                {{ $loan->employee_id == $employee->id ? 'selected' : '' }}>

                                {{ $employee->id }} - {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Loan Type <span class="text-danger">*</span>
                    </label>

                    <select name="loan_type" class="form-select select" required>
                        <option value="">Select Loan Type</option>

                        <option value="Salary Advance"
                            {{ $loan->loan_type == 'Salary Advance' ? 'selected' : '' }}>
                            Salary Advance
                        </option>

                        <option value="Personal Loan"
                            {{ $loan->loan_type == 'Personal Loan' ? 'selected' : '' }}>
                            Personal Loan
                        </option>

                        <option value="Emergency Loan"
                            {{ $loan->loan_type == 'Emergency Loan' ? 'selected' : '' }}>
                            Emergency Loan
                        </option>

                        <option value="Medical Loan"
                            {{ $loan->loan_type == 'Medical Loan' ? 'selected' : '' }}>
                            Medical Loan
                        </option>

                        <option value="House Loan"
                            {{ $loan->loan_type == 'House Loan' ? 'selected' : '' }}>
                            House Loan
                        </option>

                        <option value="Vehicle Loan"
                            {{ $loan->loan_type == 'Vehicle Loan' ? 'selected' : '' }}>
                            Vehicle Loan
                        </option>

                        <option value="Education Loan"
                            {{ $loan->loan_type == 'Education Loan' ? 'selected' : '' }}>
                            Education Loan
                        </option>

                        <option value="Festival Loan"
                            {{ $loan->loan_type == 'Festival Loan' ? 'selected' : '' }}>
                            Festival Loan
                        </option>

                        <option value="Other"
                            {{ $loan->loan_type == 'Other' ? 'selected' : '' }}>
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
                                {{ $loan->payroll_month == $i ? 'selected' : '' }}>

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
                                {{ $loan->payroll_year == $i ? 'selected' : '' }}>

                                {{ $i }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Loan Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="loan_amount"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ $loan->loan_amount }}"
                           required>

                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Installment Amount <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           name="installment_amount"
                           class="form-control"
                            value="{{ $loan->installment_amount }}"
                           required>

                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Installment Total <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           name="total_installments"
                            value="{{ $loan->total_installments }}"
                           class="form-control" readonly
                           required>

                </div>


                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Loan Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                           name="loan_date"
                           class="form-control"
                           value="{{ $loan->loan_date }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Pending"
                            {{ $loan->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="Approved"
                            {{ $loan->status=='Approved'?'selected':'' }}>
                            Approved
                        </option>

                        <option value="Paid"
                            {{ $loan->status=='Paid'?'selected':'' }}>
                            Paid
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Remarks</label>

                    <textarea name="remarks"
                              rows="1"
                              class="form-control">{{ $loan->remarks }}</textarea>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-warning">

                <i class="fas fa-save"></i> Update loan

            </button>

        </div>

    </form>

</div>

@endsection