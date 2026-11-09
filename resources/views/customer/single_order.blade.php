@extends('layouts.frontend.app')
@section('content')
    <div class="bg-light">
        <div class="container">
            <div class="breadcrumbs py-3">
                <ul class="items">
                    <li class="item home">
                        <a href="{{ Route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="item">
                        <a href="{{ Route('customer.orders') }}" title="My Orders">My Orders</a>
                    </li>
                    <li class="item">{{ $order->order_code }}</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="py-4 bg-white">
        <div class="container">
            <div id="order-history" class="box">
                <h3 class="h5 mb-4 bg-primary text-white py-2 px-3">Follow your order's status step-by-step</h3>
                <table class="table text-sm mb-0 align-middle">
                    <thead class="text-uppercase">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border">
                            <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                            <td>
                                <span class="label px-2 py-1" style="background-color:#4169E1; color: #fff;">
                                    {{ $order->status == 'Collected' ? 'Delivered' : $order->status }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <article id="delivery-address" class="box">
                            <h6 class="h6 fw-500 text-dark">Delivery address My Address</h6>
                            @php
                                $address = \App\Models\ShippingAddress::where('user_id', Auth::user()->id)->first();
                            @endphp
                            <address class="font-secondary text-xs text-muted">
                                {{ $address->name }}<br>adderss<br>{{ $address->address }}<br>{{ $address->email }}<br>{{ $address->phone }}
                            </address>
                        </article>
                    </div>
                    <div class="col-md-6">
                        <article id="invoice-address" class="box">
                            <h6 class="h6 fw-500 text-dark">Invoice address My Address</h6>
                            <address class="font-secondary text-xs text-muted">
                                {{ $address->name }}<br>adderss<br>{{ $address->address }}<br>{{ $address->email }}<br>{{ $address->phone }}
                            </address>
                        </article>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table text-sm mb-0 align-middle">
                        <thead class="text-uppercase text-xs bg-primary text-white">
                            <tr>
                                <th class="px-3">Product</th>
                                <th class="text-center px-3">Quantity</th>
                                <th class="text-center px-3">Unit price</th>
                                <th class="text-center px-3">Discount</th>
                                <th class="text-end px-3">Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $order_total = 0;
                            @endphp
                            @foreach ($order->products as $product)
                                <tr class="border">
                                    <td class="px-3">
                                        <a
                                            href="{{ Route('frontend.single-product', $product->product->slug) }}">{{ $product->product->name }}</a></strong>
                                    </td>
                                    <td class="px-3 text-center">
                                        {{ number_format($product->quantity, 2) }}
                                    </td>
                                    <td class="px-3 text-center">
                                        ৳ {{ number_format($product->sale_price, 2) }}
                                    </td>
                                    <td class="px-3 text-center">
                                        ৳ {{ number_format($product->discount, 2) }}
                                    </td>
                                    <td class="px-3 text-end">
                                        ৳ {{ number_format($product->subtotal, 2) }}
                                    </td>
                                    @php
                                        $order_total += $product->subtotal;
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-xs-right line-products border">
                                <th class="px-3" colspan="4">Subtotal</th>
                                <td class="px-3 text-end">৳ {{ number_format($order_total, 2) }}</td>
                            </tr>
                            <tr class="text-xs-right line-shipping border">
                                <th class="px-3" colspan="4">Shipping Charge</th>
                                <td class="px-3 text-end">৳ 0.00</td>
                            </tr>
                            <tr class="text-xs-right line-total border">
                                <th class="px-3" colspan="4">Total</th>
                                <td class="px-3 text-end">৳ {{ number_format($order_total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End Address Section -->
@endsection
