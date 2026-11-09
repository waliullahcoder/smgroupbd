@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="group_id" class="form-label"><b>Group Name</b></label>
            <select name="group_id[]" id="group_id" class="select form-select" data-placeholder="Select Group" multiple>
                <option value=""></option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}"
                        {{ old('group_id') && old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="month" class="form-label"><b>Month</b></label>
            <select name="month" id="month" class="select form-select" data-placeholder="Select Month.." required>
                @php
                    $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
                @endphp
                @foreach ($months as $key => $value)
                    <option value="{{ $key }}" {{ $key == date('m') ? 'selected' : '' }}>{{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="year" class="form-label"><b>Year</b></label>
            <select name="year" id="year" class="select form-select" data-placeholder="Select Year.." required>
                @for ($i = date('Y'); $i <= 2030; $i++)
                    <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ Route('admin.sales-target-achivement.index') }}" id="print-form" method="GET" target="_blank">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="group_id" class="group_id">
        <input type="hidden" name="month" class="month">
        <input type="hidden" name="year" class="year">
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
                data.group_id = $('#group_id').val();
                data.month = $('#month').val();
                data.year = $('#year').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                group_id = $('#group_id').val();
                month = $('#month').val();
                year = $('#year').val();
                $('.group_id').val(group_id);
                $('.month').val(month);
                $('.year').val(year);
                $('#print-form').submit();
            });
        });
    </script>
@endpush
