@extends('layouts.frontend.app')
@section('content')
    <div class="bg-light">
        <div class="container">
            <div class="breadcrumbs py-3">
                <ul class="items">
                    <li class="item home">
                        <a href="{{ Route('frontend.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="item">Shipping Address</li>
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
                                <h2 class="b-title h5 text-uppercase">Your Address</h2>
                            </div>
                        </div>
                        <div class="block-card__body p-4">
                            <form action="{{ Route('customer.address') }}" method="POST">
                                @csrf
                                <div class="d-flex gap-4 mb-3">
                                    <div class="d-flex gap-2">
                                        <input class="form-check-input" type="radio" id="home" name="address_type"
                                            {{ $address && $address->address_type == 'home' ? 'checked' : '' }}
                                            value="home">
                                        <label class="text-sm text-uppercase" for="home">
                                            Home
                                        </label>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <input class="form-check-input" type="radio" id="office"
                                            {{ $address && $address->address_type == 'office' ? 'checked' : '' }}
                                            name="address_type" value="office">
                                        <label class="text-sm text-uppercase" for="office">
                                            Office
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input class="form-control rounded-0" name="name" type="text"
                                        value="{{ $address ? $address->name : '' }}" placeholder="First name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control rounded-0" name="email" type="email" placeholder="Email"
                                        value="{{ $address ? $address->email : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input class="form-control rounded-0" name="phone" type="number" placeholder="Phone"
                                        value="{{ $address ? $address->phone : '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Division</label>
                                    <select class="form-select rounded-0 text-sm" name="division_id" id="division_id" required>
                                        <option value="">-- Select Division --</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ $address && $address->division_id == $division->id ? 'selected' : '' }}>
                                                {{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">District</label>
                                    <select class="form-select rounded-0 text-sm" name="district_id" id="district_id" required>
                                        <option value="">-- Select District --</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ $address && $address->district_id == $district->id ? 'selected' : '' }}>
                                                {{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upozila</label>
                                    <select class="form-select rounded-0 text-sm" name="upozila_id" id="upozila_id" required>
                                        <option value="">-- Select Upozila --</option>
                                        @foreach ($upozilas as $upozila)
                                            <option value="{{ $upozila->id }}"
                                                {{ $address && $address->upozila_id == $upozila->id ? 'selected' : '' }}>
                                                {{ $upozila->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Street</label>
                                    <textarea name="street" id="street" class="form-control rounded-0" cols="30" rows="3" required
                                        placeholder="Street Address" spellcheck="false">{{ $address ? $address->street : '' }}</textarea>
                                </div>
                                <div class="pt-2">
                                    <button type="submit" class="btn btn-primary px-5 text-uppercase">SAVE</button>
                                </div>
                            </form>
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
            $(document).on('change', '#division_id', function(e) {
                let id = $(this).val();
                let url = "{{ Route('customer.address') }}";
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                        id: id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var selected_district =
                                "{{ $address ? $address->district_id : '' }}";
                            $('#district_id').html('');
                            $('#upozila_id').html('');
                            $('#upozila_id').append(
                                '<option value="" selected>-- Select Upozila --</option>');
                            $('#district_id').append(
                                '<option value="" selected>-- Select District --</option>');
                            $.each(response.locations, function(key, value) {
                                var option = '<option value="' + value.id + '"';
                                if (selected_district != '' && selected_district ==
                                    value.id) {
                                    option += ' selected';
                                }
                                option += '>' + value.name + '</option>';
                                $('#district_id').append(option);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#district_id', function(e) {
                let id = $(this).val();
                let url = "{{ Route('customer.address') }}";
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                        id: id,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            var selected_upozila =
                                "{{ $address ? $address->upozila_id : '' }}";
                            $('#upozila_id').html('');
                            $('#upozila_id').append(
                                '<option value="" selected>-- Select Upozila --</option>');
                            $.each(response.locations, function(key, value) {
                                var option = '<option value="' + value.id + '"';
                                if (selected_upozila != '' && selected_upozila ==
                                    value.id) {
                                    option += ' selected';
                                }
                                option += '>' + value.name + '</option>';
                                $('#upozila_id').append(option);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
