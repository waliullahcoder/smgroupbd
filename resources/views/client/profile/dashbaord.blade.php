@extends('layouts.client.app')
@section('content')
    <div class="row g-4">
        <div class="col-md-4 col-sm-6">
            <div class="info-box bg-info">
                <div class="info-area">
                    <span class="box-amount pb-3">৳ {{ $info['sales'] }}</span>
                    <span class="box-text">Purchase Value</span>
                </div>
                <div class="icon-area"><i class="fal fa-shopping-cart"></i></div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="info-box bg-danger">
                <div class="info-area">
                    <span class="box-amount pb-3">৳ {{ $info['collection'] }}</span>
                    <span class="box-text">Payment Amount</span>
                </div>
                <div class="icon-area"><i class="fas fa-money-bill-wave"></i></div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="info-box bg-success">
                <div class="info-area">
                    <span class="box-amount pb-3">৳ {{ $info['balance'] }}</span>
                    <span class="box-text">Balance</span>
                </div>
                <div class="icon-area"><i class="fal fa-wallet"></i></div>
            </div>
        </div>
    </div>
@endsection
