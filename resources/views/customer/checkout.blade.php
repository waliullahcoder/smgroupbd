@extends('layouts.frontend.app')
@section('content')
    <div class="bg-light">
        <div class="container">
            <div class="breadcrumbs py-3">
                <ul class="items">
                    <li class="item home">
                        <a href="{{ Route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="item">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="py-4">
        <div class="container">
            <form action="{{ Route('customer.checkout') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="accordion checkout-accordion" id="accordionExample">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="step-title">
                                            <span class="step-number">1</span>
                                            <span class="title">Addresses</span>
                                        </div>
                                    </button>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body p-3">
                                        <div class="content">
                                            <div class="d-flex gap-2 mb-3">
                                                <input type="hidden" name="shipping_address_id"
                                                    value="{{ $shipping_address ? $shipping_address->id : '' }}">
                                                <div class="d-flex gap-2">
                                                    <input class="form-check-input" type="radio" id="home"
                                                        name="address_type"
                                                        {{ ($shipping_address && $shipping_address->address_type == 'home') || is_null($shipping_address) ? 'checked' : '' }}
                                                        value="home">
                                                    <label class="form-check-label text-sm" for="home">
                                                        Home
                                                    </label>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <input class="form-check-input" type="radio" id="office"
                                                        {{ $shipping_address && $shipping_address->address_type == 'office' ? 'checked' : '' }}
                                                        name="address_type" value="office">
                                                    <label class="form-check-label text-sm" for="office">
                                                        Office
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label" for="name">Full
                                                        Name</label>
                                                    <input type="text" id="name" name="name"
                                                        placeholder="Full Name" class="form-control rounded-0"
                                                        value="{{ $shipping_address ? $shipping_address->name : old('name') }}"
                                                        required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="phone">Phone
                                                        Number</label>
                                                    <input type="number" id="phone" name="phone"
                                                        placeholder="Phone Number" class="form-control rounded-0"
                                                        value="{{ $shipping_address ? $shipping_address->phone : old('phone') }}"
                                                        required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="email">Email
                                                        Address</label>
                                                    <input type="email" id="email" name="email"
                                                        placeholder="Email Address" class="form-control rounded-0"
                                                        value="{{ $shipping_address ? $shipping_address->email : old('email') }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="division">Division</label>
                                                    <select name="division" id="division"
                                                        class="form-select rounded-0 select2 text-sm" required>
                                                        <option value="">-- Select Division --</option>
                                                        @foreach ($divisions as $division)
                                                            <option value="{{ $division->id }}"
                                                                {{ $shipping_address && $shipping_address->division_id == $division->id ? 'selected' : '' }}>
                                                                {{ $division->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="district">District </label>
                                                    <select name="district" id="district"
                                                        class="form-select rounded-0 select2 text-sm" required>
                                                        @if ($selected_district)
                                                            <option value="{{ $selected_district->id }}" selected>
                                                                {{ $selected_district->name }}</option>
                                                        @else
                                                            <option value="">-- Select District --</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="upozila">Upozila </label>
                                                    <select name="upozila" id="upozila" required
                                                        class="form-select rounded-0 select2 text-sm">
                                                        @if ($selected_upozila)
                                                            <option value="{{ $selected_upozila->id }}" selected>
                                                                {{ $selected_upozila->name }}</option>
                                                        @else
                                                            <option value="">-- Select Upozila --</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="street">Street </label>
                                                    <textarea name="street" id="street" class="form-control rounded-0" cols="30" rows="2" required
                                                        placeholder="Street Address">{{ $shipping_address ? $shipping_address->street : '' }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="delivery_area">Delivery Area</label>
                                                    <select name="delivery_area" id="delivery_area" required
                                                        class="form-select rounded-0 text-sm select2">
                                                        <option value="inside_city">Inside City</option>
                                                        <option value="outside_city">Outside City</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-top mt-1">
                                <div class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="step-title">
                                            <span class="step-number">2</span>
                                            <span class="title">Payment</span>
                                        </div>
                                    </button>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body p-3">
                                        <div class="content">
                                            <ul class="payment-methods mb-4">
                                                <li>
                                                    <div class="pay-wrapper">
                                                        <input id="cash" type="radio" name="payment_method"
                                                            class="payment_method" value="Cash on Delivery" checked>
                                                        <span>Cash on Delivery</span>
                                                        <label class="pay_label" for="cash"></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="pay-wrapper">
                                                        <ul class="d-flex flex-wrap gap-2">
                                                            <li><img src="{{ asset('frontend/assets/images/payments/1.png') }}"
                                                                    alt="Icon" height="30">
                                                            </li>
                                                            <li><img src="{{ asset('frontend/assets/images/payments/2.png') }}"
                                                                    alt="Icon" height="30">
                                                            </li>
                                                            <li><img src="{{ asset('frontend/assets/images/payments/3.png') }}"
                                                                    alt="Icon" height="30">
                                                            </li>
                                                            <li><img src="{{ asset('frontend/assets/images/payments/4.png') }}"
                                                                    alt="Icon" height="30">
                                                            </li>
                                                        </ul>
                                                        <input id="card" type="radio" name="payment_method"
                                                            class="payment_method" value="Online Payment">
                                                        <label class="pay_label" for="card"></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="pay-wrapper">
                                                        <ul class="flex flex-wrap gap-2">
                                                            <li><img class="h-[40px]"
                                                                    src="{{ asset('frontend/assets/images/payments/bkash.png') }}"
                                                                    height="40" alt="Logo">
                                                            </li>
                                                        </ul>
                                                        <input id="bkash" type="radio" name="payment_method"
                                                            class="payment_method" value="bkash Payment">
                                                        <label class="pay_label" for="bkash"></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="pay-wrapper">
                                                        <ul class="flex flex-wrap gap-2">
                                                            <li><img class="h-[40px]"
                                                                    src="{{ asset('frontend/assets/images/payments/nagad.png') }}"
                                                                    height="40" alt="Logo">
                                                            </li>
                                                        </ul>
                                                        <input id="nagad" type="radio" name="payment_method"
                                                            class="payment_method" value="Nagad Payment">
                                                        <label class="pay_label" for="nagad"></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="pay-wrapper">
                                                        <ul class="flex flex-wrap gap-2">
                                                            <li><img class="h-[40px]"
                                                                    src="{{ asset('frontend/assets/images/payments/rocket.png') }}"
                                                                    height="40" alt="Logo">
                                                            </li>
                                                        </ul>
                                                        <input id="rocket" type="radio" name="payment_method"
                                                            class="payment_method" value="Rocket Payment">
                                                        <label class="pay_label" for="rocket"></label>
                                                    </div>
                                                </li>
                                            </ul>
                                            <h4 class="text-base text-red-600 uppercase font-semibold mb-3">Please check
                                                your order
                                                before payment</h4>
                                            <div class="order-confirmation-table mb-4">
                                                <div class="relative overflow-x-auto">
                                                    @php
                                                        $cart_total_price = 0;
                                                        $delivery_charge = \App\Models\DeliveryCharge::first();
                                                        $inside_charge = @$delivery_charge->inside_charge;
                                                        $outside_charge = @$delivery_charge->outside_charge;
                                                    @endphp
                                                    @if (is_null($cart) || count($cart) == 0)
                                                        <h4 class="mb-5 text-gray-600 text-base font-semibold">No products
                                                            in the cart</h4>
                                                    @else
                                                        <table class="table align-middle">
                                                            <thead class="text-xs text-uppercase">
                                                                <tr>
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
                                                                        $cart_total_price +=
                                                                            $item['price'] * $item['qty'];
                                                                    @endphp
                                                                    <tr
                                                                        id="cart-item-{{ $item['product_id'] . '-v-' . $item['variant_id'] }}_page">
                                                                        <td>
                                                                            <a class="label"
                                                                                href="{{ Route('frontend.single-product', $item['slug']) }}">{{ $item['name'] }}</a>
                                                                            <div>
                                                                                @foreach ($item['choose_options'] as $key => $option)
                                                                                    {{ $key }} :
                                                                                    {{ $option }},
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
                                                                                        <svg class="d-inline-block"
                                                                                            width="9" height="1"
                                                                                            viewBox="0 0 9 1"
                                                                                            fill="currentColor">
                                                                                            <path
                                                                                                d="M9 1H5.14286H3.85714H0V1.50201e-05H3.85714L5.14286 0L9 1.50201e-05V1Z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </span>
                                                                                    <input type="text"
                                                                                        class="item-qty cart-item-qty"
                                                                                        name="number"
                                                                                        id="page-{{ $key }}"
                                                                                        value="{{ $item['qty'] }}">
                                                                                    <span class="btn-quantity plus-btn"
                                                                                        data-id="{{ $item['product_id'] }}"
                                                                                        data-variant="{{ $item['variant_id'] }}">
                                                                                        <svg class="d-inline-block"
                                                                                            width="9" height="9"
                                                                                            viewBox="0 0 9 9"
                                                                                            fill="currentColor">
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
                                                                            <a href="javascript:void(0)"
                                                                                class="delete text-red-600" rel="nofollow"
                                                                                title="Remove item"
                                                                                data-id="{{ $item['product_id'] }}"
                                                                                data-variant="{{ $item['variant_id'] }}">
                                                                                <i class="fal fa-times"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex gap-2 items-center mb-4">
                                                <input id="terms_conditions" class="form-check-input"
                                                    name="terms_conditions" required type="checkbox" value="1">
                                                <label class="form-check-label" for="terms_conditions"> I agree to the <a
                                                        class="text-primary" href="#">terms of
                                                        service</a> and will adhere to
                                                    them unconditionally.
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary px-5">Check
                                                out</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white border p-3">
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
                                        <span class="flex text-sm font-medium"><span class="font-serif me-1">৳ </span>
                                            <span
                                                class="total_cart_price">{{ number_format($cart_total_price, 2) }}</span></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3" id="cart-subtotal-shipping">
                                        <span class="label text-sm text-gray-700">
                                            Total Shipping:
                                        </span>
                                        <input type="hidden" name="inside_charge" id="inside_charge"
                                            value="{{ $inside_charge }}">
                                        <input type="hidden" name="outside_charge" id="outside_charge"
                                            value="{{ $outside_charge }}">
                                        <span class="flex text-sm font-medium"><span class="font-serif me-1">৳ </span>
                                            <span
                                                id="charge">{{ number_format($inside_charge, 2, '.', '') }}</span></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between cart-total pt-3 mt-3 border-top">
                                    <span>
                                        <span class="label text-sm text-gray-700 uppercase font-bold">Total</span>
                                    </span>
                                    <span class="flex text-sm font-medium"><span class="font-serif me-1">৳ </span>
                                        <span class="total_with_charge"
                                            id="total_with_shipping">{{ number_format($cart_total_price + $inside_charge, 2, '.', '') }}</span></span>
                                </div>
                            </div>
                            <div class="checkout cart-detailed-actions">
                                <div class="pt-4">
                                    <button type="submit" class="btn-primary btn px-5 w-100">Check
                                        out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#division', function(e) {
                let id = $(this).val();
                let url = "{{ Route('customer.checkout') }}";
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                        id: id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var selected_district =
                                "{{ $shipping_address ? $shipping_address->district_id : '' }}";
                            $('#district').html('');
                            $('#upozila').html('');
                            $('#upozila').append(
                                '<option value="" selected>-- Select Upozila --</option>');
                            $('#district').append(
                                '<option value="" selected>-- Select District --</option>');
                            $.each(response.locations, function(key, value) {
                                var option = '<option value="' + value.id + '"';
                                if (selected_district != '' && selected_district ==
                                    value.id) {
                                    option += ' selected';
                                }
                                option += '>' + value.name + '</option>';
                                $('#district').append(option);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#district', function(e) {
                let id = $(this).val();
                let url = "{{ Route('customer.checkout') }}";
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                        id: id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var selected_upozila =
                                "{{ $shipping_address ? $shipping_address->upozila_id : '' }}";
                            $('#upozila').html('');
                            $('#upozila').append(
                                '<option value="" selected>-- Select Upozila --</option>');
                            $.each(response.locations, function(key, value) {
                                var option = '<option value="' + value.id + '"';
                                if (selected_upozila != '' && selected_upozila ==
                                    value.id) {
                                    option += ' selected';
                                }
                                option += '>' + value.name + '</option>';
                                $('#upozila').append(option);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#delivery_area', function(e) {
                let type = $(this).val();
                var inside_charge = $('#inside_charge').val();
                var outside_charge = $('#outside_charge').val();
                if (type == 'outside_city') {
                    $('#charge').text(outside_charge);
                } else {
                    $('#charge').text(inside_charge);
                }
            });
        });
    </script>
@endpush
