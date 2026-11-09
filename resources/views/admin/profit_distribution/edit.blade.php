@extends('layouts.admin.edit_app')

@section('content')
    <input type="hidden" name="generate" value="1">
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="date" class="form-label"><b>Date <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control date_picker" id="date" name="date"
                value="{{ date('d-m-Y', strtotime($data->date)) }}" placeholder="Distribute Date" required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="month" class="form-label"><b>Month <span class="text-danger">*</span></b></label>
            <select class="form-select select" name="month" id="month" data-placeholder="Select Month." required>
                @php
                    $months = [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December',
                    ];
                @endphp
                @foreach ($months as $item)
                    <option value="{{ $item }}"
                        {{ (is_null(request('month')) && $data->month == $item) || request('month') == $item ? 'selected' : '' }}>
                        {{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="year" class="form-label"><b>Year <span class="text-danger">*</span></b></label>
            <select class="form-select select" name="year" id="year" data-placeholder="Select Year." required>
                @for ($i = 2015; $i <= 2055; $i++)
                    <option value="{{ $i }}"
                        {{ (is_null(request('year')) && $data->year == $i) || request('year') == $i ? 'selected' : '' }}>
                        {{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="serial_no" class="form-label"><b>Serial No <span class="text-danger">*</span></b></label>
            <input type="text" class="form-control" id="serial_no" name="serial_no" value="{{ $data->serial_no }}"
                placeholder="Serial No." readonly required>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="total_profit" class="form-label"><b>Total Profit</b></label>
            <input type="text" class="form-control" id="total_profit" name="total_profit"
                value="{{ @$total_profit ?? $data->total_profit }}" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="investor_percentage" class="form-label"><b>Profit %</b></label>
            <input type="text" class="form-control" id="investor_percentage" name="investor_percentage"
                value="{{ @$investor_percentage ?? $data->investor_percentage }}" readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="investor_part" class="form-label"><b>Investor Part</b></label>
            <input type="text" class="form-control" id="investor_part" name="investor_part" value="{{ @$amount ?? $data->amount }}"
                readonly>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <label for="total_share" class="form-label"><b>Total Share</b></label>
            <input type="text" class="form-control" id="total_share" name="total_share"
                value="{{ @$total_share ?? $data->total_share }}" readonly>
        </div>
        <div class="col-12 text-end">
            <button type="button" id="search" class="btn btn-outline-primary"><i class="fa fa-search"></i>
                Generate</button>
        </div>
        @if (count($generated_data) > 0)
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="text-center" width="50">SL#</th>
                                <th>Investor Name</th>
                                <th class="text-center">Individual Share</th>
                                <th class="text-center">Investor Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $profit = 0;
                                $share_qty = 0;
                            @endphp
                            @foreach ($generated_data as $row)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ @$row['investor']->name }}</td>
                                    <td class="text-center">{{ @$row['share_qty'] }}</td>
                                    <td class="text-center"> {{ @$row['profit'] }}
                                        <input type="hidden" name="investor_id[{{ @$row['investor']->id }}]"
                                            value="{{ @$row['investor']->id }}">
                                        <input type="hidden" name="share_qty[{{ @$row['investor']->id }}]"
                                            value="{{ @$row['share_qty'] }}">
                                        <input type="hidden" name="amount[{{ @$row['investor']->id }}]"
                                            value="{{ @$row['profit'] }}">
                                    </td>
                                </tr>
                                @php
                                    $profit += @$row['profit'];
                                    $share_qty += @$row['share_qty'];
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-primary text-white">
                                <th colspan="2">Total</th>
                                <th class="text-center">{{ $share_qty }}</th>
                                <th class="text-center">{{ $profit }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @elseif(
            ($data->year == request('year') && $data->month == request('month')) ||
                (is_null(request('year')) && is_null(request('month'))))
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="text-center" width="50">SL#</th>
                                <th>Investor Name</th>
                                <th class="text-center">Individual Share</th>
                                <th class="text-center">Investor Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $profit = 0;
                                $share_qty = 0;
                            @endphp
                            @foreach ($data->list as $row)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ @$row->investor->name }}</td>
                                    <td class="text-center">{{ @$row->share_qty }}</td>
                                    <td class="text-center">
                                        {{ @$row->amount }}
                                        <input type="hidden" name="investor_id[{{ $row->investor_id }}]"
                                            value="{{ @$row->investor_id }}">
                                        <input type="hidden" name="share_qty[{{ $row->investor_id }}]"
                                            value="{{ @$row->share_qty }}">
                                        <input type="hidden" name="amount[{{ $row->investor_id }}]"
                                            value="{{ @$row->amount }}">
                                    </td>
                                </tr>
                                @php
                                    $profit += @$row->amount;
                                    $share_qty += @$row->share_qty;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-primary text-white">
                                <th colspan="2">Total</th>
                                <th class="text-center">{{ $share_qty }}</th>
                                <th class="text-center">{{ $profit }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".date_picker").datepicker({
                format: 'dd-mm-yyyy',
                changeMonth: true,
                changeYear: true,
            });

            $(document).on('click', '#search', function(e) {
                e.preventDefault();
                $('#update_form').attr('method', 'GET');
                $("[name='_method']").val('GET');
                $('#update_form')[0].submit();
            });

            $(document).on('submit', '#update_form', function(e) {
                $('#update_form').attr('method', 'POST');
                $("[name='_method']").val('PUT');
            });
        });
    </script>
@endpush
