@extends('layouts.frontend.app')
@section('content')
    <div class="bg-light">
        <div class="container">
            <div class="breadcrumbs py-3">
                <ul class="items">
                    <li class="item home">
                        <a href="{{ Route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="item">My Profile</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="py-4">
        <div class="container">
            <div class="user-sidebar-main__wrapper">
                @include('layouts.customer.menu')
                <div class="user-main-area">
                    <div class="block-card">
                        <div class="block-card__header">
                            <div class="block-title mb-0">
                                <h2 class="b-title h5 text-uppercase">Your personal information</h2>
                            </div>
                        </div>
                        <div class="block-card__body p-4">
                            <form action="{{ Route('customer.profile') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Full name</label>
                                        <input class="form-control" name="name" type="text"
                                            value="{{ auth()->user()->name }}" placeholder="First name" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" name="email" type="email"
                                            value="{{ auth()->user()->email }}" placeholder="Email Address">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control" name="phone" type="number"
                                            value="{{ auth()->user()->phone }}" placeholder="Phone Number" readonly
                                            required>
                                    </div>
                                    <div class="pt-2">
                                        <button type="submit"
                                            class="btn btn-primary text-uppercase">SAVE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Profile Section -->
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.show-password', function(e) {
                if ($(this).closest('.input-group').find('input').attr('type') == 'password') {
                    $(this).closest('.input-group').find('input').attr('type', 'text');
                    let icon = $(this).data('text-hide');
                    $(this).html(icon)
                } else {
                    $(this).closest('.input-group').find('input').attr('type', 'password');
                    let icon = $(this).data('text-show');
                    $(this).html(icon)
                }
            });
        });
    </script>
@endpush
