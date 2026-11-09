<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $admin_setting ? $admin_setting->title : '' }}</title>
    <link rel="shortcut icon"
        href="{{ $admin_setting && file_exists($admin_setting->favicon) ? asset($admin_setting->favicon) : asset('backend/images/logo/favicon.png') }}"
        type="image/x-icon">
    @include('layouts.admin.partial.styles')
</head>

<body>
    <div class="hide-print py-3"></div>
    <div class="row g-0 justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-body" id="print_section">
                    <div class="invoice-area">
                        <div class="invoice-head">
                            <div class="row g-3 align-items-center">
                                <div class="col-4">
                                    <table class="table invoice-table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="p-0">
                                                    <img src="{{ !is_null($setting) ? asset($setting->logo) : asset('frontend/assets/images/logo/logo.png') }}"
                                                        height="60" alt="Logo">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-8">
                                    <table class="table invoice-table table-borderless mb-0 text-end">
                                        <tbody>
                                            <tr>
                                                <td class="p-0">{{ !is_null($setting) ? $setting->address : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0"><a
                                                        href="mailto:{{ !is_null($setting) ? $setting->primary_email : '' }}"
                                                        target="_top">{{ !is_null($setting) ? $setting->primary_email : '' }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0"><a
                                                        href="tel:{{ !is_null($setting) ? $setting->primary_mobile : '' }}"
                                                        target="_top">{{ !is_null($setting) ? $setting->primary_mobile : '' }}</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 grid-col">
                            <div class="col-6">
                                <div class="invoice-address">
                                    <h5>SHIPPING INFORMATION:</h5>
                                    <div class="">
                                        <label class="form-label"><b>Name : </b></label>
                                        <span>{{ $order->user_name }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Phone : </b></label>
                                        <span>{{ $order->user_phone }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Area : </b></label>
                                        <span>{{ @$order->area->name }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Address : </b></label>
                                        <span>{{ @$order->address->address ?? @$order->shipping_address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="invoice-address">
                                    <h5>ORDER INFORMATION</h5>
                                    <div class="">
                                        <label class="form-label"><b>Order Date : </b></label>
                                        <span>{{ $order->created_at->format('d M Y h:i A') }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Invoice Number : </b></label>
                                        <span>#{{ $order->order_code }}</span>
                                    </div>
                                    <div class="alert-items">
                                        <label class="form-label"><b>Status : </b></label>
                                        <span
                                            class="btn btn-xs {{ $order->status == 'Pending' || $order->status == 'Confirmed' || $order->status == 'Processing' ? 'alert-primary' : '' }} {{ $order->status == 'Delivered' || $order->status == 'Successed' ? 'alert-success' : '' }} {{ $order->status == 'Canceled' ? 'alert-danger' : '' }}">{{ $order->status }}</span>
                                    </div>
                                    @if ($order->status == 'Confirmed')
                                        <div class="">
                                            <label class="form-label"><b>Confirmed : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->confirmed_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Processing')
                                        <div class="">
                                            <label class="form-label"><b>Processing : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->processing_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Delivered')
                                        <div class="">
                                            <label class="form-label"><b>Delivered : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->delivered_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Successed')
                                        <div class="">
                                            <label class="form-label"><b>Successed : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->successed_at)) }}</span>
                                        </div>
                                    @elseif ($order->status == 'Canceled')
                                        <div class="">
                                            <label class="form-label"><b>Canceled : </b></label>
                                            <span>{{ date('d M Y h:i A', strtotime($order->canceled_at)) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="invoice-table table-responsive mt-5">
                            <table class="table table-bordered table-hover align-middle table-striped">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center">#SL</th>
                                        <th>Product</th>
                                        <th class="text-nowrap">Regular Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center text-nowrap">Sale Price</th>
                                        <th class="text-end">total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $key => $product)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $product->product->name }}</td>
                                            <td>{{ $product->regular_price }}</td>
                                            <td class="text-center">{{ $product->discount }}</td>
                                            <td class="text-center">{{ $product->quantity }}</td>
                                            <td class="text-center">{{ number_format($product->sale_price) }} TK.</td>
                                            <td class="text-end">
                                                {{ number_format($product->sale_price * $product->quantity) }} TK.</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="text-end">
                                    <tr>
                                        <td class="text-nowrap" colspan="6">Sub total :</td>
                                        <td class="text-nowrap" colspan="1">{{ number_format($order->sub_total) }}
                                            TK.</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap" colspan="6">Shipping Charge :</td>
                                        <td class="text-nowrap" colspan="1">
                                            {{ number_format($order->shipping_charge) }} TK.</td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap" colspan="6">Discount :</td>
                                        <td class="text-nowrap" colspan="1">{{ number_format($order->discount) }}
                                            TK.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Total :</td>
                                        <td colspan="1">{{ number_format($order->total - $order->discount) }} TK.</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-buttons text-end hide-print">
                        <a href="{{ Route('admin.online-order.index') }}" class="invoice-btn">All Orders</a>
                        <a type="button" class="invoice-btn print_btn">print invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.admin.partial.scripts')
    <script type="text/javascript">
        window.print();
        $(document).on('click', '.print_btn', function(event) {
            event.preventDefault();
            window.print();
        });
    </script>
</body>

</html>
