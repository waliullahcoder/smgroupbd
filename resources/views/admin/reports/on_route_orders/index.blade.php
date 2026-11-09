@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-12">
            <label for="delivery_man_id" class="form-label"><b>Delivery Man <span class="text-danger">*</span></b></label>
            <select name="delivery_man_id" id="delivery_man_id" class="select form-select"
                data-placeholder="Select Delivery Man" required>
                <option value=""></option>
                @foreach ($delivery_men as $item)
                    <option value="{{ $item->id }}" {{ request('delivery_man_id') == $item->id ? 'selected' : '' }}>
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
                var delivery_man_id = $('#delivery_man_id').val();
                if (delivery_man_id == '') {
                    Swal.fire({
                        toast: true,
                        width: "28rem",
                        position: 'top-right',
                        text: "Please select a delivery man!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                    return;
                }
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
