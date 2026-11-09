@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-lg-3 col-sm-6">
            <label for="month" class="form-label"><b>Month <span class="text-danger">*</span></b></label>
            <select name="month" id="month" class="select form-select" data-placeholder="Select Month.." required>
                @php
                    $months = [
                        '1' => 'January',
                        '2' => 'February',
                        '3' => 'March',
                        '4' => 'April',
                        '5' => 'May',
                        '6' => 'June',
                        '7' => 'July',
                        '8' => 'August',
                        '9' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December',
                    ];
                @endphp
                @foreach ($months as $key => $value)
                    <option value="{{ $key }}"
                        {{ request('month') == $key ? 'selected' : (is_null(request('month')) && $key == date('m') ? 'selected' : '') }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="year" class="form-label"><b>Year <span class="text-danger">*</span></b></label>
            <select name="year" id="year" class="select form-select" data-placeholder="Select Year.." required>
                @for ($i = date('Y'); $i <= 2030; $i++)
                    <option value="{{ $i }}"
                        {{ request('year') == $i ? 'selected' : (is_null(request('year')) && $i == date('Y') ? 'selected' : '') }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store">
                <option value=""></option>
                @foreach ($stores as $store)
                    <option value="{{ $store->id }}" {{ $store->id == request('store_id') ? 'selected' : '' }}>
                        {{ $store->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-sm-6">
            <label for="delivery_man_id" class="form-label"><b>Delivery Man</b></label>
            <select name="delivery_man_id[]" id="delivery_man_id" class="select form-select"
                data-placeholder="Select Delivery Man" multiple>
                <option value=""></option>
                @foreach ($delivery_men as $item)
                    <option value="{{ $item->id }}"
                        {{ is_array(request('delivery_man_id')) && in_array($item->id, request('delivery_man_id')) ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
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
            $(document).on('click', '.getPdf', function(e) {
                $('input[name="print"]').val('true');
                $('.filter_form').attr('target', '_blank');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="print"]').val('');
                $('.filter_form').attr('target', '_self');
            });

            $(document).on('change', '#store_id', function() {
                let store_id = $(this).val();
                $.ajax({
                    url: "{{ Route(request()->route()->getName()) }}",
                    type: "POST",
                    data: {
                        _method: 'GET',
                        store_id: store_id,
                        get_delivery_men: true,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#delivery_man_id option').remove();
                            $('#delivery_man_id').append('<option value=""></option>');
                            $.each(response.delivery_men, function(key, value) {
                                var html =
                                    `<option value="${value.id}">${value.name}</option>`;
                                $('#delivery_man_id').append(html);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
