@extends('layouts.admin.report_app')

@section('form')

    <input type="hidden" name="print" value="">
    <input type="hidden" name="filter" value="1">

    <div class="row g-3">

        {{-- Company --}}
        <div class="col-lg-4 col-sm-6">
            <label for="company_id" class="form-label"><b>Company <span class="text-danger">*</span></b></label>
            <select name="company_id" id="company_id" class="select form-select"
                    data-placeholder="Select Company" required>
                <option value=""></option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}"
                        {{ request('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Project --}}
        <div class="col-lg-4 col-sm-6">
            <label for="project_id" class="form-label"><b>Project</b></label>
            <select name="project_id" id="project_id" class="select form-select"
                    data-placeholder="All Project" disabled>
                <option value=""></option>
            </select>
        </div>

        {{-- COA Head --}}
        <div class="col-lg-4 col-sm-6">
            <label class="form-label"><b>COA Head</b></label>
             <select name="coa_setup_id" id="coa_setup_id" class="select form-select"
                    data-placeholder="Select COA Head" required>
                <option value="">All COA Head</option>
                @foreach ($coa_heads as $head)
                    <option value="{{ $head->id }}"
                        {{ request('coa_setup_id') == $head->id ? 'selected' : '' }}>
                        {{ $head->head_code }} - {{ $head->head_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Voucher Type --}}
        <div class="col-lg-4 col-sm-6">
            <label class="form-label"><b>Voucher Type</b></label>
            <select name="voucher_type" id="voucher_type" class="form-control select2">
                <option value="">All Voucher Type</option>
                @foreach ($voucher_types as $type)
                    <option value="{{ $type }}"
                        {{ request('voucher_type') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date Range --}}
        <div class="col-lg-4 col-sm-6">
            <label for="date_range" class="form-label"><b>Date Range</b></label>
            <input type="text"
                class="form-control date-range"
                name="date_range"
                id="date_range"
                placeholder="Select Date Range"
                data-time-picker="false"
                data-format="DD-MM-Y"
                data-separator=" to "
                autocomplete="off"
                required
                value="{{ request('date_range', date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date))) }}">
        </div>

    </div>

@endsection


@section('content')

    @php
        $detailQuery = function ($coaId) use ($start_date, $end_date) {
            return route('admin.head-details.index') . '?' . http_build_query([
                'coa_setup_id'     => $coaId,
                'start_date'       => $start_date,
                'end_date'         => $end_date,
                'income_statement' => 1,
                'company_id'       => request('company_id'),
                'branch_id'        => request('project_id'),
                'voucher_type'     => request('voucher_type'),
            ]);
        };
    @endphp

    <div class="row g-4">

        {{-- ===================== INCOME ===================== --}}
        <div class="col-md-6">
            <div class="table-responsive">
                <table id="incomeTable" class="table table-bordered table-sm mb-0">
                    <caption class="bg-primary text-white text-center fw-bold py-2" style="caption-side: top;">
                        Income
                    </caption>
                    <thead>
                        <tr>
                            <th class="text-center" width="60">SL#</th>
                            <th>Head Code</th>
                            <th>Head Name</th>
                            <th class="text-end">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incomes as $incomeList)
                            @php
                                $headCode = $incomeList->head_code;
                                $headName = $incomeList->head_name;
                                $link     = $detailQuery($incomeList->coa_setup_id);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><a href="{{ $link }}" target="_blank">{{ $headCode }}</a></td>
                                <td><a href="{{ $link }}" target="_blank">{{ $headName }}</a></td>
                                <td class="text-end">
                                    {{ $incomeList->amount >= 0
                                        ? number_format($incomeList->amount, 2)
                                        : '(' . number_format(abs($incomeList->amount), 2) . ')' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <th></th>
                            <th></th>
                            <th class="text-end">Total Income</th>
                            <th class="text-end">
                                {{ $totalIncome >= 0
                                    ? number_format($totalIncome, 2)
                                    : '(' . number_format(abs($totalIncome), 2) . ')' }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- ===================== EXPENSE ===================== --}}
        <div class="col-md-6">
            <div class="table-responsive">
                <table id="expenseTable" class="table table-bordered table-sm mb-0">
                    <caption class="bg-primary text-white text-center fw-bold py-2" style="caption-side: top;">
                        Expense
                    </caption>
                    <thead>
                        <tr>
                            <th class="text-center" width="60">SL#</th>
                            <th>Head Code</th>
                            <th>Head Name</th>
                            <th class="text-end">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                            @php
                                $headCode = $expense->head_code;
                                $headName = $expense->head_name;
                                $link     = $detailQuery($expense->coa_setup_id);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><a href="{{ $link }}" target="_blank">{{ $headCode }}</a></td>
                                <td><a href="{{ $link }}" target="_blank">{{ $headName }}</a></td>
                                <td class="text-end">
                                    {{ $expense->amount >= 0
                                        ? number_format($expense->amount, 2)
                                        : '(' . number_format(abs($expense->amount), 2) . ')' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <th></th>
                            <th></th>
                            <th class="text-end">Total Expense</th>
                            <th class="text-end">
                                {{ $totalExpense >= 0
                                    ? number_format($totalExpense, 2)
                                    : '(' . number_format(abs($totalExpense), 2) . ')' }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- ===================== PROFIT / LOSS ===================== --}}
        <div class="col-12">
            @if (request()->has('filter'))
                @if ($netProfit >= 0)
                    <h5 class="text-white bg-success text-center mb-0 py-3">
                        Net Profit: {{ number_format($netProfit, 2) }}
                    </h5>
                @else
                    <h5 class="text-white bg-danger text-center mb-0 py-3">
                        Net Loss: {{ number_format(abs($netProfit), 2) }}
                    </h5>
                @endif
            @endif
        </div>

    </div>

@endsection


@push('js')
    <script type="text/javascript">
        $(document).ready(function () {

            // ---------- DataTables (Excel export) ----------
            $('#incomeTable, #expenseTable').each(function () {
                let tableTitle = this.id === 'incomeTable'
                    ? 'Income Statement - Income'
                    : 'Income Statement - Expense';

                $(this).DataTable({
                    paging: false,
                    searching: false,
                    ordering: false,
                    info: false,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i> Excel',
                            className: 'btn btn-success btn-sm',
                            title: tableTitle,
                            footer: true
                        }
                    ]
                });
            });

            // ---------- PDF Print ----------
            $(document).on('click', '.getPdf', function (e) {
                e.preventDefault();
                $('input[name="print"]').val('true');
                $('.filter_form').submit();
            });

            // ---------- Filter Submit ----------
            $(document).on('click', '#filter_btn', function (e) {
                e.preventDefault();
                $('input[name="print"]').val('');
                $('.filter_form').submit();
            });

            // ---------- Company -> Project ----------
            var oldProject = "{{ request('project_id') }}";

            function loadProjects(companyId, selectedId) {
                var $project = $('#project_id');

                $project.empty().append('<option value="">All Project</option>').prop('disabled', true);

                if (!companyId) {
                    $project.trigger('change');
                    return;
                }

                var url = "{{ route('admin.store.projects', ':id') }}".replace(':id', companyId);

                $.get(url, function (projects) {
                    $.each(projects, function (i, p) {
                        $project.append($('<option>').val(p.id).text(p.name));
                    });

                    $project.prop('disabled', false);

                    if (selectedId) {
                        $project.val(selectedId);
                    }

                    $project.trigger('change');
                }).fail(function () {
                    alert('Project load kora jayni');
                });
            }

            $('#company_id').on('change', function () {
                loadProjects($(this).val(), null);
            });

            // Page load: filter-er por selected company-r project selected rakhe
            if ($('#company_id').val()) {
                loadProjects($('#company_id').val(), oldProject);
            }

        });
    </script>
@endpush