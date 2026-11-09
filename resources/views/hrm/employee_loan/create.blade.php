@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-gift text-success"></i>
            Add Employee loan
        </h5>

        <a href="{{ route('admin.employee-loan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.employee-loan.store') }}" method="POST">

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
                    <label class="form-label">loan Type <span class="text-danger">*</span></label>

                    <select name="loan_type" class="form-select" required>
                        <option value="">Select Loan Type</option>
                        <option value="Salary Advance">Salary Advance</option>
                        <option value="Personal Loan">Personal Loan</option>
                        <option value="Emergency Loan">Emergency Loan</option>
                        <option value="Medical Loan">Medical Loan</option>
                        <option value="House Loan">House Loan</option>
                        <option value="Vehicle Loan">Vehicle Loan</option>
                        <option value="Education Loan">Education Loan</option>
                        <option value="Festival Loan">Festival Loan</option>
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
                    <label class="form-label">Loan Amount <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           name="loan_amount"
                           class="form-control"
                           required>

                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Installment Amount <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           name="installment_amount"
                           class="form-control"
                           required>

                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Installment Total <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           name="total_installments"
                           class="form-control" readonly
                           required>

                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Loan Date <span class="text-danger">*</span></label>

                    <input type="date"
                           name="loan_date"
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
                <i class="fas fa-save"></i> Save loan
            </button>

        </div>

    </form>

</div>

@endsection
