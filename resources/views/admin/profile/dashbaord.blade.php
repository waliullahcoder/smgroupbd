@extends('layouts.admin.app')
@section('content')

    <style>
        .custom-info-card {
            border: none;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .custom-info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
        }
        .card-metrics { display: flex; flex-direction: column; gap: 4px; }
        .metric-title {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
        }
        .metric-value { font-size: 22px; font-weight: 700; color: #ffffff; }
        .card-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Card colors */
        .card-sales      { background: linear-gradient(135deg, #10b981, #059669); }
        .card-collection { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .card-expense    { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .card-profit     { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

        .dashboard-chart-card {
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.06);
        }
        .chart-header-title { font-weight: 700; color: #1f2937; }
        .chart-header-sub   { font-size: 13px; color: #6b7280; }
    </style>

    <div class="container-fluid px-0 py-3">
        <div class="row g-4 justify-content-center">

            <!-- ROW 1: CORE REVENUE METRICS (static) -->
            <div class="col-12">
                <div class="row g-3">

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="custom-info-card card-sales">
                            <div class="card-metrics">
                                <span class="metric-title">Total Sale</span>
                                <span class="metric-value">৳ {{number_format($sales,2)}}</span>
                            </div>
                            <div class="card-icon-box"><i class="fal fa-receipt"></i></div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="custom-info-card card-collection">
                            <div class="card-metrics">
                                <span class="metric-title">Total Collection</span>
                                <span class="metric-value">৳ {{number_format($total_collection,2)}}</span>
                            </div>
                            <div class="card-icon-box"><i class="fal fa-hand-holding-usd"></i></div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="custom-info-card card-expense">
                            <div class="card-metrics">
                                <span class="metric-title">Total Expense</span>
                                <span class="metric-value">৳ {{number_format($expense_total,2)}}</span>
                            </div>
                            <div class="card-icon-box"><i class="fas fa-dollar-sign"></i></div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="custom-info-card card-profit">
                            <div class="card-metrics">
                                <span class="metric-title">Profit / Loss</span>
                                <span class="metric-value">৳ {{number_format($profit_loss,2)}}</span>
                            </div>
                            <div class="card-icon-box"><i class="fal fa-money-bill-alt"></i></div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ROW 2: CHART (static) -->
            <div class="col-12">
                <div class="dashboard-chart-card">
                    <div class="mb-4">
                        <h5 class="m-0 chart-header-title">Sales &amp; Collection Chart</h5>
                        <div class="chart-header-sub">Last 12 months analytics</div>
                    </div>
                    <div style="position: relative; height: 320px; width: 100%;">
                        <canvas id="bar_chart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('bar_chart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Sales',
                            backgroundColor: '#10b981',
                            borderRadius: 4,
                            data: @json($chartSales)
                        },
                        {
                            label: 'Collection',
                            backgroundColor: '#f59e0b',
                            borderRadius: 4,
                            data: @json($chartCollection)
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { boxWidth: 12, usePointStyle: true }
                        }
                    }
                }
            });
        });
    </script>
@endpush