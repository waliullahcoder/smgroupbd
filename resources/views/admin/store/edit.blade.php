@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <input type="hidden" name="prefix" value="{{ $data->code ?? 'str' }}">

        <div class="col-lg-4 col-sm-6">
            <label for="company_id" class="form-label"><b>Company <span class="text-danger">*</span></b></label>
            <select name="company_id" id="company_id" class="select form-select"
                    data-placeholder="Select Company" required>
                <option value=""></option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}"
                        {{ old('company_id', $data->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4 col-sm-6">
            <label for="project_id" class="form-label"><b>Project <span class="text-danger">*</span></b></label>
            <select name="project_id" id="project_id" class="select form-select"
                    data-placeholder="Select Project" required>
                <option value=""></option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}"
                        {{ old('project_id', $data->branch_id) == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4 col-sm-6">
                <label for="store_name" class="form-label"><b>Store Name <span class="text-danger">*</span></b></label>
                <input type="text" class="form-control" id="store_name" name="store_name"
                    value="{{ old('store_name', $data->store_name) }}" placeholder="Store Name">
            </div>

            <div class="col-lg-4 col-sm-6">
                <label for="item_name" class="form-label"><b>Item Name</b></label>
                <input type="text" class="form-control" id="item_name" name="item_name"
                    value="{{ old('item_name', $data->item_name) }}" placeholder="Item Name">
            </div>

            <div class="col-lg-4 col-sm-6">
                <label for="assign_name" class="form-label"><b>Assign Name</b></label>
                <input type="text" class="form-control" id="assign_name" name="assign_name"
                    value="{{ old('assign_name', $data->assign_name) }}" placeholder="Assign Name">
            </div>

            <div class="col-lg-4 col-sm-6">
                <label for="delivery_qnty" class="form-label"><b>Delivery Quantity</b></label>
                <input type="number" step="any" min="0" class="form-control" id="delivery_qnty" name="delivery_qnty"
                    value="{{ old('delivery_qnty', $data->delivery_qnty) }}" placeholder="Delivery Quantity">
            </div>

            <div class="col-lg-4 col-sm-6">
                <label for="delivery_date" class="form-label"><b>Delivery Date</b></label>
                <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                    value="{{ old('delivery_date', $data->delivery_date ? \Carbon\Carbon::parse($data->delivery_date)->format('Y-m-d') : '') }}">
            </div>

            <div class="col-lg-4 col-sm-6">
                <label for="received_qnty" class="form-label"><b>Received Quantity</b></label>
                <input type="number" step="any" min="0" class="form-control" id="received_qnty" name="received_qnty"
                    value="{{ old('received_qnty', $data->received_qnty) }}" placeholder="Received Quantity">
            </div>

            <div class="col-lg-4 col-sm-6">
                <label for="received_date" class="form-label"><b>Received Date</b></label>
                <input type="date" class="form-control" id="received_date" name="received_date"
                    value="{{ old('received_date', $data->received_date ? \Carbon\Carbon::parse($data->received_date)->format('Y-m-d') : '') }}">
            </div>

        <div class="col-lg-4 col-sm-6">
            <label for="address" class="form-label"><b>Address <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="address" name="address" required
                value="{{ old('address', $data->address) }}" placeholder="Address">
        </div>

        <div class="col-lg-4 col-sm-6">
            <label for="remarks" class="form-label"><b>Remarks <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="remarks" name="remarks" required
                value="{{ old('remarks', $data->remarks) }}" placeholder="Remarks">
        </div>
    </div>
@endsection

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