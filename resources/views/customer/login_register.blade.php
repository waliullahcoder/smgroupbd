@extends('layouts.frontend.app')
@section('content')
    <div class="py-md-5 py-4 bg-white">
        <div class="container">
            <div class="registration-page">
                <div class="row g-0" id="customer_login">
                    <div class="col-md-6">
                        <div class="p-lg-5 p-4">
                            <form action="{{ Route('customer.login') }}" id="login-form" style="display: {{ Route::is('customer.register') ? 'none' : 'block' }};">
                                <h2 class="panel-title">Login</h2>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="username">Username or email
                                            address&nbsp;<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Username or email address" id="username" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="password">Password&nbsp;<span
                                                class="required">*</span></label>
                                        <div class="input-group">
                                            <input class="form-control border-end-0" type="password" name="password"
                                                id="password" autocomplete="current-password" placeholder="Password"
                                                required>
                                            <span class="input-group-text bg-transparent show-password">
                                                <span class="show-password-input text-muted"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <button type="submit" class="btn btn-primary" name="login" value="Log in">Log
                                            in</button>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" name="rememberme" id="rememberme"
                                                    type="checkbox" value="forever" title="Remember me">
                                                <label for="rememberme" class="form-check-label">
                                                    <span>Remember me</span>
                                                </label>
                                            </div>
                                            <a href="#" class="lost_password">Lost your password?</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="title-continer style-one login-divider"><span>Or login
                                                with</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="social-login">
                                            <a href="#" class="login-fb-link btn">Facebook</a>
                                            <a href="#" class="login-goo-link btn">Google</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ Route('customer.register') }}" id="register-form"
                                style="display: {{ Route::is('customer.register') ? 'block' : 'none' }};">
                                <h2 class="panel-title">Register</h2>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label" for="email">Email Address<span
                                                class="required">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email Address" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="password">Password&nbsp;<span
                                                class="required">*</span></label>
                                        <div class="input-group">
                                            <input class="form-control border-end-0" type="password" name="password"
                                                id="password" autocomplete="current-password" placeholder="Password"
                                                required>
                                            <span class="input-group-text bg-transparent show-password">
                                                <span class="show-password-input text-muted"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p>Your personal data will be used to support your experience throughout
                                            this
                                            website, to manage access to your account, and for other purposes
                                            described
                                            in our <a href="#" target="_blank">privacy
                                                policy</a>.</p>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <button type="submit" class="btn btn-primary" name="register"
                                            value="Register">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center p-lg-5 p-4">
                            <div class="register-text" style="display: {{ Route::is('customer.register') ? 'none' : 'block' }};">
                                <h2 class="panel-title mb-4">Register</h2>
                                <div class="registration-info mb-4">Registering for this site allows you to access
                                    your
                                    order
                                    status
                                    and history. Just fill in the fields below, and we'll get a new account set up
                                    for
                                    you
                                    in no
                                    time. We will only ask you for information necessary to make the purchase
                                    process
                                    faster
                                    and
                                    easier.</div>
                                <a href="#" rel="nofollow noopener" class="btn switch-btn"
                                    data-text="register">Register</a>
                            </div>
                            <div class="login-text" style="display: {{ Route::is('customer.register') ? 'block' : 'none' }};">
                                <h2 class="panel-title mb-4">Login</h2>
                                <div class="login-info mb-4">Please login to your Account. If you signed up via
                                    social
                                    media then
                                    click on the social media icon to login in again.</div>
                                <a href="#" rel="nofollow noopener" class="btn switch-btn"
                                    data-text="login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Register -->
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.switch-btn', function(e) {
                e.preventDefault();
                let text = $(this).data('text');
                if (text == 'register') {
                    $('#register-form').show();
                    $('#login-form').hide();
                    $('.login-text').show();
                    $('.register-text').hide();
                } else {
                    $('#login-form').show();
                    $('#register-form').hide();
                    $('.register-text').show();
                    $('.login-text').hide();
                }
            });

            $(document).on('click', '#resend_otp', function(e) {
                e.preventDefault();
                $('#otp_form').submit();
            });
        });
    </script>
@endpush
