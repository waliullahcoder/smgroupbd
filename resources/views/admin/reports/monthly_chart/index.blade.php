@extends('layouts.admin.report_app')

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div>
                <canvas id="bar_chart" style="height: 250px; display: block;" height="250"
                    class="chartjs-render-monitor"></canvas>
            </div>
        </div>
        <div class="col-12">
            <div>
                <canvas id="bar_chart2" style="height: 250px; display: block;" height="250"
                    class="chartjs-render-monitor"></canvas>
            </div>
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
                url: "{{ Route(request()->route()->getName()) }}",
                data: {},
                success: function(response) {
                    if (response.status == 'success') {
                        var barData = {
                            labels: response.months,
                            datasets: [{
                                label: "Sales",
                                backgroundColor: '#fb9678',
                                data: response.sales
                            }]
                        };
                        var barOptions = {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                        var ctx = document.getElementById("bar_chart").getContext("2d");
                        new Chart(ctx, {
                            type: 'bar',
                            data: barData,
                            options: barOptions
                        });

                        var barData2 = {
                            labels: response.months,
                            datasets: [{
                                label: "Profit",
                                backgroundColor: '#2ecc71',
                                data: response.profit
                            }]
                        };

                        var ctx = document.getElementById("bar_chart2").getContext("2d");
                        new Chart(ctx, {
                            type: 'bar',
                            data: barData2,
                            options: barOptions
                        });
                    }
                }
            });
        });
    </script>
@endpush
