@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <label for="client_id" class="form-label"><b>Client Name</b></label>
            <input type="text" class="form-control" readonly value="{{ $data->first()->client->name }}">
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
                    @php
                        $key = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-3 text-center">{{ $key++ }}</td>
                            <td class="px-3">{{ @$item->product->category->name }}</td>
                            <td class="px-3">{{ @$item->product->vendor->name }}</td>
                            <td class="text-capitalize px-3">
                                <input type="hidden" name="product_id[]" value="{{ @$item->product_id }}">
                                {{ @$item->product->name }}
                            </td>
                            <td class="px-3 text-center">{{ @$item->product->code }}</td>
                            <td class="px-3 text-center">
                                <input type="number" name="default_price[]" class="form-control text-center" step="any"
                                    placeholder="Default Price" value="{{ @$item->product->price->sale_price }}" readonly>
                            </td>
                            <td class="px-3 text-center"><input type="number" name="client_price[]"
                                    class="form-control text-center" step="any" placeholder="Client Price"
                                    value="{{ $item->client_price }}" required>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-3 text-center">{{ $key++ }}</td>
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
