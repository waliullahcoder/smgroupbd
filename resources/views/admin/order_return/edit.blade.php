@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="order_no" class="form-label"><b>Order No.</b></label>
            <input type="text" class="form-control" id="order_no" name="order_no" value="{{ $data->invoice }}" readonly
                placeholder="Order No.">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="user_name" class="form-label"><b>Customer Name</b></label>
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Customer Name"
                value="{{ $data->user_name }}">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="user_phone" class="form-label"><b>Customer Phone</b></label>
            <input type="number" class="form-control" id="user_phone" name="user_phone" placeholder="Customer Phone"
                value="{{ $data->user_phone }}">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Date</b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ date('d-m-Y', strtotime($data->date)) }}" placeholder="Date">
        </div>
        <div
            class="{{ Auth::user()->hasRole('System Admin') || Auth::user()->hasRole('Software Admin') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-6' }}">
            <label for="shipping_address" class="form-label"><b>Shipping Address <span
                        class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                value="{{ $data->shipping_address }}" placeholder="Shipping Address">
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="area_id" class="form-label"><b>Area</b></label>
            <select name="area_id" id="area_id" class="select form-select" data-placeholder="Select Area">
                <option value=""></option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ $data->area_id == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @if (Auth::user()->hasRole('System Admin') || Auth::user()->hasRole('Software Admin'))
            <div class="col-md-3 col-sm-6">
                <label for="created_by" class="form-label"><b>Staff</b></label>
                <select name="created_by" id="created_by" class="select form-select" data-placeholder="Select Staff">
                    @php
                        $users = \App\Models\User::where('role', 1)
                            ->whereHas('roles', function ($q) {
                                $q->where('name', 'Moderator');
                            })
                            ->orderBy('name', 'asc')
                            ->get();
                    @endphp
                    <option value=""></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $data->created_by == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped target-table align-middle mb-0">
                    <thead class="bg-primary border-primary text-white">
                        <tr>
                            <th class="px-3">Product Name</th>
                            <th class="px-3">Code</th>
                            <th class="px-3 text-center" width="150">Rate</th>
                            <th class="px-3 text-center" width="150">Quantity</th>
                            <th class="px-3 text-center" width="150">Amount</th>
                            <th class="px-3 text-center" width="150">Return Amount</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($data->products as $item)
                            <tr>
                                <td class="px-3">
                                    <input type="hidden" name="order_product_id[{{ $item->id }}]"
                                        value="{{ $item->id }}">
                                    <span>{{ @$item->product->name }}</span>
                                </td>
                                <td class="px-3">{{ @$item->product->code }}</td>
                                <td><input class="text-center form-control py-1 rate" type="number"
                                        name="price[{{ $item->id }}]" step="any" value="{{ $item->sale_price }}"
                                        readonly required></td>
                                <td><input class="text-center form-control py-1 qty" type="number"
                                        name="quantity[{{ $item->id }}]" step="any" value="{{ $item->quantity }}"
                                        readonly required></td>
                                <td><input class="text-center form-control py-1 amount" type="number"
                                        name="amount[{{ $item->id }}]" step="any" value="{{ $item->subtotal }}"
                                        readonly required>
                                <td>
                                    <input class="text-center form-control py-1 return_amount" type="number"
                                        name="return_amount[{{ $item->id }}]" step="any"
                                        value="{{ $item->return_amount }}" max="{{ $item->subtotal }}"
                                        placeholder="Return Amount">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-primary text-white align-top border-primary">
                        <tr>
                            <td colspan="3">
                            </td>
                            <td colspan="3">
                                <div class="input-group align-items-center">
                                    <span style="width: 150px;">Total Return</span>
                                    <input type="number" id="total_return" name="total_return" readonly
                                        class="form-control" placeholder="Total Return"
                                        value="{{ $data->total_return }}">
                                    <span class="text-center" style="width: 40px;">TK.</span>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('wheel keyup change', '.return_amount', function(
                e) {
                var total_return = 0;
                $('.return_amount').each(function(index, value) {
                    total_return += +$(this).val();
                });
                $('#total_return').val(total_return);
            });
        });
    </script>
@endpush
