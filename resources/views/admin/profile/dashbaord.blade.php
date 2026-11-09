@extends('layouts.admin.app')
@section('content')

    <!-- Embedded Modern Dashboard Stylesheet -->
    <style>
        .custom-info-card {
            border: none;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dashboard-chart-card{
            padding: 20px;
            color:#e44949;
        }
        .custom-info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
        }
        .card-metrics {
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 2;
        }
        .metric-title {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
        }
        .metric-value {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
        }
        .card-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            z-index: 2;
            transition: all 0.3s;
        }
        
        /* Premium Card Variations Base Styling */
        
    </style>

    <?php

if (! function_exists('bn_number')) {

    function bn_number($number)
    {
        $english = ['0','1','2','3','4','5','6','7','8','9','.'];
        $bangla  = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','.'];

        return str_replace($english, $bangla, $number);
    }
}
?>

    <div class="container-fluid px-0 py-3">
        <div class="row g-4 justify-content-center">
            
            <!-- ROW 1: CORE REVENUE METRICS -->
            <div class="col-12">
                <div class="row g-3">
                    @can('Customer')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-customer">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.customer')}}</span>
                                    <span class="metric-value">{{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['customers'] ?? 0), 2))
                                        : number_format((float)($info['customers'] ?? 0), 2)
                                    }}</span>
                                </div>
                                <div class="card-icon-box"><i class="fad fa-users"></i></div>
                            </div>
                        </div>
                    @endcan

                    @can('Total Sale')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-sales">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.total_sale')}}</span>
                                    <span class="metric-value">৳ {{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['total_sales'] ?? 0), 2))
                                        : number_format((float)($info['total_sales'] ?? 0), 2)
                                    }}</span>
                                </div>
                                <div class="card-icon-box"><i class="fal fa-receipt"></i></div>
                            </div>
                        </div>
                    @endcan

                    @can('Cash In')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-cash">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.cash_in')}}</span>
                                    <span class="metric-value">৳ {{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['cash_in'] ?? 0), 2))
                                        : number_format((float)($info['cash_in'] ?? 0), 2)
                                    }}</span>
                                </div>
                                <div class="card-icon-box"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                        </div>
                    @endcan

                    @can('Due')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-due">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.due')}}</span>
                                    <span class="metric-value">৳ {{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['due'] ?? 0), 2))
                                        : number_format((float)($info['due'] ?? 0), 2)
                                    }}</span>
                                </div>
                                <div class="card-icon-box"><i class="fal fa-money-bill-alt"></i></div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
         
            <!-- ROW 2: INVENTORY & EXPANSION METRICS -->
            <div class="col-12">
                <div class="row g-3">
                    @can('Total Products')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-products">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.total_product')}}</span>
                                    <span class="metric-value">
                                        {{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['total_products'] ?? 0), 2))
                                        : number_format((float)($info['total_products'] ?? 0), 2)
                                    }}
                                    </span>
                                </div>
                                <div class="card-icon-box"><i class="fad fa-box-open"></i></div>
                            </div>
                        </div>
                    @endcan

                    @can('Stock Value')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-stock">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.stock_value')}}</span>
                                    <span class="metric-value">
                                        ৳ {{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['stock_value'] ?? 0), 2))
                                        : number_format((float)($info['stock_value'] ?? 0), 2)
                                    }}</span>
                                </div>
                                <div class="card-icon-box"><i class="fad fa-chart-pie"></i></div>
                            </div>
                        </div>
                    @endcan

                    @can('Payment Due')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-due">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.payment_due')}}</span>
                                    <span class="metric-value">৳ {{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['payment_due'] ?? 0), 2))
                                        : number_format((float)($info['payment_due'] ?? 0), 2)
                                    }}</span>
                                </div>
                                <div class="card-icon-box"><i class="fal fa-receipt"></i></div>
                            </div>
                        </div>
                    @endcan

                    @can('Outstanding')
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="custom-info-card card-customer">
                                <div class="card-metrics">
                                    <span class="metric-title">{{__('messages.outstanding')}}</span>
                                    <span class="metric-value">৳ {{ app()->getLocale() == 'bn'
                                        ? bn_number(number_format((float)($info['outstanding'] ?? 0), 2))
                                        : number_format((float)($info['outstanding'] ?? 0), 2)
                                    }}</span>
                                </div>
                                <div class="card-icon-box"><i class="fal fa-money-bill-alt"></i></div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            <!-- ROW 3: ANALYTICS VISUALIZATION CHART -->
             @can('Total Sale')
            <div class="col-12">
                <div class="dashboard-chart-card">
                    <div class="mb-4">
                        <h5 class="m-0 chart-header-title">{{__('messages.sales_and_collection_chart')}}</h5>
                        <div class="chart-header-sub">{{__('messages.12_month_analytics')}}</div>
                    </div>
                    <div style="position: relative; height: 320px; width: 100%;">
                        <canvas id="bar_chart"></canvas>
                    </div>
                </div>
            </div>
            @endcan

        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: "{{ route('admin.dashboard') }}",
                data: {},
                success: function(response) {
                    if (response.status == 'success') {
                        var barData = {
                            labels: response.monthlyData.month,
                            datasets: [{
                                    label: "{{__('messages.sales')}}",
                                    backgroundColor: '#10b981',
                                    borderRadius: 4,
                                    data: response.monthlyData.sales_amount
                                },
                                {
                                    label: "{{__('messages.collection')}}",
                                    backgroundColor: '#f59e0b',
                                    borderRadius: 4,
                                    data: response.monthlyData.collection_amount
                                }
                            ]
                        };
                        var barOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: { boxWidth: 12, usePointStyle: true }
                                }
                            }
                        };
                        var ctx = document.getElementById("bar_chart").getContext("2d");
                        new Chart(ctx, {
                            type: 'bar',
                            data: barData,
                            options: barOptions
                        });
                    }
                }
            });

            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Region', 'Amount'],
                    @foreach ($RegionSales as $Regionsale)
                        ["{{ $Regionsale['name'] }}", {{ (float)($Regionsale['amount'] ?? 0) }}],
                    @endforeach
                ]);
                var options = {
                    is3D: true,
                    chartArea: { width: '90%', height: '80%' },
                    legend: { position: "right" },
                    responsive: true
                };
                
                var chartElement = document.getElementById('piechart');
                if(chartElement) {
                    var chart = new google.visualization.PieChart(chartElement);
                    chart.draw(data, options);
                }
            }
        });
    </script>
@endpush