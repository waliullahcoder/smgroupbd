@forelse ($data->sale->list as $item)
    <tr>
        @php
            $return = $data->list->where('retail_sale_list_id', $item->id)->first();
        @endphp
        <td>{{ $item->product->name }}</td>
        <td>{{ @$item->sales->invoice }}</td>
        <td>
            <input type="number" style="width: 120px;" class="form-control text-center" id="sales_qty{{ $item->id }}"
                name="sales_qty[{{ $item->id }}]" value="{{ $item->qty }}" step="any" readonly required>
        </td>
        <td>
            <input type="number" style="width: 120px;" class="form-control text-center"
                id="returned_qty{{ $item->id }}" name="returned_qty[{{ $item->id }}]"
                value="{{ $item->returned_qty - @$return->qty }}" step="any" readonly required>
        </td>
        <td>
            <input type="number" style="width: 120px;" class="form-control text-center return_qty"
                id="return_qty{{ $item->id }}" name="return_qty[{{ $item->id }}]" value="{{ @$return->qty }}"
                max="{{ $item->qty - $item->returned_qty + @$return->qty }}" step="any">
        </td>
        <td class="text-center" width="120">
            <input type="number" style="width: 120px;" class="form-control text-center" id="rate{{ $item->id }}"
                name="rate[{{ $item->id }}]" value="{{ $item->rate - $item->product_discount - $item->discount }}"
                step="any" readonly>
        </td>
        <td class="text-center" width="120">{{ $item->amount }}</td>
        <td class="text-center">
            <div class="custom-control custom-checkbox w-fit mx-auto d-inline">
                <input type="checkbox" class="custom-control-input multi_checkbox" name="retail_sale_list_id[]"
                    value="{{ $item->id }}" id="{{ $item->id }}" {{ $return ? 'checked' : '' }}>
                <label for="{{ $item->id }}" class="custom-control-label"></label>
            </div>
        </td>
    </tr>
@empty
@endforelse
