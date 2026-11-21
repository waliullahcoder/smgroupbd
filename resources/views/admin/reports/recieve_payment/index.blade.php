@extends('layouts.admin.report_app')

@section('form')

    <input type="hidden" name="print" value="">
    <input type="hidden" name="export" value="">
    <input type="hidden" name="filter" value="1">

    <div class="row g-3">

        <div class="col-md-6">
            <label class="form-label fw-semibold">
                <i class="bi bi-calendar-range me-1 text-muted"></i> Date Range
            </label>

            <input type="text"
                   class="form-control date-range"
                   name="date_range"
                   data-time-picker="true"
                   data-format="DD-MM-Y"
                   data-separator=" to "
                   autocomplete="off"
                   required
                   value="{{ request('date_range') ?: date('d-m-Y', strtotime($start_date)).' to '.date('d-m-Y', strtotime($end_date)) }}">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">
                <i class="bi bi-journal-text me-1 text-muted"></i> Head
            </label>

            <select name="coa_setup_id" id="coa_setup_id" class="form-select select" data-placeholder="Select Head">
                <option value="">All Head</option>
                @foreach($heads as $head)
                    <option value="{{ $head->id }}"
                        {{ request('coa_setup_id') == $head->id ? 'selected' : '' }}>
                        {{ $head->head_code }} - {{ $head->head_name }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

@endsection

@section('content')

    <style>
        .rc-report { --rc-ink:#1f2a37; --rc-muted:#6b7280; --rc-line:#e5e7eb; --rc-soft:#f6f8fb; --rc-accent:#0f766e; --rc-accent-soft:#e6f4f2; }

        .rc-summary { display:flex; flex-wrap:wrap; gap:1rem; margin-bottom:1.25rem; }
        .rc-stat { flex:1 1 220px; background:#fff; border:1px solid var(--rc-line); border-left:4px solid var(--rc-accent); border-radius:.5rem; padding:.9rem 1.1rem; }
        .rc-stat .rc-stat-label { font-size:.8rem; color:var(--rc-muted); margin-bottom:.15rem; }
        .rc-stat .rc-stat-value { font-size:1.5rem; font-weight:700; color:var(--rc-ink); font-variant-numeric:tabular-nums; line-height:1.2; }
        .rc-stat.is-total { background:var(--rc-accent-soft); border-color:#b9ddd8; border-left-color:var(--rc-accent); }
        .rc-stat.is-total .rc-stat-value { color:var(--rc-accent); }

        .rc-card { background:#fff; border:1px solid var(--rc-line); border-radius:.6rem; overflow:hidden; }
        .rc-card-head { display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:.9rem 1.25rem; border-bottom:1px solid var(--rc-line); background:var(--rc-soft); }
        .rc-card-head h5 { margin:0; font-size:1.05rem; font-weight:700; color:var(--rc-ink); }
        .rc-card-head small { color:var(--rc-muted); }

        .rc-table { margin:0; width:100%; font-size:.92rem; }
        .rc-table thead th { background:#fff; color:var(--rc-muted); font-weight:600; font-size:.82rem; border-bottom:2px solid var(--rc-line); padding:.7rem 1rem; white-space:nowrap; }
        .rc-table tbody td { padding:.65rem 1rem; border-bottom:1px solid var(--rc-line); color:var(--rc-ink); vertical-align:middle; }
        .rc-table tbody tr:nth-child(even) { background:#fbfcfd; }
        .rc-table tbody tr:hover { background:var(--rc-accent-soft); }
        .rc-table tbody tr:last-child td { border-bottom:0; }
        .rc-table .rc-code { font-variant-numeric:tabular-nums; font-weight:600; color:var(--rc-accent); background:var(--rc-accent-soft); border-radius:.35rem; padding:.15rem .5rem; display:inline-block; }
        .rc-table .rc-amount { text-align:right; font-variant-numeric:tabular-nums; font-weight:600; white-space:nowrap; }
        .rc-table tfoot th { background:var(--rc-soft); border-top:2px solid var(--rc-accent); padding:.85rem 1rem; font-size:1rem; color:var(--rc-ink); }
        .rc-table tfoot th.rc-amount { color:var(--rc-accent); font-size:1.1rem; }

        .rc-empty { text-align:center; padding:2.5rem 1rem !important; color:var(--rc-muted); }
        .rc-empty i { font-size:2rem; display:block; margin-bottom:.4rem; opacity:.6; }

        @media (max-width: 576px) {
            .rc-stat .rc-stat-value { font-size:1.25rem; }
            .rc-table thead th, .rc-table tbody td, .rc-table tfoot th { padding:.55rem .6rem; }
        }
        @media print {
            .rc-card, .rc-stat { border-color:#999; }
            .rc-table tbody tr:hover { background:transparent; }
        }
    </style>

    <div class="rc-report">

        {{-- Summary --}}
        <div class="rc-summary">
            <div class="rc-stat">
                <div class="rc-stat-label">Period</div>
                <div class="rc-stat-value" style="font-size:1.05rem;">
                    {{ date('d-m-Y', strtotime($start_date)) }} to {{ date('d-m-Y', strtotime($end_date)) }}
                </div>
            </div>

            <div class="rc-stat">
                <div class="rc-stat-label">Heads</div>
                <div class="rc-stat-value">{{ count($data) }}</div>
            </div>

            <div class="rc-stat is-total">
                <div class="rc-stat-label">Total receive</div>
                <div class="rc-stat-value">{{ number_format($total_amount, 2) }}</div>
            </div>
        </div>

        {{-- Table --}}
        <div class="rc-card">

            <div class="rc-card-head">
                <h5>Receive Collection</h5>
                <small>{{ count($data) }} {{ count($data) == 1 ? 'record' : 'records' }}</small>
            </div>

            <div class="table-responsive">
                <table class="table rc-table">

                    <thead>
                        <tr>
                            <th class="text-center" width="70">SL#</th>
                            <th>Head Code</th>
                            <th>Head Name</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                <td><span class="rc-code">{{ $row->coa->head_code ?? '' }}</span></td>
                                <td>{{ $row->coa->head_name ?? '' }}</td>
                                <td class="rc-amount">{{ number_format($row->total_amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="rc-empty">
                                    <i class="bi bi-inbox"></i>
                                    No data found. Change the date range or head, then search again.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Receive</th>
                            <th class="rc-amount">{{ number_format($total_amount, 2) }}</th>
                        </tr>
                    </tfoot>

                </table>
            </div>

        </div>

    </div>

@endsection

@push('js')

<script>
    $(document).ready(function () {

        // Search
        $(document).on('click', '#filter_btn', function (e) {
            e.preventDefault();

            $('input[name="export"]').val('');

            $('.filter_form').submit();
        });

        // Excel Export
        $(document).on('click', '#export_excel', function (e) {
            e.preventDefault();

            $('input[name="export"]').val('excel');

            $('.filter_form').submit();
        });

    });
</script>

@endpush