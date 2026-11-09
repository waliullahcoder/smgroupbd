@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-4 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $data->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Name <span class="text-danger">*</span></b></label>
            <input type="text" placeholder="Name" class="form-control" id="name" name="name"
                required value="{{ $data->name }}" minlength="3">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="user_name" class="form-label"><b>User ID <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User ID"
                required value="{{ $data->user_name }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="User Email"
                value="{{ $data->email }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone</b></label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="User Phone"
                value="{{ $data->phone }}">
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="role_id" class="form-label require"><b>Role <span class="text-danger">*</span></b></label>
            <div class="custom-select">
                <select class="form-control select" name="role_id" id="role_id" required>
                    @foreach ($roles as $role)
                        @if (!Auth::user()->hasRole('Software Admin') && $role->name == 'System Admin')
                            @continue
                        @endif
                        <option value="{{ $role->id }}" {{ $data->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id[]" id="area_id" class="form-select select" data-placeholder="Select Area.." multiple>
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}"
                        {{ is_array(json_decode($data->area_id)) && in_array($area->id, json_decode($data->area_id)) ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="branch_id" class="form-label"><b>Branch</b></label>
            <select name="branch_id[]" id="branch_id" class="form-select select" data-placeholder="Select Branch.."
                multiple>
                <option value=""></option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}"
                        {{ is_array(json_decode($data->branch_id)) && in_array($branch->id, json_decode($data->branch_id)) ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id[]" id="store_id" class="form-select select" data-placeholder="Select Store.." multiple>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}"
                        {{ is_array(json_decode($data->store_id)) && in_array($store->id, json_decode($data->store_id)) ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-sm-6">
            <label for="is_staff" class="form-label"><b>Is Staff</b></label>
            <div class="custom-select">
                <select class="form-control" name="is_staff" id="is_staff">
                    <option value="1" {{ $data->is_staff == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $data->is_staff == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <div class="staff_area col-lg-4 col-sm-6" style="display: {{ $data->is_staff == 1 ? 'block' : 'none' }}">
            <label for="staff_id" class="form-label"><b>Staff</b></label>
            <div class="custom-select">
                <select class="form-control select" name="staff_id" id="staff_id" data-placeholder="Select Staff">
                    <option value=""></option>
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ $data->staff_id == $staff->id ? 'selected' : '' }}>
                            {{ $staff->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#branch_id', function(e) {
                let branch_id = $(this).val();
                let url = "{{ Route('admin.user.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        branch_id: branch_id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#store_id option').remove();
                            $('#store_id').append('<option value=""></option>');
                            $.each(response.stores, function(key, value) {
                                var option = '<option value="' + value.id + '">' + value
                                    .name + '</option>';
                                $('#store_id').append(option);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#is_staff', function(e) {
                let staff = $(this).val();
                if (staff == '1') {
                    $('.staff_area').show();
                } else {
                    $('.staff_area').hide();
                }
            });
        });
    </script>
@endpush
