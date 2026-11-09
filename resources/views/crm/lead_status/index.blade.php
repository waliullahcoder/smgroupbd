@extends('layouts.admin.app')

@section('content')

<div class="row g-3">

    <div class="col-12">

        <div class="card">

            <div class="card-header pe-2 py-2">

                <div class="d-flex justify-content-between align-items-center">

                    <h6 class="h6 mb-0 text-uppercase">
                        Lead Status
                    </h6>

                    <a href="{{ route('admin.lead-status.create') }}"
                        class="btn btn-primary btn-sm">

                        Add New

                    </a>

                </div>

            </div>

            <div class="card-body">

                <table class="table dataTable align-middle" style="width:100%">

                    <thead>

                        <tr class="text-nowrap">

                            <th>ID#</th>

                            <th>Status Code</th>

                            <th>Status Name</th>

                            <th>Color</th>

                            <th>Sort Order</th>

                            <th>Description</th>

                            <th>Status</th>

                            <th width="110" class="text-end">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection

@push('js')

<script>

$(function () {

    $('.dataTable').DataTable({

        processing: true,

        serverSide: true,

        scrollX: true,

        ajax: {

            url: "{{ route('admin.lead-status.index') }}",

            type: "GET",

        },

        columns: [

            {
                data: 'id',
                name: 'id'
            },

            {
                data: 'code',
                name: 'code'
            },

            {
                data: 'name',
                name: 'name'
            },

            {
                data: 'color',
                name: 'color',
                orderable: false,
                searchable: false
            },

            {
                data: 'sort_order',
                name: 'sort_order'
            },

            {
                data: 'description',
                name: 'description',
                defaultContent: ''
            },

            {
                data: 'status',
                name: 'status',
                orderable: false,
                searchable: false
            },

            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                className: 'text-end'
            }

        ],

        fnDrawCallback: function () {

            const tooltips = document.querySelectorAll('.tt');

            tooltips.forEach(function (item) {

                new bootstrap.Tooltip(item);

            });

        }

    });

});

</script>

@endpush