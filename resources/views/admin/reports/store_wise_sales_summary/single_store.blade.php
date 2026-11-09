@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header pe-2 py-2">
            <form action="{{ @$filter_link }}" method="GET" class="filter_form">
                <input type="hidden" name="print" value="">
                <input type="hidden" name="filter" value="1">
                <input type="hidden" name="view_orders" value="true">
                <input type="hidden" name="store_id" value="{{ request('store_id') }}">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <h6 class="h6 mb-0 text-uppercase py-1">{{ @$title }}</h6>
                    <a href="{{ @$filter_link }}" class="btn btn-primary btn-sm">Go
                        Back</a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-sm">
                    <thead class="text-nowrap">
                        <tr>
                            <th class="px-3 text-center" width="30">SL#</th>
                            <th class="px-3">Date</th>
                            <th class="px-3">Order No.</th>
                            <th class="px-3">Customer Name</th>
                            <th class="px-3">Customer Phone</th>
                            <th class="px-3">Area</th>
                            <th class="px-3">Address</th>
                            <th class="px-3">Product Details</th>
                            <th class="px-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td class="px-3 text-center">{{ $loop->iteration }}</td>
                                <td class="px-3 text-nowrap">{{ date('d-m-Y', strtotime($row->date)) }}</td>
                                <td class="px-3">{{ $row->invoice }}</td>
                                <td class="px-3">{{ $row->user_name }}</td>
                                <td class="px-3">{{ $row->user_phone }}</td>
                                <td class="px-3">{{ @$row->area->name }}</td>
                                <td class="px-3">{{ $row->shipping_address }}</td>
                                <td class="px-3">
                                    @php
                                        $string = '';
                                        foreach ($row->products as $key => $item) {
                                            $string .=
                                                ($key > 0 ? ', ' : '') .
                                                @$item->product->name .
                                                ' - ' .
                                                $item->quantity .
                                                ' ' .
                                                @$item->product->attribute->name .
                                                ' - ' .
                                                $item->subtotal .
                                                'Taka ';
                                        }
                                    @endphp
                                    {{ $string }}
                                </td>
                                <td class="px-3">
                                    @php
                                        if ($row->status == 'Cancelled') {
                                            $status =
                                                '<span class="btn btn-xs text-white px-2 bg-danger" style="min-width: 80px;">Cancelled</span>';
                                        } elseif ($row->status == 'Successed') {
                                            $status =
                                                '<span class="btn btn-xs text-white px-2 bg-success" style="min-width: 80px;">Successed</span>';
                                        } else {
                                            $status = '<a class="btn btn-xs text-white px-2 ';
                                            if ($row->status == 'Pending') {
                                                $status .= 'bg-primary';
                                            } elseif ($row->status == 'On Route') {
                                                $status .= 'bg-route';
                                            } elseif ($row->status == 'Forward') {
                                                $status .= 'bg-warning';
                                            } elseif ($row->status == 'Delivered') {
                                                $status .= 'bg-delivered';
                                            } elseif ($row->status == 'Returned') {
                                                $status .= 'bg-danger';
                                            }
                                            $status .=
                                                '" style="min-width: 80px;" href="' .
                                                (!Auth::user()->hasRole('Moderator')
                                                    ? Route('admin.order-dashboard.edit', $row->id)
                                                    : '') .
                                                '">' .
                                                $row->status .
                                                '</a>';
                                        }
                                        echo $status;
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": false,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    {
                        'text': '<i class="fal fa-file-pdf"></i> Print',
                        'className': 'getPdf',
                    },
                ]
            });

            $(document).on('click', '.getPdf', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('true');
                $('.filter_form')[0].setAttribute("target", "_blank");
                $('.filter_form').submit();
            });

            $(document).on('change', '#area_id', function(e) {
                e.preventDefault();
                $('input[name="print"]').val('');
                $('.filter_form')[0].setAttribute("target", "_self");
                $('.filter_form').submit();
            });
        });
    </script>
@endpush
