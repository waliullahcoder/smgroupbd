@extends('layouts.admin.report_app')

@section('form')
    <div class="row g-3">
        <input type="hidden" name="print" value="true">
        <input type="hidden" name="filter" value="1">
        <div class="col-md-4 col-sm-6">
            <label for="month" class="form-label"><b>Month</b></label>
            <select class="form-select select" name="month" id="month" data-placeholder="Select Month.">
                @php
                    $months = [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December',
                    ];
                @endphp
                @foreach ($months as $item)
                    <option value="{{ $item }}"
                        {{ (is_null(request('month')) && $current_time->englishMonth == $item) || request('month') == $item ? 'selected' : '' }}>
                        {{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="year" class="form-label"><b>Year</b></label>
            <select class="form-select select" name="year" id="year" data-placeholder="Select Year.">
                @for ($i = 2015; $i <= 2055; $i++)
                    <option value="{{ $i }}"
                        {{ (is_null(request('year')) && $current_time->year == $i) || request('year') == $i ? 'selected' : '' }}>
                        {{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="investor_id" class="form-label"><b>Investor</b></label>
            <select name="investor_id" id="investor_id" class="form-select select" data-placeholder="Select Investor">
                <option value=""></option>
                @foreach ($investors as $investor)
                    <option value="{{ $investor->id }}" {{ request('investor_id') == $investor->id ? 'selected' : '' }}>
                        {{ $investor->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    {!! $dataTable->table(['class' => 'dataTable table align-middle table-bordered'], true) !!}
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
        $(document).ready(function() {
            const table = $('#dataTable');
            table.on('preXhr.dt', function(e, settings, data) {
                data.month = $('#month').val();
                data.year = $('#year').val();
                data.investor_id = $('#investor_id').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('true');
                $('.filter_form')[0].setAttribute("target", "_blank");
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
            });
        });
    </script>
@endpush
