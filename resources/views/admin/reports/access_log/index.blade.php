@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="user_id" class="form-label"><b>User</b></label>
            <select name="user_id" id="user_id" class="form-select select" data-placeholder="Select User">
                <option value=""></option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label for="date_range" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date-range" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required value="{{ date('d-m-Y') . ' to ' . date('d-m-Y') }}">
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ Route('admin.access-log.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="user_id" class="user_id">
        <input type="hidden" name="date_range" class="date_range">
    </form>
    {!! $dataTable->table() !!}
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(document).ready(function() {
            const table = $('#dataTable');
            table.on('preXhr.dt', function(e, settings, data) {
                data.user_id = $('#user_id').val();
                data.date_range = $('#date_range').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var user_id = $('#user_id').val();
                var date_range = $('#date_range').val();

                $('.user_id').val(user_id);
                $('.date_range').val(date_range);
                $('#print-form').submit();
            });
        });
    </script>
@endpush
