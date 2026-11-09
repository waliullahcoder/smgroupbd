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
                <h1 class="md:text-3xl text-2xl font-medium text-cyan-700 mb-4">CREATE AN ACCOUNT</h1>
                <span class="inline-flex w-[100px] bg-red-400 h-1"></span>
            </div>
            <div class="px-5">
                <div class="login-form-box max-w-[555px] w-full mx-auto p-5 border bg-white rounded-r-xl border-l-cyan-400 border-l-2">
                    <div id="login">
                        <h3 class="mb-4 font-semibold text-red-500">PERSONAL INFORMATION</h3>
                        <form method="POST" action="{{ Route('customer.register') }}" id="register">
                            @csrf
                            <div class="pb-4">
                                <label class="form-label" for="name">Full Name <sup>*</sup></label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="pb-4">
                                <label class="form-label" for="phone">Phone <sup>*</sup></label>
                                <input type="number" name="phone" class="form-control" id="phone">
                            </div>
                            <div class="pb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                            <div class="pb-4">
                                <label class="form-label" for="pass">Password <sup>*</sup></label>
                                <input type="password" name="password" class="form-control" id="pass">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <button type="submit" class="btn bg-red-400 text-white rounded-md px-8 py-2 hover:bg-cyan-500 transition-all duration-300 uppercase">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
