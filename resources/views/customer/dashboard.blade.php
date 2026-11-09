@extends('layouts.frontend.app')
@section('content')
    {{-- <section class="py-md-5 py-4 bg-light">
        <div class="container">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div
                        class="bg-primary border hov-shadow-md -hov-translate-2 has-transition px-3 py-4 text-center position-relative">
                        <a class="absolute-full z-1" href="../cart.html"></a>
                        <h3 class="fs-22 fw-700 text-white"><span class="me-1">{{ !is_null($cart) ? count($cart) : '0' }}</span> Products</h3>
                        <p class="mb-0 fs-13 text-white opacity-80">In Your Cart</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div
                        class="bg-primary border hov-shadow-md -hov-translate-2 has-transition px-3 py-4 text-center position-relative">
                        <a class="absolute-full z-1" href="./wishlist.html"></a>
                        <h3 class="fs-22 fw-700 text-white">12 Products</h3>
                        <p class="mb-0 fs-13 text-white opacity-80">In Your Wishlist</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div
                        class="bg-primary border hov-shadow-md -hov-translate-2 has-transition px-3 py-4 text-center position-relative">
                        <a class="absolute-full z-1" href="./purchased.html"></a>
                        <h3 class="fs-22 fw-700 text-white"><span class="me-1">{{ count(auth()->user()->orders) }}</span> Products</h3>
                        <p class="mb-0 fs-13 text-white opacity-80">You Purchased</p>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="border border-light has-transition">
                            <div class="p-3 border-bottom border-light">
                                <h4 class="fs-16 fw-600 text-center mb-0 text-uppercase">Account Information</h4>
                            </div>
                            <div class="p-md-4 p-3">
                                <div class="row g-3">
                                    <div class="fs-14 fw-600  col-md-6">
                                        <label>Your Name : </label> <span class="opacity-80 fs-13 fw-400 ps-1">{{ auth()->user()->name }}</span>
                                    </div>
                                    <div class="fs-14 fw-600  col-md-6">
                                        <label>Username : </label> <span
                                            class="opacity-80 fs-13 fw-400 ps-1">{{ auth()->user()->user_name }}</span>
                                    </div>
                                    <div class="fs-14 fw-600  col-md-6">
                                        <label>Phone : </label> <span class="opacity-80 fs-13 fw-400 ps-1">{{ auth()->user()->phone }}</span>
                                    </div>
                                    <div class="fs-14 fw-600  col-md-6">
                                        <label>Email Address : </label> <span
                                            class="opacity-80 fs-13 fw-400 ps-1">{{ auth()->user()->email }}</span>
                                    </div>
                                    <div class="fs-14 fw-600  col-12">
                                        <label>Your Bio : </label> <span class="opacity-80 fs-13 fw-400 ps-1">{{ auth()->user()->bio }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Dashboard Area --> --}}
@endsection
