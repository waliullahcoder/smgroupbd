@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header pe-2 py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="h6 mb-0 text-uppercase py-5px"></h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ Route('admin.online-order.index') }}" class="btn btn-primary btn-sm">Go
                                Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="section-to-print">
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
                            <div class="col-md-6">
                                <div class="invoice-address">
                                    <h5>SHIPPING INFORMATION:</h5>
                                    <div class="">
                                        <label class="form-label"><b>Name : </b></label>
                                        <span>{{ $order->address->name }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Phone : </b></label>
                                        <span>{{ $order->address->phone }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Email : </b></label>
                                        <span>{{ $order->address->email }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Pickup : </b></label>
                                        <span>{{ $order->address->address_type }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Address : </b></label>
                                        <span>{{ $order->address->address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="invoice-address">
                                    <h5>ORDER INFORMATION</h5>
                                    <div class="">
                                        <label class="form-label"><b>Date : </b></label>
                                        <span>{{ $order->created_at->format('d M Y h:i A') }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Invoice Number : </b></label>
                                        <span>#{{ $order->order_code }}</span>
                                    </div>
                                    <div class="">
                                        <label class="form-label"><b>Payment Method : </b></label>
                                        <span>{{ $order->payment_method }}</span>
                                    </div>
                                    <form action="{{ Route('admin.online-order.update', $order->id) }}" method="POST"
                                        id="order_status">
                                        @csrf
                                        @method('PUT')
                                        <div class="alert-items d-flex gap-3 align-items-center mb-2">
                                            <label class="form-label flex-shrink-0 mb-0" style="width: 60px;"><b>Store :
                                                </b></label>
                                            @if (is_null($order->store_id))
                                                <select name="store_id" class="form-select fs-14 px-2 py-1" id="store_id"
                                                    style="width: 280px;">
                                                    @foreach ($stores as $store)
                                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <input type="hidden" name="store_id" value="{{ $order->store_id }}">
                                                {{ @$order->store->name }}
                                            @endif
                                        </div>
                                        <div class="alert-items d-flex gap-3 align-items-center mb-2">
                                            <label class="form-label flex-shrink-0 mb-0" style="width: 60px;"><b>Status :
                                                </b></label>
                                            <select name="status" class="form-select fs-14 px-2 py-1" id="status"
                                                required style="width: 150px;">
                                                @if ($order->status == 'Pending')
                                                    <option value="Pending"
                                                        {{ $order->status == 'Pending' ? 'selected disabled' : '' }}>
                                                        Pending</option>
                                                    <option value="Confirmed">Confirm</option>
                                                @endif
                                                @if ($order->status == 'Confirmed')
                                                    <option value="Confirmed"
                                                        {{ $order->status == 'Confirmed' ? 'selected disabled' : '' }}>
                                                        Confirmed</option>
                                                    <option value="Processing">Process</option>
                                                @endif
                                                @if ($order->status == 'Processing')
                                                    <option value="Processing"
                                                        {{ $order->status == 'Processing' ? 'selected disabled' : '' }}>
                                                        Processing</option>
                                                    <option value="Delivered">Delivery</option>
                                                @endif
                                                @if ($order->status == 'Delivered')
                                                    <option value="Delivered"
                                                        {{ $order->status == 'Delivered' ? 'selected disabled' : '' }}>
                                                        Delivered</option>
                                                    <option value="Successed">Success</option>
                                                @endif
                                                @if ($order->status == 'Successed')
                                                    <option value="Successed"
                                                        {{ $order->status == 'Successed' ? 'selected disabled' : '' }}>
                                                        Successed</option>
                                                @endif
                                                <option value="Canceled"
                                                    {{ $order->status == 'Canceled' ? 'selected disabled' : '' }}>
                                                    {{ $order->status == 'Canceled' ? 'Canceled' : 'Cancel' }}
                                                </option>
                                            </select>
                                            <button type="submit" id="status_update_btn"
                                                class="btn btn-sm btn-primary">Update Status</button>
                                        </div>
                                    </form>
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
                                        <th>Regular Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Sale Price</th>
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
                                        <td colspan="6">Sub total :</td>
                                        <td colspan="1">{{ number_format($order->sub_total) }} TK.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Shipping Charge :</td>
                                        <td colspan="1">{{ number_format($order->shipping_charge) }} TK.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Discount :</td>
                                        <td colspan="1">{{ number_format($order->discount) }} TK.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Total :</td>
                                        <td colspan="1">{{ number_format($order->total) }} TK.</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-buttons text-end">
                        <a href="{{ route('admin.online-order.show', $order->id) }}" target="_blank"
                            class="invoice-btn">print
                            invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#status_update_btn', function(e) {
                e.preventDefault();
                let store_id = $('#store_id').val();
                let status = $('#status').val();
                if (status == null) {
                    Swal.fire({
                        toast: true,
                        width: "28rem",
                        position: 'top-right',
                        text: "Please select a status!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                    return;
                }

                if (store_id == '') {
                    Swal.fire({
                        toast: true,
                        width: "28rem",
                        position: 'top-right',
                        text: "Please select a store!",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                    return;
                }

                Swal.fire({
                    width: "25rem",
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.value) {
                        $('#order_status').submit();
                    }
                });
            });
        });
    </script>
@endpush
