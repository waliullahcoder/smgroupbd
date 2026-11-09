@php
    $i = 1;
@endphp
@if (@$rows)
    @foreach ($rows as $row)
        <tr>
            <td>{{ $row->product->name }}</td>
            <td>{{ $row->product->code }}</td>
            <td>{{ $row->sales_list->sales->invoice }}</td>
            <td>
                <input type="number" style="width: 120px;" class="form-control text-center" step="any"
                    name="sales_qty[{{ $row->sales_list_id }}]" value="{{ $row->sales_list->qty }}" readonly required>
            </td>
            <td>
                <input type="number" style="width: 120px;" class="form-control text-center" step="any"
                    name="returned_qty[{{ $row->sales_list_id }}]"
                    value="{{ $row->sales_list->returned_qty - $row->qty }}" readonly required>
            </td>
            <td>
                <input type="number" style="width: 120px;" class="form-control text-center" step="any"
                    name="return_qty[{{ $row->sales_list_id }}]" value="{{ $row->qty }}"
                    max="{{ $row->sales_list->qty + $row->qty - $row->sales_list->returned_qty }}" required>
            </td>
            <td class="text-center" width="120">{{ $row->sales_list->rate }}</td>
            <td class="text-center" width="120">{{ $row->sales_list->amount }}</td>
            <td>
                <div class="custom-control custom-checkbox w-fit mx-auto">
                    <input type="checkbox" class="custom-control-input multi_checkbox" name="sales_list_id[]"
                        value="{{ $row->sales_list_id }}" id="{{ $row->sales_list_id }}" checked>
                    <label for="{{ $row->sales_list_id }}" class="custom-control-label"></label>
                </div>
            </td>
        </tr>
    @endforeach
@endif


@if (@$new_rows)
    @foreach ($new_rows as $item)
        <tr>
            <td>{{ @$item->product->name }}</td>
            <td>{{ @$item->product->code }}</td>
            <td>{{ @$item->sales->invoice }}</td>
            <td>
                <input type="number" style="width: 120px;" class="form-control text-center"
                    name="sales_qty[{{ $item->id }}]" step="any" value="{{ $item->qty }}" readonly
                    required>
            </td>
            <td>
                <input type="number" style="width: 120px;" class="form-control text-center"
                    name="returned_qty[{{ $item->id }}]" step="any" value="{{ $item->returned_qty }}" readonly
                    required>
            </td>
            <td>
                <input type="number" style="width: 120px;" class="form-control text-center"
                    name="return_qty[{{ $item->id }}]" step="any" value="0"
                    max="{{ $item->qty - $item->returned_qty }}" required>
            </td>
            <td class="text-center" width="120">{{ $item->rate }}</td>
            <td class="text-center" width="120">{{ $item->amount }}</td>
            <td class="text-center">
                <div class="custom-control custom-checkbox w-fit mx-auto">
                    <input type="checkbox" class="custom-control-input multi_checkbox" name="sales_list_id[]"
                        value="{{ $item->id }}" id="{{ $item->id }}">
                    <label for="{{ $item->id }}" class="custom-control-label"></label>
                </div>
            </td>
        </tr>
    @endforeach
@endif
