@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.partial.breadcrumb', [
        'title' => 'Orders',
        'link' => '',
    ])
    <section class="address-section py-md-5 py-4 bg-white">
        <div class="container">
            <div class="row g-4">
                @include('layouts.customer.menu')
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-card">
                        <h5 class="dashboard-title">Order history</h5>
                        <div class="pb-2 font-secondary text-xs">
                            @if (count($return_orders) > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle text-xxs">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Total price</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th class="text-end pe-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($return_orders as $key => $order)
                                                <tr>
                                                    <td>{{ $order->order_code }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                                                    <td>{{ number_format($order->total, 2) }} TK.</td>
                                                    <td>{{ $order->payment_method }}</td>
                                                    <td><span class="label px-2 py-1"
                                                            style="background-color:#4169E1; color: #fff;">{{ $order->status }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a class="btn btn-xs btn-secondary"
                                                            href="{{ Route('customer.return-orders', $order->id) }}">View
                                                            Details</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <article class="alert alert-warning" role="alert" data-alert="warning">
                                    <ul>
                                        <li>You have not placed any orders.</li>
                                    </ul>
                                </article>
                            @endif
                            <p class="fw-600 mb-0">Here are the orders you've placed since your account was created.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Address Section -->
@endsection
