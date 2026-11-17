@extends('layouts.admin.app')

@section('content')
    @php
        $currentRouteName = \Request::route()->getName();
        $link = Route($currentRouteName);
    @endphp

<div class="row g-3">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0 text-uppercase">Quotation</h6>

                    <a href="{{ Route('admin.quotation.create') }}" class="btn btn-primary btn-sm">
                        Add New
                    </a>
                </div>
            </div>

            <div class="card-body">

                {{-- Filters --}}
                <div class="row g-3 mb-3">
                    <div class="col-lg-3 col-sm-6">
                        <label for="quotation" class="form-label"><b>Quotation No.</b></label>
                        <input type="text" class="form-control" id="quotation" placeholder="Quotation No.">
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <label for="quotation_date" class="form-label"><b>Quotation Date</b></label>
                        <input type="text" class="form-control date_picker" id="quotation_date"
                            placeholder="dd-mm-yyyy" autocomplete="off">
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <label for="company_id" class="form-label"><b>Company</b></label>
                        <select id="company_id" class="select form-select" data-placeholder="All Companies">
                            <option value=""></option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <label for="project_id" class="form-label"><b>Project</b></label>
                        <select id="project_id" class="select form-select" data-placeholder="All Projects" disabled>
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <table class="table table-bordered table-striped dataTable align-middle" style="width:100%">
                    <thead>
                        <tr class="text-nowrap">
                            <th>Quotation</th>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Project</th>
                            <th>Party Name</th>
                            <th class="text-end">Total</th>
                            <th class="text-end">Discount</th>
                            <th class="text-end">VAT & Tax</th>
                            <th class="text-end">Net Payable</th>
                            <th>Staff</th>
                            <th>Quotation By</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function () {

        var table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            order: [],
            ajax: {
                url: "{{ $link }}",
                type: "GET",
                data: function (data) {
                    data.quotation      = $('#quotation').val();
                    data.quotation_date = $('#quotation_date').val();
                    data.company_id     = $('#company_id').val();
                    data.project_id     = $('#project_id').val();
                }
            },
            columns: [
                { data: 'quotation',        name: 'q.quotation' },
                { data: 'date',             name: 'q.date' },
                { data: 'company_name',     name: 'c.name' },
                { data: 'project_name',     name: 'p.name' },
                { data: 'party_name',       name: 'q.name' },
                { data: 'total_amount',     name: 'q.total_amount',  className: 'text-end' },
                { data: 'discount',         name: 'q.discount',      className: 'text-end' },
                { data: 'tax_amount',       name: 'q.tax_amount',    className: 'text-end' },
                { data: 'net_amount',       name: 'q.net_amount',    className: 'text-end' },
                { data: 'staff_name',       name: 'st.name' },
                { data: 'created_by_name',  name: 'u.name' },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'text-end text-nowrap'
                },
            ],
        });

        // ---------- Filters ----------
        var timer;
        $(document).on('keyup', '#quotation', function () {
            clearTimeout(timer);
            timer = setTimeout(function () { table.ajax.reload(); }, 400);
        });

        $(document).on('change', '#quotation_date, #project_id', function () {
            table.ajax.reload();
        });

        // Company change -> project load -> reload
        $('#company_id').on('change', function () {
            var companyId = $(this).val();
            var $project = $('#project_id');

            $project.empty().append('<option value=""></option>').prop('disabled', true);

            if (!companyId) {
                $project.trigger('change');
                return;
            }

            var url = "{{ route('admin.store.projects', ':id') }}".replace(':id', companyId);

            $.get(url, function (projects) {
                $.each(projects, function (i, p) {
                    $project.append('<option value="' + p.id + '">' + $('<div>').text(p.name).html() + '</option>');
                });
                $project.prop('disabled', false).trigger('change');
            }).fail(function () {
                alert('Project load kora jayni');
                table.ajax.reload();
            });
        });

        // ---------- Delete ----------
        $(document).on('click', '.delete_btn', function () {
            var url = $(this).data('url');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This quotation will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
            }).then(function (result) {
                if (result.isConfirmed) {
                    var form = $('<form method="POST" action="' + url + '">' +
                        '@csrf' +
                        '<input type="hidden" name="_method" value="DELETE">' +
                        '</form>');
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    });
</script>
@endpush