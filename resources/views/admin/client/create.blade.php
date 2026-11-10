@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-6 col-sm-6">
            <label for="company_id" class="form-label"><b>Company <span class="text-danger">*</span></b></label>
            <select name="company_id" id="company_id" class="select form-select"
                    data-placeholder="Select Company" required>
                <option value=""></option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-6 col-sm-6">
            <label for="project_id" class="form-label"><b>Project <span class="text-danger">*</span></b></label>
            <select name="project_id" id="project_id" class="select form-select"
                    data-placeholder="Select Project" required disabled>
                <option value=""></option>
            </select>
        </div>
        <input type="hidden" name="reference_by" value="1">
        <input type="hidden" name="area_id" value="1">
        <input type="hidden" name="territory_id" value="1">
        <input type="hidden" name="client_category_id" value="1">
        
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


@push('js')
<script>
    $(document).ready(function () {
        $('#company_id').on('change', function () {
            var companyId = $(this).val();
            var $project = $('#project_id');

            $project.empty().append('<option value=""></option>').prop('disabled', true);

            if (!companyId) {
                $project.trigger('change');
                return;
            }

            var url = "{{ route('admin.store.projects', ':id') }}".replace(':id', companyId);

            $.get(url, function (projects) {
                $.each(projects, function (i, p) {
                    $project.append('<option value="' + p.id + '">' + $('<div>').text(p.name).html() + '</option>');
                });
                $project.prop('disabled', false).trigger('change');
            }).fail(function () {
                alert('Project load kora jayni');
            });
        });
    });
</script>
@endpush
