@extends('layouts.admin.index_app')

@section('content')
    <div class="card-body">
        <form action="{{ Route('admin.offline-order.index') }}" id="print-form" method="GET" target="_blank">
            <input type="hidden" name="print" value="true">
            <input type="hidden" name="type" class="type">
        </form>
        @php
            $currentRouteName = \Request::route()->getName();
            $delete_link = str_replace('index', 'destroy', $currentRouteName);
        @endphp
        @if (Auth::user()->can($delete_link))
            {!! $dataTable->table([], true) !!}
        @else
            {!! $dataTable->table() !!}
        @endif
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
        $(document).ready(function() {
            const table = $('#dataTable');
            table.on('preXhr.dt', function(e, settings, data) {
                data.type = $('#type').val();
            });
            $('#dataTable').on('draw.dt', function() {
                const tooltips = document.querySelectorAll('.tt');
                tooltips.forEach(t => {
                    new bootstrap.Tooltip(t);
                });
            });

            $(document).on('change', '#type', function() {
                $('#type_filter_form').submit();
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                var type = $('#type').val();
                $('.type').val(type);
                $('#print-form').submit();
            });
        });
    </script>
@endpush
