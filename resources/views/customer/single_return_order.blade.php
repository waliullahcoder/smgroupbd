@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.partial.breadcrumb', [
        'title' => 'Order Return History',
        'link' => '',
        'category' => 'Return Orders',
        'category_link' => Route('customer.return-orders'),
    ])
    <section class="py-md-5 py-4 bg-white">
        <div class="container">
            <div id="order-history" class="box">
                <h3 class="h6">Follow your order's status step-by-step</h3>
                <table class="table table-striped table-bordered font-secondary mb-4">
                    <thead class="thead-default">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                            <td>
                                <span class="label px-2 py-1" style="background-color:#4169E1; color: #fff;">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="addresses row g-3 mb-4">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <article id="delivery-address" class="box">
                            <h6 class="fw-400 text-muted">Delivery address My Address</h6>
                            @php
                                $address = \App\Models\ShippingAddress::where('user_id', Auth::user()->id)->first();
                            @endphp
                            <address class="font-secondary text-xs text-muted">
                                {{ $address->name }}<br>adderss<br>{{ $address->address }}<br>{{ $address->email }}<br>{{ $address->phone }}
                            </address>
                        </article>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <article id="invoice-address" class="box">
                            <h6 class="fw-400 text-muted">Invoice address My Address</h6>
                            <address class="font-secondary text-xs text-muted">
                                {{ $address->name }}<br>adderss<br>{{ $address->address }}<br>{{ $address->email }}<br>{{ $address->phone }}
                            </address>
                        </article>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="order-products" class="table table-bordered font-secondary align-middle">
                        <thead class="thead-default text-nowrap">
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Unit price</th>
                                <th class="text-end">Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $order_total = 0;
                            @endphp
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>
                                        <strong><a
                                                href="{{ Route('frontend.single-product', $product->product->slug) }}">{{ $product->product_name }}</a></strong><br>
                                        @if ($product->variant)
                                            @php
                                                $attribute_names = [];
                                                $values = explode('-', $product->variant->variant);
                                            @endphp
                                            @foreach (json_decode($product->product->choice_options) as $key => $choice)
                                                @php
                                                    $attribute_names[] = \App\Models\Attribute::find($choice->attribute_id)->name;
                                                @endphp
                                            @endforeach
                                            <div class="text-xxs pt-2">
                                                @foreach ($attribute_names as $key => $name)
                                                    {{ $key > 0 ? ', ' : '' }} {{ $name }} : {{ $values[$key] }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $product->quantity }}
                                    </td>
                                    <td class="text-center">
                                        ৳ {{ number_format($product->sale_price, 2) }}
                                    </td>
                                    <td class="text-end">
                                        ৳ {{ number_format($product->sale_price * $product->quantity, 2) }}
                                    </td>
                                    @php
                                        $order_total += $product->sale_price * $product->quantity;
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-xs-right line-products">
                                <td colspan="3">Subtotal</td>
                                <td class="text-end">৳ {{ number_format($order_total, 2) }}</td>
                            </tr>
                            <tr class="text-xs-right line-shipping">
                                <td colspan="3">Shipping Charge</td>
                                <td class="text-end">৳ 0.00</td>
                            </tr>
                            <tr class="text-xs-right line-total">
                                <td colspan="3">Total</td>
                                <td class="text-end">৳ {{ number_format($order_total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End Address Section -->
@endsection
