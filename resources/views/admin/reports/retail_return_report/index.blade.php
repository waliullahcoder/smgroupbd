@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="start_date" class="form-label"><b>Start Date</b></label>
            <input type="text" name="start_date" id="start_date" class="form-control date_picker" placeholder="Start Date"
                value="{{ date('d-m-Y') }}">
        </div>
        <div class="col-sm-6">
            <label for="end_date" class="form-label"><b>End Date</b></label>
            <input type="text" name="end_date" id="end_date" class="form-control date_picker" placeholder="End Date"
                value="{{ date('d-m-Y') }}">
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
                data.start_date = $('#start_date').val();
                data.end_date = $('#end_date').val();
            });

            $(document).on('click', '.getPdf', function(e) {
                $('input[name="print"]').val('true');
                $('.filter_form').attr('target', '_blank');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="print"]').val('');
                $('.filter_form').attr('target', '_self');
            });
        });
    </script>
@endpush
