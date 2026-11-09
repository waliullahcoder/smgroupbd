@extends('layouts.admin.create_app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <label for="client_id" class="form-label"><b>Client Name <span class="text-danger">*</span></b></label>
            <select name="client_id" id="client_id" class="select form-select" data-placeholder="Select Client" required>
                <option value=""></option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ old('client_id') && old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <table class="table table-bordered align-middle table-striped target-table">
                <thead class="bg-primary text-white border-primary">
                    <tr>
                        <th class="px-3 text-center">SL#</th>
                        <th class="px-3">Category</th>
                        <th class="px-3">Vendor Name</th>
                        <th class="px-3">Product Name</th>
                        <th class="px-3 text-center">Product Code</th>
                        <th class="px-3 text-center">Default Sale Price</th>
                        <th class="px-3 text-center">Client Sale Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td class="px-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $product->category->name }}</td>
                            <td class="px-3">{{ $product->vendor->name }}</td>
                            <td class="text-capitalize px-3">
                                <input type="hidden" name="product_id[]" value="{{ $product->id }}">
                                {{ $product->name }}
                            </td>
                            <td class="px-3 text-center">{{ $product->code }}</td>
                            <td>
                                <input type="number" name="default_price[]" class="form-control text-center" step="any"
                                    placeholder="Default Price" value="{{ $product->price->sale_price }}" readonly>
                            </td>
                            <td><input type="number" name="client_price[]" class="form-control text-center" step="any"
                                    placeholder="Client Price" value="{{ $product->price->sale_price }}" required></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
