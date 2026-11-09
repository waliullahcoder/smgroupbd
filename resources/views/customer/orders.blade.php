@extends('layouts.frontend.app')
@section('content')
    <div class="bg-light">
        <div class="container">
            <div class="breadcrumbs py-3">
                <ul class="items">
                    <li class="item home">
                        <a href="{{ Route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="item">My Orders</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="py-4 bg-white">
        <div class="container">
            <div class="user-sidebar-main__wrapper">
                @include('layouts.customer.menu')
                <div class="user-main-area">
                    <div class="block-card">
                        <div class="block-card__header">
                            <div class="block-title mb-0">
                                <h2 class="b-title h5">MY ORDERS</h2>
                            </div>
                        </div>
                        <div class="block-card__body p-4">
                            @if (count(Auth::user()->orders) > 0)
                                <div class="relative overflow-x-auto">
                                    <table class="table text-sm mb-0 align-middle">
                                        <thead class="text-xs text-uppercase">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Total price</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Auth::user()->orders as $key => $order)
                                                <tr>
                                                    <td>{{ $order->order_code }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($order->created_at)) }}
                                                    </td>
                                                    <td>{{ number_format($order->total, 2) }} TK.</td>
                                                    <td>{{ $order->payment_method }}</td>
                                                    <td><span class="label px-2 inline-block text-center rounded-sm"
                                                            style="padding: 3px 10px 4px; min-width: 88px; background-color:
                                                                {{ $order->status == 'Pending' ? '#4169E1' : '' }}
                                                                {{ $order->status == 'On Route' ? '#FFC107' : '' }}
                                                                {{ $order->status == 'Delivered' ? '#01B8A5' : '' }}
                                                                {{ $order->status == 'Collected' ? '#01B8A5' : '' }}
                                                                {{ $order->status == 'Canceled' ? '#DC3545' : '' }}
                                                                ; color: #fff;">{{ $order->status == 'Collected' ? 'Delivered' : $order->status  }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ Route('customer.orders', $order->id) }}">View
                                                            Details</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <article class="text-gray-600 text-base font-semibold" role="alert" data-alert="warning">
                                    <ul>
                                        <li>You have not placed any orders.</li>
                                    </ul>
                                </article>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Address Section -->
@endsection
