@extends('layouts.admin.report_app')

@section('form')
    <input type="hidden" name="print" value="">
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <label for="month" class="form-label"><b>Month <span class="text-danger">*</span></b></label>
            <select name="month" id="month" class="select form-select" data-placeholder="Select Month.." required>
                @php
                    $months = [
                        '1' => 'January',
                        '2' => 'February',
                        '3' => 'March',
                        '4' => 'April',
                        '5' => 'May',
                        '6' => 'June',
                        '7' => 'July',
                        '8' => 'August',
                        '9' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December',
                    ];
                @endphp
                @foreach ($months as $key => $value)
                    <option value="{{ $key }}"
                        {{ request('month') == $key ? 'selected' : (is_null(request('month')) && $key == date('m') ? 'selected' : '') }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="year" class="form-label"><b>Year <span class="text-danger">*</span></b></label>
            <select name="year" id="year" class="select form-select" data-placeholder="Select Year.." required>
                @for ($i = date('Y'); $i <= 2030; $i++)
                    <option value="{{ $i }}"
                        {{ request('year') == $i ? 'selected' : (is_null(request('year')) && $i == date('Y') ? 'selected' : '') }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-4 col-sm-6">
            <label for="store_id" class="form-label"><b>Store</b></label>
            <select name="store_id" id="store_id" class="select form-select" data-placeholder="Select Store..">
                <option value=""></option>
                @foreach ($stores as $item)
                    <option value="{{ $item->id }}" {{ request('store_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-sm">
            <thead class="text-nowrap">
                <tr>
                    <th class="px-3 text-center" width="40px">SL#</th>
                    <th class="px-3">Date</th>
                    <th class="px-3 text-center">Total Order</th>
                    <th class="px-3 text-center">Pending</th>
                    <th class="px-3 text-center">Forward</th>
                    <th class="px-3 text-center">On Route</th>
                    <th class="px-3 text-center">Delivery</th>
                    <th class="px-3 text-center">Collected</th>
                    <th class="px-3 text-center">Cancel</th>
                    <th class="px-3 text-center">Business Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_1 = 0;
                    $total_2 = 0;
                    $total_3 = 0;
                    $total_4 = 0;
                    $total_5 = 0;
                    $total_6 = 0;
                    $total_7 = 0;
                    $total_collected = 0;
                @endphp
                @for ($i = 1; $i <= 31; $i++)
                    <tr>
                        <td class="px-3 text-center">{{ $i }}</td>
                        <th class="px-3">Date - {{ $i }}</td>
                        <td class="px-3 text-center">
                            @php
                                $year = request('year') ?? date('Y');
                                $month = request('month') ?? date('m');
                                if (Str::length($month) == 1) {
                                    $month = '0' . $month;
                                }
                                $date = date(
                                    'Y-m-d',
                                    strtotime($year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)),
                                );
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\Order::where('date', $date);
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $totals = $query->count();
                                    $total_1 += $totals;
                                    if ($totals > 0) {
                                        echo '<a class="fs-15" href="' .
                                            Route('admin.monthly-statement.index') .
                                            '?view_orders=true&date=' .
                                            $date .
                                            '">' .
                                            number_format($totals) .
                                            '</a>';
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <td class="px-3 text-center">
                            @php
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\Order::where('date', $date)->where('status', 'Pending');
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $total_pending = $query->count();
                                    $total_2 += $total_pending;
                                    if ($total_pending > 0) {
                                        echo '<a class="fs-15" href="' .
                                            Route('admin.monthly-statement.index') .
                                            '?view_orders=true&date=' .
                                            $date .
                                            '&status=Pending">' .
                                            number_format($total_pending) .
                                            '</a>';
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <td class="px-3 text-center">
                            @php
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\Order::where('date', $date)->where('status', 'Forward');
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $total_forward = $query->count();

                                    $total_3 += $total_forward;
                                    if ($total_forward > 0) {
                                        echo '<a class="fs-15" href="' .
                                            Route('admin.monthly-statement.index') .
                                            '?view_orders=true&date=' .
                                            $date .
                                            '&status=Forward">' .
                                            number_format($total_forward) .
                                            '</a>';
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <td class="px-3 text-center">
                            @php
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\Order::where('date', $date)->where('status', 'On Route');
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $total_on_route = $query->count();

                                    $total_4 += $total_on_route;
                                    if ($total_on_route > 0) {
                                        echo '<a class="fs-15" href="' .
                                            Route('admin.monthly-statement.index') .
                                            '?view_orders=true&date=' .
                                            $date .
                                            '&status=On Route">' .
                                            number_format($total_on_route) .
                                            '</a>';
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <td class="px-3 text-center">
                            @php
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\Order::where('date', $date)->where('status', 'Delivered');
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $total_delivered = $query->count();

                                    $total_5 += $total_delivered;
                                    if ($total_delivered > 0) {
                                        echo '<a class="fs-15" href="' .
                                            Route('admin.monthly-statement.index') .
                                            '?view_orders=true&date=' .
                                            $date .
                                            '&status=Delivered">' .
                                            number_format($total_delivered) .
                                            '</a>';
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <td class="px-3 text-center">
                            @php
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\Order::where('date', $date)->where('status', 'Collected');
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $collected = $query->count();

                                    $total_collected += $collected;
                                    if ($collected > 0) {
                                        echo '<a class="fs-15" href="' .
                                            Route('admin.monthly-statement.index') .
                                            '?view_orders=true&date=' .
                                            $date .
                                            '&status=Collected">' .
                                            number_format($collected) .
                                            '</a>';
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <td class="px-3 text-center">
                            @php
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\Order::where('date', $date)->where('status', 'Cancelled');
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $total_cancelled = $query->count();

                                    $total_6 += $total_cancelled;
                                    if ($total_cancelled > 0) {
                                        echo '<a class="fs-15" href="' .
                                            Route('admin.monthly-statement.index') .
                                            '?view_orders=true&date=' .
                                            $date .
                                            '&status=Cancelled">' .
                                            number_format($total_cancelled) .
                                            '</a>';
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <th class="px-3 text-center">
                            @php
                                if ($date == $year . '-' . $month . '-' . (Str::length($i) == 1 ? '0' . $i : $i)) {
                                    $query = \App\Models\OnlineSales::where('date', $date)->whereIn('status', [
                                        'Delivered',
                                        'Collected',
                                    ]);
                                    if (request('store_id')) {
                                        $query->where('store_id', request('store_id'));
                                    }
                                    $total_business = $query->sum('amount');

                                    $total_7 += $total_business;
                                    if ($total_business > 0) {
                                        echo number_format($total_business);
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                    </tr>
                @endfor
            </tbody>
            <tfoot>
                <tr>
                    <th class="px-3 text-end" colspan="2">Total Summary</th>
                    <th class="px-3 text-center">{{ number_format($total_1) }}</th>
                    <th class="px-3 text-center">{{ number_format($total_2) }}</th>
                    <th class="px-3 text-center">{{ number_format($total_3) }}</th>
                    <th class="px-3 text-center">{{ number_format($total_4) }}</th>
                    <th class="px-3 text-center">{{ number_format($total_5) }}</th>
                    <th class="px-3 text-center">{{ number_format($total_collected) }}</th>
                    <th class="px-3 text-center">{{ number_format($total_6) }}</th>
                    <th class="px-3 text-center">{{ number_format($total_7) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": false,
                dom: 'Bfrtip',
                'responsive': true,
                'pageLength': 31,
                buttons: [
                    'excelHtml5',
                    {
                        'text': '<i class="fal fa-file-pdf"></i> Print',
                        'className': 'getPdf',
                    },
                ]
            });

            $(document).on('click', '.getPdf', function(e) {
                $('input[name="print"]').val('true');
                $('.filter_form').attr('target', '_blank');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '.getChalanPdf', function(e) {
                $('input[name="print"]').val('true');
                $('.filter_form').attr('target', '_blank');
                $('.filter_form')[0].submit();
            });

            $(document).on('click', '#filter_btn', function(e) {
                $('input[name="print"]').val('');
                $('.filter_form').attr('target', '_self');
            });
        });
    </script>
@endpush
