@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-4 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
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
            <label for="role_id" class="form-label"><b>Role <span class="text-danger">*</span></b></label>
            <div class="custom-select">
                <select class="form-control custom-select__element" name="role_id" required id="role_id">
                    @foreach ($roles as $role)
                        @if (!Auth::user()->hasRole('Software Admin') && $role->name == 'System Admin')
                            @continue
                        @endif
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 show_on_client" style="display: none;">
            <label for="client_id" class="form-label"><b>Clients</b></label>
            <div class="custom-select">
                <select class="form-control select" name="client_id" id="client_id" data-placeholder="Select Client">
                    <option value=""></option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="name" class="form-label"><b>Name <span class="text-danger">*</span></b></label>
            <input type="text" placeholder="Name" class="form-control" id="name" name="name"
                required value="{{ old('name') }}" minlength="3">
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="user_name" class="form-label"><b>User ID <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User ID"
                required value="{{ old('user_name') }}">
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="User Email"
                value="{{ old('email') }}">
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="phone" class="form-label"><b>Phone</b></label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="User Phone"
                value="{{ old('phone') }}">
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id[]" id="area_id" class="form-select select" data-placeholder="Select Area.." multiple>
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}"
                        {{ old('area_id') && in_array($area->id, old('area_id')) ? 'selected' : '' }}>{{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="branch_id" class="form-label"><b>Branch</b></label>
            <select name="branch_id[]" id="branch_id" class="form-select select" data-placeholder="Select Branch.."
                multiple>
                <option value=""></option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}"
                        {{ old('branch_id') && in_array($branch->id, old('branch_id')) ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id[]" id="store_id" class="form-select select" data-placeholder="Select Store.." multiple>
                <option value=""></option>
            </select>
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="password" class="form-label"><b>Password <span class="text-danger">*</span></b></label>
            <input type="password" class="form-control" id="password" name="password"
                placeholder="Password" required value="{{ old('password') }}">
        </div>
        <div class="hide_on_client col-lg-4 col-sm-6">
            <label for="confirm_password" class="form-label"><b>Password <span class="text-danger">*</span></b></label>
            <input type="password" class="form-control" id="confirm_password" name="password_confirmation"
                placeholder="Confirm Password" required>
        </div>
        <div class="hide_on_client col-lg-2 col-sm-6">
            <label for="status" class="form-label"><b>Status <span class="text-danger">*</span></b></label>
            <div class="custom-select">
                <select class="form-control custom-select__element" name="status" id="status">
                    <option value="1" {{ old('status') && old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') && old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="hide_on_client col-lg-2 col-sm-6">
            <label for="is_staff" class="form-label"><b>Is Staff</b></label>
            <div class="custom-select">
                <select class="form-control custom-select__element" name="is_staff" id="is_staff">
                    <option value="0" {{ old('is_staff') && old('is_staff') == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_staff') && old('is_staff') == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>
        <div class="staff_area col-lg-4 col-sm-6" style="display: none;">
            <label for="staff_id" class="form-label"><b>Staff</b></label>
            <div class="custom-select">
                <select class="form-control select" name="staff_id" id="staff_id" data-placeholder="Select Staff">
                    <option value=""></option>
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}"
                            {{ old('staff_id') && old('staff_id') == 1 ? 'selected' : '' }}>
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
                $('#store_id option').remove();
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

            $(document).on('change', '#role_id', function(e) {
                if ($(this).val() == '11') {
                    $('.hide_on_client').hide();
                    $('.show_on_client').show();
                    $('#name').prop('required', false);
                    $('#user_name').prop('required', false);
                    $('#password').prop('required', false);
                    $('#confirm_password').prop('required', false);
                    $('#client_id').prop('required', true);
                } else {
                    $('.hide_on_client').show();
                    $('.show_on_client').hide();
                    $('#name').prop('required', true);
                    $('#user_name').prop('required', true);
                    $('#password').prop('required', true);
                    $('#confirm_password').prop('required', true);
                    $('#client_id').prop('required', false);
                    $('#client_id').val('');
                    $("#client_id").select2();
                }
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
