@extends('layouts.frontend.app')
@section('content')
    <section class="md:py-12 py-6">
        <div class="container mx-auto px-4">
            <div class="pb-6">
                <ol class="breadcrumb breadcrumb--ys pull-left">
                    <li class="home-link"><a href="{{ Route('frontend.home') }}"><i class="fa-solid fa-house"></i></a></li>
                    <li><span>Create Account</span></li>
                </ol>
            </div>
            <div class="text-center md:pb-10 pb-8">
                <h1 class="md:text-3xl text-2xl font-medium text-cyan-700 mb-4">Login Your Account</h1>
                <span class="inline-flex w-[100px] bg-red-400 h-1"></span>
            </div>
            <div class="px-5">
                <div
                    class="login-form-box max-w-[400px] w-full mx-auto p-5 border bg-white rounded-r-xl border-l-cyan-400 border-l-2 text-center">
                    <div id="login">
                        <h3 class="font-semibold text-red-500 mb-3">PLEASE ENTER YOUR MOBILE PHONE NUMBER</h3>
                        <form id="otp_form" action="{{ Route('customer.send-otp') }}" method="POST">
                            @csrf
                            <div class="input-group email mb-4">
                                <input class="form-control" type="text" id="phone" name="phone" placeholder="Phone"
                                    value="{{ old('phone') ? old('phone') : '+88' }}" required>
                            </div>
                            <div class="text-center text-gray-500">e.g. +8801884000777</div>
                            <div class="pt-5">
                                <button
                                    class="btn bg-red-400 text-white rounded-md px-10 py-2 hover:bg-cyan-500 transition-all duration-300 uppercase"
                                    type="submit">Signup/Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
