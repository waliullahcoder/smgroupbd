@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-12">
           <!-- Embedded Modern Dashboard Stylesheet -->
    <style>
        .custom-info-card {
            border: none;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid transparent;
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
        .card-customer { border-color: #3b82f6;background: linear-gradient(70deg, #3b82f6, #ffffff); }
        .card-customer .card-icon-box { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }

        .card-sales { border-color: #10b981; background: linear-gradient(70deg, #10b981, #ffffff);}
        .card-sales .card-icon-box { background: rgba(16, 185, 129, 0.1); color: #10b981; }

        .card-cash { border-color: #198754; background: linear-gradient(70deg, #198754, #ffffff);}
        .card-cash .card-icon-box { background: rgba(99, 102, 241, 0.1); color: #198754; }

        .card-due { border-color: #ef4444; background: linear-gradient(70deg, #ef4444, #ffffff); }
        .card-due .card-icon-box { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

        .card-products { border-color: #06b6d4; background: linear-gradient(70deg, #06b6d4, #ffffff);}
        .card-products .card-icon-box { background: rgba(6, 182, 212, 0.1); color: #06b6d4; }

        .card-stock { border-color: #f59e0b; background: linear-gradient(70deg, #f59e0b, #ffffff);}
        .card-stock .card-icon-box { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

        /* Chart Section Premium Border Box */
        .dashboard-chart-card {
            background: #ffffff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
            padding: 24px;
        }
        .chart-header-title {
            color: #0f172a;
            font-weight: 700;
            font-size: 16px;
        }
        .chart-header-sub {
            color: #64748b;
            font-size: 13px;
        }
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
    <div class="row g-4">

        <!-- Row 1 -->
        <div class="col-12">
            <div class="row g-3">

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-customer">
                        <div class="card-metrics">
                            <span class="metric-title">Total Lead</span>
                            <span class="metric-value">{{$total_lead}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fad fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-sales">
                        <div class="card-metrics">
                            <span class="metric-title">Proposal Value</span>
                            <span class="metric-value">৳ {{$total_proposal_value}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fal fa-receipt"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-cash">
                        <div class="card-metrics">
                            <span class="metric-title">Expected Value</span>
                            <span class="metric-value">৳ {{$total_expected_value}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-due">
                        <div class="card-metrics">
                            <span class="metric-title">Confirmed Value</span>
                            <span class="metric-value">৳ {{$total_confirmed_value}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fal fa-money-bill-alt"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Row 2 -->
        <div class="col-12">
            <div class="row g-3">

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-products">
                        <div class="card-metrics">
                            <span class="metric-title">Proposal Submit</span>
                            <span class="metric-value">{{$total_proposal_sent}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fad fa-box-open"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-stock">
                        <div class="card-metrics">
                            <span class="metric-title">Total Quotation</span>
                            <span class="metric-value">{{$total_quotations}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fad fa-chart-pie"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-due">
                        <div class="card-metrics">
                            <span class="metric-title">Sales Pipeline</span>
                            <span class="metric-value">৳ {{$total_confirmed_value}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fal fa-receipt"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="custom-info-card card-customer">
                        <div class="card-metrics">
                            <span class="metric-title">Converted Client</span>
                            <span class="metric-value">{{$total_confirmed}}</span>
                        </div>
                        <div class="card-icon-box">
                            <i class="fal fa-money-bill-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">

                <a href="{{ route('admin.crm-report.index') }}" class="text-decoration-none">

                    <div class="report-card">

                        <div class="report-content">

                            <span class="report-label">
                                CRM Reports
                            </span>

                            <h4 class="report-title">
                                Daily & Monthly Report
                            </h4>

                            <p class="report-text mb-0">
                                View lead performance, proposal value, expected value and business analytics.
                            </p>

                        </div>

                        <div class="report-icon">

                            <i class="fas fa-chart-line"></i>

                        </div>

                        <div class="report-arrow">

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </a>

            </div>
            <style>
                .report-card{
                position:relative;
                overflow:hidden;

                display:flex;
                align-items:center;
                justify-content:space-between;

                padding:28px 30px;

                border-radius:16px;

                background:linear-gradient(135deg, #059999, #00f9cb);

                color:#fff;

                transition:.35s ease;

                box-shadow:0 10px 30px rgba(37,99,235,.25);

            }

            .report-card:hover{

                transform:translateY(-5px);

                box-shadow:0 18px 40px rgba(37,99,235,.35);

            }

            .report-card::before{

                content:"";

                position:absolute;

                width:220px;
                height:220px;

                background:rgba(255,255,255,.08);

                border-radius:50%;

                right:-70px;
                top:-70px;

            }

            .report-content{

                position:relative;
                z-index:2;

            }

            .report-label{

                display:inline-block;

                padding:5px 12px;

                border-radius:30px;

                background:rgba(255,255,255,.15);

                font-size:13px;

                margin-bottom:12px;

            }

            .report-title{

                font-size:26px;

                font-weight:700;

                margin-bottom:8px;

            }

            .report-text{

                opacity:.9;

                font-size:15px;

                max-width:520px;

            }

            .report-icon{

                position:relative;

                z-index:2;

                width:80px;
                height:80px;

                border-radius:50%;

                background:rgba(255,255,255,.15);

                display:flex;
                align-items:center;
                justify-content:center;

                font-size:34px;

            }

            .report-arrow{

                position:absolute;

                right:25px;
                bottom:18px;

                color:#fff;

                opacity:.8;

                font-size:20px;

                transition:.3s;

            }

            .report-card:hover .report-arrow{

                transform:translateX(8px);

            }
            </style>



            </div>
        </div>

    </div>
</div>
        </div>
    </div>
@endsection


