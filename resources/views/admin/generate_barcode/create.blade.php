@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-md-4 col-sm-6" id="productInfo">
            <label for="product_code" class="form-label"><b>Products</b></label>
            <select id="product_code" class="select form-select" data-placeholder="Select Product">
                <option value="">Select Product</option>
                {{-- @foreach ($products as $product)
                    <option value="{{ $product->code }}" data-name="{{ $product->name }}"
                        data-price="{{ $product->price->online_price }}">{{ $product->name }} -
                        {{ $product->code }}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="quantity" class="form-label"><b>Quantity</b></label>
            <input type="number" class="form-control" id="quantity" name="quantity" step="1" placeholder="Quantity">
        </div>
        <div class="col-md-4 col-sm-6">
            <label class="form-label"><b>Add</b></label>
            <button type="button" class="btn btn-xs btn-primary w-100 px-2 py-2" id="add_item">Add Item</button>
        </div>
        <div class="col-12">
            <div class="col-12">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white">
                        <tr>
                            <th class="text-center" width="30">SL#</th>
                            <th class="text-nowrap">Product Name</th>
                            <th class="text-nowrap">Product Code</th>
                            <th>Quantity</th>
                            <th class="text-center" width="50"><i class="far fa-trash-alt"></i></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            initCustomerSelect2('#product_code', '#productInfo');

            function initCustomerSelect2(selector, parentModal) {
                $(selector).select2({
                    dropdownParent: $(parentModal),
                    placeholder: 'Select product', // ✅ REQUIRED
                    allowClear: true,
                    minimumInputLength: 0,

                    ajax: {
                        url: "{{ route('admin.product.search') }}",
                        type: "GET",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term || ''
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },

                    templateResult: function(item) {
                        return item.text || '';
                    },

                    templateSelection: function(item) {
                        if (!item.id) return item.text;

                        let $opt = $(item.element);
                        $opt.attr('data-name', item.name);
                        $opt.attr('data-price', item.price);

                        return item.text;
                    }
                });
            }

            $(document).on('click', '#add_item', function(e) {
                let product_code = $('#product_code').val();
                let quantity = $('#quantity').val();
                if (product_code == '') {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Please Select a product First!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }
                if (quantity == '' || quantity == 0) {
                    Swal.fire({
                        width: "22rem",
                        position: 'top-right',
                        toast: true,
                        text: "Please take some quantity!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                }

                let product_name = $('#product_code option:selected').data('name');
                let price = $('#product_code option:selected').data('price');
                var existing_key = $("#tbody tr").length;
                $('#product_code option:selected').remove();
                var tr =
                    `<tr id="${product_code}">
                        <td class="text-center">
                            <b class="serial">${(existing_key+1)}</b>
                            <input type="hidden" name="price[]" value="${price}">
                        </td>
                        <td><input type="text" class="form-control" placeholder="Product Name" name="product_name[]" readonly value="${product_name}"></td>
                        <td><input type="text" class="form-control" placeholder="Product Code" name="product_code[]" readonly value="${product_code}"></td>
                        <td><input type="number" class="form-control" placeholder="Quantity" name="quantity[]" value="${quantity}"></td>
                        <td class="text-center"><button type="button" class="btn btn-xs btn-outline-danger remove_item mnw-auto px-2" data-name="${product_name}" data-code="${product_code}"><i class="far fa-trash-alt"></i></button></td>
                    </tr>`;
                $('#tbody').append(tr);
            });

            $(document).on('click', '.remove_item', function(e) {
                let product_code = $(this).data('code');
                let product_name = $(this).data('name');
                var option =
                    `<option value="${product_code}" data-name="${product_name}">${product_name} - ${product_code}</option>`;
                $('#product_code').append(option);
                $('#' + product_code).remove();
            });
        });
    </script>
@endpush

{{--
<!DOCTYPE html>
<html>

<head>
    <title>Barcode Scan & Print</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        input {
            width: 300px;
            padding: 10px;
            font-size: 18px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            width: 350px;
        }

        .barcode svg rect {
            fill: darkblue;
            /* 🎨 COLOR HERE */
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>

<body>

    <h2>Barcode Scan</h2>

    <input type="text" id="barcode" autofocus placeholder="Scan barcode here">

    <div id="result"></div>

    <script>
        document.getElementById('barcode').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();

                fetch("{{ route('admin.generate-barcode.index') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            barcode: this.value
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById('result').innerHTML = `
                    <div class="card print-area">
                        <h3>${data.product.name}</h3>
                        <p>Price: ${data.product.price.online_price}</p>

                        <div class="barcode">
                            {!! DNS1D::getBarcodeSVG('_BARCODE_', 'C128', 2, 80) !!}
                        </div>

                        <p>${data.product.code}</p>
                        <button onclick="window.print()">Print</button>
                    </div>
                `.replace('_BARCODE_', data.product.code);
                        } else {
                            alert(data.message);
                        }
                    });

                this.value = '';
            }
        });
    </script>

</body>

</html> --}}
