@foreach ($purchases as $item)
    <tr>
        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
        <td>{{ $item->lifting_no }}</td>
        <td>
            {{ $item->net_amount }}
        </td>
        <td>
            {{ $item->total_paid + $item->return_amount }}
        </td>
        <td>
            <input type="number" class="form-control input-sm text-end due" step="any" id="due_{{ $item->id }}"
                name="due[{{ $item->id }}]" value="{{ $item->net_amount - $item->return_amount - $item->total_paid }}" readonly>
        </td>
        <td>
            <input type="number" id="amount_{{ $item->id }}" name="curr_payment[{{ $item->id }}]"
                class="form-control py-1 amount" max="{{ $item->net_amount - $item->return_amount - $item->total_paid }}"
                data-id="{{ $item->id }}" step="any" value="0">
        </td>
        <td width="60" class="text-center">
            <div class="custom-control custom-checkbox w-fit mx-auto ps-3">
                <input type="checkbox" class="custom-control-input lifting_id" name="lifting_id[]"
                    value="{{ $item->id }}" id="{{ $item->id }}"
                    data-payable="{{ $item->net_amount - $item->return_amount - $item->total_paid }}">
                <label for="{{ $item->id }}" class="custom-control-label"></label>
            </div>
        </td>
    </tr>
@endforeach
