@php
    $i = 1;
    $total_tr = 0;
@endphp
@if (@$rows)
    @php
        $total_tr += count($rows);
    @endphp
    @foreach ($rows as $row)
        <tr>
            <td class="text-center"><b>{{ $i++ }}</b></td>
            <td>{{ $row->sales->invoice }}</td>
            <td class="text-center">
                {{ $row->sales->total_amount - $row->sales->discount }}
                <input type="hidden" class="amount" id="amount_{{ $row->sales_id }}" name="amount[{{ $row->sales_id }}]"
                    value="{{ $row->sales->total_amount - $row->sales->discount }}">
            </td>
            <td class="text-center">
                {{ $row->sales->total_paid - $row->amount + $row->sales->list->sum('returned_amount') }}
                <input type="hidden" class="prev_collection" id="prev_collection_{{ $row->sales_id }}"
                    name="prev_collection[{{ $row->sales_id }}]"
                    value="{{ $row->sales->total_paid - $row->amount + $row->sales->list->sum('returned_amount') }}">
            </td>
            <td class="text-center">
                <input type="number" step=".01" value="{{ $row->amount }}" id="collection_{{ $row->sales_id }}"
                    name="collection[{{ $row->sales_id }}]" class="curr_collection text-center mx-auto"
                    style="width: 200px;"
                    max="{{ $row->sales->total_amount + $row->amount - ($row->sales->total_paid + $row->sales->discount + $row->sales->list->sum('returned_amount')) }}">
            </td>
            <td class="text-center">
                <span class="due"
                    id="due_span_{{ $row->sales_id }}">{{ $row->sales->total_amount - ($row->sales->total_paid + $row->sales->discount + $row->sales->list->sum('returned_amount')) }}</span>
                <input type="hidden" class="due_amount" id="due_amount_{{ $row->sales_id }}"
                    name="due[{{ $row->sales_id }}]"
                    value="{{ $row->sales->total_amount + $row->amount - ($row->sales->total_paid + $row->sales->discount + $row->sales->list->sum('returned_amount')) }}">
            </td>
            <td class="text-center">
                <div class="custom-control custom-checkbox w-fit mx-auto">
                    <input type="checkbox" class="custom-control-input multi_checkbox" name="sales_id[]" checked
                        value="{{ $row->sales_id }}" id="{{ $row->sales_id }}">
                    <label for="{{ $row->sales_id }}" class="custom-control-label"></label>
                </div>
            </td>
        </tr>
    @endforeach
@endif

@if (@$new_rows)
    @php
        $total_tr += count($new_rows);
    @endphp
    @foreach ($new_rows as $item)
        <tr>
            <td class="text-center"><b>{{ $i++ }}</b></td>
            <td>{{ $item->invoice }}</td>
            <td class="text-center">
                {{ $item->total_amount - $item->discount }}
                <input type="hidden" class="amount" id="amount_{{ $item->id }}"
                    name="amount[{{ $item->id }}]" value="{{ $item->total_amount - $item->discount }}">
            </td>
            <td class="text-center">
                {{ $item->total_paid + $item->returned_amount }}
                <input type="hidden" class="prev_collection" id="prev_collection_{{ $item->id }}"
                    name="prev_collection[{{ $item->id }}]"
                    value="{{ $item->total_paid + $item->returned_amount }}">
            </td>
            <td class="text-center">
                <input type="number" step=".01" value="0" id="collection_{{ $item->id }}"
                    name="collection[{{ $item->id }}]" max="{{ $item->collectionable_amount }}"
                    class="curr_collection text-center mx-auto" style="width: 200px;">
            </td>
            <td class="text-center">
                <span class="due" id="due_span_{{ $item->id }}">{{ $item->collectionable_amount }}</span>
                <input type="hidden" class="due_amount" id="due_amount_{{ $item->id }}"
                    name="due[{{ $item->id }}]" value="{{ $item->collectionable_amount }}">
            </td>
            <td>
                <div class="custom-control custom-checkbox w-fit mx-auto">
                    <input type="checkbox" class="custom-control-input multi_checkbox" name="sales_id[]"
                        value="{{ $item->id }}" id="{{ $item->id }}">
                    <label for="{{ $item->id }}" class="custom-control-label"></label>
                </div>
            </td>
        </tr>
    @endforeach
@endif

@if (@$new_rows)
    <script type="text/javascript">
        $(document).ready(function() {
            $('#balance').val({{ $balance }});
            var total_tr = {{ $total_tr }};
            if (total_tr == $('.multi_checkbox:checked').length && $('.multi_checkbox:checked').length > 0) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
    </script>
@endif
