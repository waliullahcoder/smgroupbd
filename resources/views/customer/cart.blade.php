@extends('layouts.frontend.app')
@section('content')
    <div class="bg-light">
        <div class="container">
            <div class="breadcrumbs py-3">
                <ul class="items">
                    <li class="item home">
                        <a href="{{ Route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="item">Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="py-4 bg-white" style="min-height: calc(100vh - 490px)">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="cart-overview">
                        <div class="relative overflow-x-auto">
                            @php
                                $cart_total_price = 0;
                                $delivery_charge = \App\Models\DeliveryCharge::first();
                                $inside_charge = @$delivery_charge->inside_charge;
                                $outside_charge = @$delivery_charge->outside_charge;
                            @endphp
                            @if (is_null($cart) || count($cart) == 0)
                                <h4 class="mb-5 text-gray-600 text-base font-semibold">No products in the cart</h4>
                            @else
                                <table class="table align-middle">
                                    <thead class="text-xs text-uppercase">
                                        <tr>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th class="text-end" width="40">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $key => $item)
                                            @php
                                                $cart_total_price += $item['price'] * $item['qty'];
                                            @endphp
                                            <tr id="cart-item-{{ $item['product_id'] . '-v-' . $item['variant_id'] }}_page">
                                                <td>
                                                    <img src="{{ file_exists($item['thumbnail']) ? asset($item['thumbnail']) : asset(@$setting->placeholder) }}"
                                                        alt="{{ $item['name'] }}" height="50">
                                                </td>
                                                <td>
                                                    <a class="label" href="{{ Route('frontend.single-product', $item['slug']) }}">{{ $item['name'] }}</a>
                                                    <div>
                                                        @foreach ($item['choose_options'] as $key => $option)
                                                            {{ $key }} : {{ $option }},
                                                            &nbsp;
                                                        @endforeach
                                                    </div>
                                                </td>
                                                 <td>
                                                    @if ($item['discount_tk'] > 0)
                                                        <div class="price-box">
                                                            <div class="special-price">
                                                                <span class="price">TK
                                                                    {{ number_format($item['price'] - $item['discount_tk'], 2, '.') }}</span>
                                                            </div>
                                                            <div class="old-price">
                                                                <span class="price">TK
                                                                    {{ number_format($item['price'], 2, '.') }}</span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="price-box">
                                                            <div class="special-price">
                                                                <span class="price">TK
                                                                    {{ number_format($item['price'], 2, '.') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="cart-quantity">
                                                        <div class="wg-quantity">
                                                            <span class="btn-quantity minus-btn"
                                                                data-id="{{ $item['product_id'] }}"
                                                                data-variant="{{ $item['variant_id'] }}">
                                                                <svg class="d-inline-block" width="9" height="1"
                                                                    viewBox="0 0 9 1" fill="currentColor">
                                                                    <path
                                                                        d="M9 1H5.14286H3.85714H0V1.50201e-05H3.85714L5.14286 0L9 1.50201e-05V1Z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                            <input type="text" class="item-qty cart-item-qty"
                                                                name="number" id="page-{{ $key }}"
                                                                value="{{ $item['qty'] }}">
                                                            <span class="btn-quantity plus-btn"
                                                                data-id="{{ $item['product_id'] }}"
                                                                data-variant="{{ $item['variant_id'] }}">
                                                                <svg class="d-inline-block" width="9" height="9"
                                                                    viewBox="0 0 9 9" fill="currentColor">
                                                                    <path
                                                                        d="M9 5.14286H5.14286V9H3.85714V5.14286H0V3.85714H3.85714V0H5.14286V3.85714H9V5.14286Z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        id="subtotal-{{ $key }}">{{ ($item['price'] - $item['discount_tk']) * $item['qty'] }}</span>
                                                </td>
                                                <td class="text-end" width="40">
                                                    <a href="javascript:void(0)" class="delete text-red-600" rel="nofollow"
                                                        title="Remove item" data-id="{{ $item['product_id'] }}"
                                                        data-variant="{{ $item['variant_id'] }}">
                                                        <i class="fal fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pt-8 mb-3">
                                    <a class="btn btn-secondary" href="{{ Route('frontend.home') }}">
                                        Continue shopping
                                    </a>
                                    <a href="{{ Route('customer.checkout') }}" class="btn btn-primary">Checkout</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border p-3">
                        <div class="cart-detailed-totals">
                            <div class="pb-3 border-bottom text-uppercase mb-4 text-md">
                                <div class="summary-label">There are
                                    {{ !is_null($cart) > 0 ? count($cart) : '0' }} items in your cart</div>
                            </div>
                            <div class="group-price">
                                <div class="d-flex justify-content-between mb-3" id="cart-subtotal-products">
                                    <span class="label text-sm text-gray-700">
                                        Total products:
                                    </span>
                                    <span class="flex text-sm font-medium"><span class="font-serif me-1">৳ </span> <span
                                            class="total_cart_price">{{ number_format($cart_total_price, 2) }}</span></span>
                                </div>
                                <div class="d-flex justify-content-between mb-3" id="cart-subtotal-shipping">
                                    <span class="label text-sm text-gray-700">
                                        Total Shipping:
                                    </span>
                                    <span class="flex text-sm font-medium"><span class="font-serif me-1">৳ </span>
                                        <span id="charge">{{ $inside_charge }}</span></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between cart-total pt-3 mt-3 border-top">
                                <span>
                                    <span class="label text-sm text-gray-700 uppercase font-bold">Total</span>
                                </span>
                                <span class="flex text-sm font-medium"><span class="font-serif me-1">৳ </span>
                                    <span class="total_with_charge"
                                        id="total_with_shipping">{{ number_format($cart_total_price + $inside_charge, 2) }}</span></span>
                            </div>
                        </div>
                        <div class="checkout cart-detailed-actions">
                            <div class="pt-4">
                                <a href="{{ Route('customer.checkout') }}"
                                    class="btn btn-primary text-center w-100">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Cart Section -->
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.cart_qty-plus', function(e) {
                e.preventDefault();
                var product_id = $(this).data('id');
                var price = parseFloat($(this).data('price'));

                var getInput = $(this).closest('.cart_action_wrapper').find('.cart_qty').val();
                getInput++;

                $(this).closest('.cart_action_wrapper').find('.cart_qty').val(getInput);
                $(this).closest('tr').find('.subtotal').text(getInput * price);
                let url = "{{ Route('customer.update-cart') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        product_id: product_id,
                        quantity: getInput,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('.cart_count').html(response.total_cart_items);
                            $('.total_cart_price').html(response.total_cart_price);
                            $('.cart_total').html(response.total_cart_price);
                        }
                    }
                });
            });

            $(document).on('click', '.cart_qty-minus', function(e) {
                e.preventDefault();
                var product_id = $(this).data('id');
                var price = parseFloat($(this).data('price'));

                var getInput = $(this).closest('.cart_action_wrapper').find('.cart_qty').val();
                if (parseInt(getInput) > 1) {
                    getInput--;
                    $(this).closest('.cart_action_wrapper').find('.cart_qty').val(getInput);
                    $(this).closest('tr').find('.subtotal').text(getInput * price);
                    let url = "{{ Route('customer.update-cart') }}";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            product_id: product_id,
                            quantity: getInput,
                        },
                        success: (response) => {
                            if (response.status == 'success') {
                                $('.cart_count').html(response.total_cart_items);
                                $('.total_cart_price').html(response.total_cart_price);
                                $('.cart_total').html(response.total_cart_price);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
