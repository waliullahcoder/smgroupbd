@foreach ($purchases as $item)
    @php
        $old_data = @$data->payment_data->where('lifting_id', $item->id)->first();
        $checked = true;
        $paid = @$old_data->paid;
        $due = $item->net_amount - $item->return_amount - $item->total_paid;
        if (is_null($old_data)) {
            $checked = false;
        }

        if ($type == 'adjust') {
            if ($advance <= 0) {
                $checked = false;
                $paid = 0;
                $due = $item->net_amount - $item->total_paid;
            } elseif (@$old_data->paid < $advance) {
                $paid = @$old_data->paid;
                $due = 0;
            } else {
                $paid = $advance;
                $due = $item->net_amount - $item->total_paid - $advance + @$old_data->paid;
            }
        }
    @endphp
    <tr>
        <td class="text-center"><b>{{ $loop->iteration }}</b></td>
        <td>{{ $item->lifting_no }}</td>
        <td>
            {{ $item->net_amount }}
        </td>
        <td>
            {{ $item->total_paid + $item->return_amount - @$old_data->paid }}
        </td>
        <td>
            <input type="number" class="form-control input-sm text-end due" step="any" id="due_{{ $item->id }}"
                name="due[{{ $item->id }}]" value="{{ $due }}" readonly>
        </td>
        <td>
            <input type="number" id="amount_{{ $item->id }}" name="curr_payment[{{ $item->id }}]"
                class="form-control py-1 amount" max="{{ $due + @$old_data->paid }}" data-id="{{ $item->id }}"
                step="any" value="{{ $paid }}">
        </td>
        <td width="60" class="text-center">
            <div class="custom-control custom-checkbox w-fit mx-auto ps-3">
                <input type="checkbox" class="custom-control-input lifting_id" name="lifting_id[]"
                    value="{{ $item->id }}" id="{{ $item->id }}"
                    data-payable="{{ $item->net_amount - $item->total_paid - $item->return_amount + @$old_data->paid }}"
                    {{ @$checked === true ? 'checked' : '' }}>
                <label for="{{ $item->id }}" class="custom-control-label"></label>
            </div>
        </td>
    </tr>
@endforeach
