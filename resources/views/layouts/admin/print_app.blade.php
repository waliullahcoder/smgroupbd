<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ @$title }}</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('backend/css/old.bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&family=Noto+Serif+Bengali:wght@100..900&display=swap"
        rel="stylesheet">
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
<style>
body,*{
    font-family: 'SolaimanLipi', sans-serif;
}
</style>
    <style>
        body {
            font-family: "Noto Serif Bengali", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }

        .heading-area {
            font-family: 'PT Serif', serif;
            font-style: italic;
            text-align: center;
            line-height: 1;
        }

        .heading {
            margin-bottom: 10px;
        }

        .heading-title {
            margin-bottom: 0px;
            line-height: 1;
        }

        .heading-info,
        .heading-title {
            font-weight: bold;
        }

        .heading-info {
            font-size: 14px;
            margin-top: 2px;
        }

        .report-title {
            font-weight: bold;
            padding: 3px 0 6px;
            background-color: #ddd;
        }

        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
            padding: 0 20px;
            font-size: 13px;
        }

        @media screen,
        print {
            .text-nowrap {
                white-space: nowrap;
            }

            tfoot,
            thead {
                color: #fff;
                background-color: #00ABBD;

            }

            .bg-primary {
                background-color: #00ABBD;
            }

            .info-table td {
                padding: 5px 8px !important;
                font-size: 13px;
            }

            .align-middle * {
                vertical-align: middle !important;
            }

            .mb-0 {
                margin-bottom: 0 !important;
            }

            .mb-2 {
                margin-bottom: 0.5rem !important;
            }

            .mb-3 {
                margin-bottom: 1rem !important;
            }

            .signature-area {
                margin-top: 70px;
            }

            .signature-item {
                width: 150px;
                border-top: 1px solid #333;
                text-align: center;
                margin: 0 auto;
                position: relative;
                font-family: 'PT Serif', serif;
            }

            .signature-item:first-child {
                float: left;
            }

            .signature-item:last-child {
                float: right;
            }

            #report-header {
                background-color: lightgray;
                width: 100%;
                text-align: center;
                font-weight: bold;
                font-size: 15px;
                font-family: 'PT Serif', serif;
                padding: 10px 0;
                line-height: 1;
                margin-bottom: 5px;
            }

            #report-header th {
                padding: 2px 10px !important;
                line-height: 1;
            }

            .progress {
                display: flex;
                height: auto;
                overflow: hidden;
                font-size: 0.65625rem;
                background-color: #cfcfcf;
                border-radius: 0.25rem;
                margin-bottom: 0;
            }

            .progress-bar {
                display: flex;
                flex-direction: column;
                justify-content: center;
                color: #fff;
                text-align: center;
                background-color: #fb9678;
                transition: width 0.6s ease;
            }

            .progress-bar-success {
                background-image: -webkit-linear-gradient(top, #5cb85c 0, #449d44 100%);
                background-image: -o-linear-gradient(top, #5cb85c 0, #449d44 100%);
                background-image: -webkit-gradient(linear, left top, left bottom, from(#5cb85c), to(#449d44));
                background-image: linear-gradient(to bottom, #5cb85c 0, #449d44 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5cb85c', endColorstr='#ff449d44', GradientType=0);
                background-repeat: repeat-x;
            }

            .progress-parcent {
                font-size: 12px;
                color: #222;
            }

            .text-sm {
                font-size: 13px !important;
            }

            .staff {
                position: absolute;
                top: -32px;
                left: 50%;
                transform: translateX(-50%);
                white-space: nowrap;
            }

            .overflow-hidden {
                overflow: hidden;
            }

            .d-inline-block {
                display: inline-block;
            }

            .table th,
            .table td {
                padding: 3px 10px !important;
                line-height: 1 !important;
            }

            .table tfoot th,
            .table tfoot td,
            .table thead th {
                font-family: 'PT Serif', serif;
                padding: 0px 10px 5px !important;
            }

            ul {
                margin: 0;
                padding-left: 15px;
            }
        }
    </style>
    @stack('css')
</head>

<body>
    <div class="heading-area">
        <div class="heading text-center mb-3">
            <h3 class="heading-title">{{ @$title }}</h3>
            <h4 class="heading-info">{!! @$informations !!}</h4>
        </div>
        @isset($report_title)
            <h4 class="report-title mb-2">{!! $report_title !!}</h4>
        @endisset
    </div>
    @yield('content')
    @stack('js')
</body>

</html>
