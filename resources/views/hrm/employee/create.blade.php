@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-4 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
                    <option value=""></option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"
                            {{ old('company_id') && old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-lg-4 col-sm-6">
            <label for="branch_id" class="form-label"><b>Branch Name <span class="text-danger">*</span></b></label>
            <select name="branch_id" id="branch_id" class="select form-select" data-placeholder="Select Branch" required>
                <option value=""></option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}"
                        {{ old('branch_id') && old('branch_id') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="type" class="form-label"><b>Department <span class="text-danger">*</span></b></label>
            <div class="custom-select">
                <select class="form-control custom-select__element" name="type" id="type" required>
                    <option value="general" {{ old('type') && old('type') == 'general' ? 'selected' : '' }}>General</option>
                    <option value="sales" {{ old('type') && old('type') == 'sales' ? 'selected' : '' }}>Sales</option>
                    <option value="driver" {{ old('type') && old('type') == 'driver' ? 'selected' : '' }}>Driver</option>
                    <option value="delivery_man" {{ old('type') && old('type') == 'delivery_man' ? 'selected' : '' }}>
                        Delivery Man
                    </option>
                    <option value="marketing" {{ old('type') && old('type') == 'marketing' ? 'selected' : '' }}>
                        Marketing
                    </option>
                    <option value="software" {{ old('type') && old('type') == 'software' ? 'selected' : '' }}>
                        Software
                    </option>
                    <option value="digital" {{ old('type') && old('type') == 'digital' ? 'selected' : '' }}>
                        Digital Marketing
                    </option>
                    <option value="hr_and_admin" {{ old('type') && old('type') == 'hr_and_admin' ? 'selected' : '' }}>
                        HR & Admin
                    </option>
                    <option value="office_assistant" {{ old('type') && old('type') == 'office_assistant' ? 'selected' : '' }}>
                        Office Asistant
                    </option>
                    <option value="accounts" {{ old('type') && old('type') == 'accounts' ? 'selected' : '' }}>
                        Accounts
                    </option>
                    <option value="engineering" {{ old('type') && old('type') == 'engineering' ? 'selected' : '' }}>
                        Engineering
                    </option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="code" class="form-label"><b>Code <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="code" name="code" required
                value="{{ old('code') }}" placeholder="code">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Staff Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" required
                value="{{ old('name') }}" placeholder="Staff Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="short_name" class="form-label"><b>Display Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="short_name" name="short_name" required
                value="{{ old('short_name') }}" placeholder="Display Name">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="designation" class="form-label"><b>Designation</b></label>
            <input type="text" class="form-control" id="designation" name="designation"
                value="{{ old('designation') }}" placeholder="Designation">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="joining_date" class="form-label"><b>Joining Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="joining_date" name="joining_date"
                required value="{{ date('d-m-Y', strtotime(old('joining_date'))) }}" placeholder="Joining Date">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email') }}" placeholder="Email">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone No.</b></label>
            <input type="text" class="form-control" id="phone" name="phone"
                value="{{ old('phone') }}" placeholder="Phone">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="national_id" class="form-label"><b>National ID</b></label>
            <input type="number" class="form-control" id="national_id" name="national_id"
                value="{{ old('national_id') }}" placeholder="National ID">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="ac_no" class="form-label"><b>A/C No.</b></label>
            <input type="text" class="form-control" id="ac_no" name="ac_no"
                value="{{ old('ac_no') }}" placeholder="A/C No.">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="ac_branch" class="form-label"><b>A/C Branch</b></label>
            <input type="text" class="form-control" id="ac_branch" name="ac_branch"
                value="{{ old('ac_branch') }}" placeholder="A/C Branch">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address"
                value="{{ old('address') }}">
        </div>

        <!-- Salary Structure -->
        <div class="col-lg-2 col-sm-3">
            <label for="basic_salary" class="form-label"><b>Basic Salary</b></label>
            <input type="number" class="form-control" id="basic_salary" name="basic_salary"
                value="{{ old('basic_salary') }}" placeholder="ex. 200000">
        </div>
        <div class="col-lg-2 col-sm-3">
            <label for="house_rent" class="form-label"><b>House Rent</b></label>
            <input type="number" class="form-control" id="house_rent" name="house_rent"
                value="{{ old('house_rent') }}" placeholder="ex. 10000">
        </div>
        
        <div class="col-lg-2 col-sm-3">
            <label for="medical_allowance" class="form-label"><b>Medical Allowance</b></label>
            <input type="number" class="form-control" id="medical_allowance" name="medical_allowance"
                value="{{ old('medical_allowance') }}" placeholder="ex. 5000">
        </div>
        <div class="col-lg-2 col-sm-3">
            <label for="others" class="form-label"><b>Others</b></label>
            <input type="number" class="form-control" id="others" name="others"
                value="{{ old('others') }}" placeholder="ex. 1000">
        </div>
        <div class="col-lg-2 col-sm-3">
            <label for="deducted" class="form-label"><b>Provident / Deducted</b></label>
            <input type="number" class="form-control" id="deducted" name="deducted"
                value="{{ old('deducted') }}" placeholder="ex. 1000">
        </div>
        
        <div class="col-lg-2 col-sm-3">
            <label for="increment_percent" class="form-label"><b>Increment %</b></label>
            <input type="number" class="form-control" id="increment_percent" name="increment_percent"
                value="{{ old('increment_percent') }}" placeholder="ex. 1000">
        </div>
        <div class="col-lg-2 col-sm-3">
            <label for="increment_amount" class="form-label"><b>Increment Amount</b></label>
            <input type="number" class="form-control" id="increment_amount" name="increment_amount"
                value="{{ old('increment_amount') }}" placeholder="ex. 1000">
        </div>
        <div class="col-lg-2 col-sm-3">
            <label for="total_salary" class="form-label"><b>Total Salary</b></label>
            <input type="number" class="form-control" id="total_salary" name="total_salary"
                value="" readonly>
        </div>
        
        
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".date_picker").datepicker({
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true,
            }).datepicker('setDate', 'today');

            $(document).on('change', '#company_id', function(e) {
                let company_id = $(this).val();
                let url = "{{ Route('admin.staff.create') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'GET',
                        company_id: company_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#branch_id option').remove();
                            $('#branch_id').append('<option value=""></option>');
                            $.each(response.branches, function(key, value) {
                                var html = '<option value="' + value.id + '">' + value
                                    .name + '</option>';
                                $('#branch_id').append(html);
                            });
                        }
                    }
                });
            });
        });

        // salary structure

         $(document).ready(function () {

                function num(id) {
                    return parseFloat($(id).val()) || 0;
                }

                function calculateSalary() {

                    let basic      = num('#basic_salary');
                    let houseRent  = num('#house_rent');
                    let medical    = num('#medical_allowance');
                    let others     = num('#others');
                    let deducted   = num('#deducted');
                    let incrementP = num('#increment_percent');

                    // Increment Amount
                    let incrementAmount = (basic * incrementP) / 100;
                    $('#increment_amount').val(incrementAmount.toFixed(2));

                    // Total Salary
                    let totalSalary =
                        basic +
                        houseRent +
                        medical +
                        others +
                        incrementAmount -
                        deducted;

                    $('#total_salary').val(totalSalary.toFixed(2));
                }

                $(document).on('keyup change', '#basic_salary, #house_rent, #medical_allowance, #others, #deducted, #increment_percent', function () {
                    calculateSalary();
                });

                calculateSalary();
            });


    </script>
@endpush
