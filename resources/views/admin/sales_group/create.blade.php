@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-md-4 col-sm-6">
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
        <div class="col-md-4 col-sm-6">
            <label for="name" class="form-label"><b>Group Name <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Group Name"
                value="{{ old('name') }}" required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="staff_id" class="form-label"><b>Team Members <span class="text-danger">*</span></b></label>
            <select name="staff_id[]" id="staff_id" class="select form-select" data-placeholder="Select Members.." multiple
                required>
                <option value=""></option>
                @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}"
                        {{ old('staff_id') && old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="team_leader" class="form-label"><b>Team Leader <span class="text-danger">*</span></b></label>
            <select name="team_leader" id="team_leader" class="select form-select" data-placeholder="Select Leader.."
                required>
                <option value=""></option>
            </select>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#staff_id', function(e) {
                let staff_id = $(this).val();
                let url = "{{ Route('admin.group.create') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _method: 'GET',
                        staff_id: staff_id
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#team_leader option').remove();
                            $('#team_leader').append('<option value=""></option>');
                            $('#team_leader').append(response.html);
                        }
                    }
                });
            });
        });
    </script>
@endpush
