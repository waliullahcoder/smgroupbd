@extends('layouts.frontend.app')
@section('content')
    <div class="bg-light">
        <div class="container">
            <div class="breadcrumbs py-3">
                <ul class="items">
                    <li class="item home">
                        <a href="{{ Route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="item">My Wishlist</li>
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
                                <h2 class="b-title h5 text-uppercase">My Wishlist</h2>
                            </div>
                        </div>
                        <div class="block-card__body p-4">
                            @if (count($wishlists) > 0)
                                <div class="grid grid-cols-12 gap-5">
                                    @foreach ($wishlists as $wishlist)
                                        <div class="lg:col-span-3 md:col-span-4 col-span-6"
                                            id="wishlist_item_{{ $wishlist->id }}">
                                            <div class="wishlist-item">
                                                <a href="#" class="lnkdel" data-id="{{ $wishlist->id }}"
                                                    title="Delete"><i class="material-icons close">close</i>
                                                </a>
                                                <div class="wishlist__image">
                                                    <a
                                                        href="{{ Route('frontend.single-product', $wishlist->product->slug) }}">
                                                        <img src="{{ asset($wishlist->product->thumbnail) }}"
                                                            alt="{{ $wishlist->product->name }}">
                                                    </a>
                                                </div>
                                                <h6 class="wishlist-title"><a
                                                        href="{{ Route('frontend.single-product', $wishlist->product->slug) }}">{{ $wishlist->product->name }}.</a>
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <article class="text-gray-600 text-base font-semibold" role="alert" data-alert="warning">
                                    <ul>
                                        <li>You have not placed any Product in Your Wishlist.</li>
                                    </ul>
                                </article>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Wishlist Section -->
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.lnkdel', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                let url = "{{ Route('customer.wishlist') }}";
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                        id: id,
                        delete: 'true',
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            Swal.fire({
                                width: "22rem",
                                text: 'Removed Successfully!',
                                icon: "success",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#wishlist_item_' + id).remove();
                        }
                    }
                });
            });

        });
    </script>
@endpush
