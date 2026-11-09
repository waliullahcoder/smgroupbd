<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Requirement</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: #f5f6fa;
        font-family: Arial, Helvetica, sans-serif;
    }

    .invoice {
        width: 900px;
        margin: 30px auto;
        background: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, .08);
    }

    .invoice-header {
        padding: 30px;
        border-bottom: 3px solid #0d6efd;
    }

    .company-logo {
        width: 80px;
    }

    .company-name {
        font-size: 28px;
        font-weight: bold;
        color: #0d6efd;
    }

    .company-address {
        font-size: 14px;
        color: #666;
    }

    .title {
        font-size: 30px;
        font-weight: 700;
        text-align: right;
        color: #555;
    }

    .section {
        padding: 25px 30px;
    }

    .info-table {
        width: 100%;
    }

    .info-table td {
        padding: 8px 10px;
        border: 1px solid #dee2e6;
    }

    .label {
        width: 180px;
        background: #f8f9fa;
        font-weight: bold;
    }

    .req-title {

        font-size: 22px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #0d6efd;

    }

    .req-details {

        border: 1px solid #dee2e6;
        padding: 20px;
        min-height: 250px;
        border-radius: 5px;
        background: white;

    }

    .req-details img {
        max-width: 100%;
    }

    .footer {

        padding: 20px 30px;
        border-top: 1px solid #ddd;

    }

    .signature {

        margin-top: 80px;
        text-align: center;

    }

    .signature hr {

        margin-bottom: 5px;

    }

    .print-btn {

        margin: 30px auto;
        width: 900px;
        text-align: right;

    }

    @media print {

        body {

            background: white;

        }

        .print-btn {

            display: none;

        }

        .invoice {

            width: 100%;
            margin: 0;
            border: none;
            box-shadow: none;

        }

    }
    </style>

</head>

<body>

    <div class="print-btn">
       <a href="{{route('admin.customer-requirement.index')}}" class="btn btn-danger">
            Back
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            🖨 Print Requirement
        </button>

    </div>

    <div class="invoice">

        <div class="invoice-header">

            <div class="row">

                <div class="col-md-7">

                    <img src="{{ file_exists(@$admin_setting->logo) ? asset(@$admin_setting->logo) : asset('backend/images/logo/logo.png') }}" class="company-logo">

                    <div class="company-name">

                       {{$setting->title}}

                    </div>

                    <div class="company-address">

                        {{$setting->address}}<br>

                        Phone : {{$setting->primary_mobile}}<br>

                        Email : {{$setting->primary_email}}

                    </div>

                </div>

                <div class="col-md-5 text-end">

                    <div class="title">

                        REQUIREMENT

                    </div>

                    <h4>
                        Requirement #REQNO{{ $data->id }}

                    </h4>

                </div>

            </div>

        </div>

        <div class="section">

            <table class="info-table">

                <tr>

                    <td class="label">Customer</td>

                    <td>{{ $data->company_name }}</td>

                    <td class="label">Meeting Type</td>

                    <td>{{ $data->meeting_type }}</td>

                </tr>

                <tr>

                    <td class="label">Related Module</td>

                    <td>{{ $data->related_module }}</td>

                    <td class="label">Date</td>

                    <td>{{ date('d M Y',strtotime($data->req_date)) }}</td>

                </tr>

                <tr>

                    <td class="label">Record Time</td>

                    <td>{{ $data->record_time }}</td>

                    <td class="label">Status</td>

                    <td>

                        @if($data->requirement_status==1)

                        <span class="badge bg-warning">

                            Scheduled

                        </span>

                        @elseif($data->requirement_status==2)

                        <span class="badge bg-success">

                            Confirmed

                        </span>

                        @else

                        <span class="badge bg-danger">

                            Cancelled

                        </span>

                        @endif

                    </td>

                </tr>

            </table>

        </div>

        <div class="section">

            <div class="req-title">

                Requirement Details

            </div>

            <div class="req-details">

                {!! $data->requirement_details !!}

            </div>

        </div>

        <div class="footer">

            <div class="row">

                <div class="col-6">

                    <div class="signature">

                        <hr>

                        Prepared By

                    </div>

                </div>

                <div class="col-6">

                    <div class="signature">

                        <hr>

                        Authorized Signature

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>