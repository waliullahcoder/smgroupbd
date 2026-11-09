@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
                    <option value=""></option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-sm-6">
            <label for="reference_by" class="form-label"><b>Reference By <span class="text-danger">*</span></b></label>
            <select name="reference_by" id="reference_by" class="select form-select" data-placeholder="Select Reference"
                required>
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ old('reference_by') == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="area_id" class="form-label"><b>Area <span class="text-danger">*</span></b></label>
            <select name="area_id" id="area_id" class="select form-select" data-placeholder="Select Area" required>
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="territory_id" class="form-label"><b>Territory <span class="text-danger">*</span></b></label>
            <select name="territory_id" id="territory_id" class="select form-select" data-placeholder="Select Territory"
                required>
                <option value=""></option>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="client_category_id" class="form-label"><b>Client Type</b></label>
            <select name="client_category_id" id="client_category_id" class="select form-select"
                data-placeholder="Select Client Type">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('client_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="code" class="form-label"><b>Client Code <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $code }}"
                placeholder="Client Code" required>
        </div>
        <div class="col-sm-6">
            <label for="name" class="form-label"><b>Client Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                placeholder="Client Name" required>
        </div>
        <div class="col-sm-6">
            <label for="contact_person" class="form-label"><b>Contact Person</b></label>
            <input type="text" class="form-control" id="contact_person" name="contact_person"
                value="{{ old('contact_person') }}" placeholder="Contact Person">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                placeholder="Contact Email">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="phone" class="form-label"><b>Phone Number <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                placeholder="Contact Number" required>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="address" class="form-label"><b>Address</b></label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"
                placeholder="Contact Address">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="bin_no" class="form-label"><b>BIN No.</b></label>
            <input type="number" class="form-control" id="bin_no" name="bin_no" value="{{ old('bin_no') }}"
                placeholder="BIN NO.">
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="credit_limit" class="form-label"><b>Credit Limit</b></label>
            <input type="number" class="form-control" id="credit_limit" name="credit_limit"
                value="{{ old('credit_limit') }}" placeholder="Credit Limit">
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="coa_setup_id" class="form-label"><b>COA Name</b></label>
            <select name="coa_setup_id" id="coa_setup_id" class="select form-select" data-placeholder="Select COA Name">
                <option value=""></option>
                @foreach ($coas as $coa)
                    <option value="{{ $coa->id }}" {{ old('coa_setup_id') == $coa->id ? 'selected' : '' }}>
                        {{ $coa->head_name }} - {{ $coa->head_code }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#is_chain', function() {
                if ($(this).is(':checked')) {
                    $('#chain_client').show();
                } else {
                    $('#chain_client').hide();
                }
            });

            $(document).on('change', '#area_id', function(e) {
                let area_id = $(this).val();
                let url = "{{ Route('admin.client.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        area_id: area_id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#territory_id option').remove();
                            $('#territory_id').append('<option value=""></option>');
                            $.each(response.territories, function(key, value) {
                                var option = '<option value="' + value.id + '">' + value
                                    .name + '</option>';
                                $('#territory_id').append(option);
                            });
                        }
                    }
                });
            });
        })
    </script>
@endpush
