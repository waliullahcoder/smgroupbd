
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salary Certificate</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: "Times New Roman", serif;
            background:#f5f5f5;
            padding:30px;
            color:#222;
        }

        .certificate{

            width:850px;
            margin:auto;
            background:#fff;
            border:8px solid #28b2cf;
            padding:50px;
            position:relative;
        }

        .certificate:before{

            content:'';
            position:absolute;
            top:12px;
            left:12px;
            right:12px;
            bottom:12px;
            border:2px solid #d6d6d6;
        }

        .content{
            position:relative;
            z-index:2;
        }

        .header{

            text-align:center;
            margin-bottom:35px;

        }

        .header img{

            height:70px;
            margin-bottom:10px;

        }

        .company{

            font-size:28px;
            font-weight:bold;
            color:#0d6efd;

        }

        .address{

            font-size:14px;
            margin-top:5px;

        }

        .title{

            text-align:center;
            margin:35px 0;

        }

        .title h2{

            display:inline-block;
            border-bottom:2px solid #000;
            padding-bottom:6px;
            letter-spacing:2px;

        }

        .body{

            font-size:18px;
            line-height:2;

        }

        table{

            width:100%;
            border-collapse:collapse;
            margin:25px 0;

        }

        table td{

            border:1px solid #ddd;
            padding:10px 15px;

        }

        table td:first-child{

            width:35%;
            background:#f7f7f7;
            font-weight:bold;

        }

        .footer{

            margin-top:70px;

        }

        .signature{

            width:250px;
            text-align:center;
            float:right;

        }

        .signature .line{

            border-top:1px solid #000;
            margin-bottom:8px;

        }

        .print-btn{

            text-align:center;
            margin-bottom:20px;

        }

        @media print{

            body{

                background:#fff;
                padding:0;

            }

            .certificate{

                width:100%;
                border:none;

            }

            .print-btn{

                display:none;

            }

        }
    .back-btn{
        align-items:center;
        gap:8px;
        padding:13px 18px;
        background:#0d6efd;
        color:#fff;
        text-decoration:none;
        border-radius:6px;
        font-size:14px;
        font-weight:600;
        transition:.3s ease;
        box-shadow:0 2px 8px rgba(13,110,253,.25);
    }

    .back-btn:hover{
        background:#0b5ed7;
        color:#fff;
        text-decoration:none;
        transform:translateY(-2px);
        box-shadow:0 4px 12px rgba(13,110,253,.35);
    }

    .back-btn i{
        font-size:13px;
    }
    </style>

</head>
<body>

<div class="print-btn">

    <button onclick="window.print()"
            style="padding:10px 30px;font-size:16px;cursor:pointer;">
        Print Certificate
    </button>
   <a href="{{ route('admin.salary.structure', $employee->id) }}" class="back-btn">
    <i class="fas fa-arrow-left"></i> Back
    </a>

</div>

<div class="certificate">

    <div class="content">

        <div class="header">

            {{-- Company Logo --}}
            <img src="{{ asset($setting->logo) }}">

            <div class="company">
                {{$setting->title}}
            </div>

            <div class="address">
               {{$setting->address}}<br>
                Phone : {{$setting->primary_mobile}}
            </div>

        </div>

        <div class="title">

            <h2>SALARY CERTIFICATE</h2>

        </div>

        <div class="body">

            <p style="text-align:justify">

                This is to certify that
                <strong>{{ $employee->name }}</strong>,
                Employee ID
                <strong>{{ $employee->code }}</strong>,
                is a permanent employee of
                <strong>{{ config('app.name') }}</strong>.

                He/She is currently working as
                <strong>{{ $employee->designation ?? 'N/A' }}</strong>
                in the
                <strong>{{ $employee->type ?? 'N/A' }}</strong>
                department.

            </p>

            <table>

                <tr>
                    <td>Employee Name</td>
                    <td>{{ $employee->name }}</td>
                </tr>

                <tr>
                    <td>Employee ID</td>
                    <td>{{ $employee->code }}</td>
                </tr>

                <tr>
                    <td>Designation</td>
                    <td>{{ $employee->designation ?? '-' }}</td>
                </tr>

                <tr>
                    <td>Department</td>
                    <td>{{ $employee->type ?? '-' }}</td>
                </tr>

                <tr>
                    <td>Date of Joining</td>
                    <td>{{ date('d M, Y',strtotime($employee->joining_date)) }}</td>
                </tr>

                <tr>
                    <td>Gross Salary</td>
                    <td>
                        Tk.
                        {{ number_format($employee->total_salary ?? 0,2) }}
                        Per Month
                    </td>
                </tr>

            </table>

            <p style="text-align:justify">

                This certificate has been issued upon the request of the employee
                for whatever purpose it may serve. The information stated above
                is true and correct according to the company records.

            </p>

        </div>

        <div class="footer">

            <div style="float:left">
                Date :
                {{ date('d M, Y') }}
            </div>

            <div class="signature">

                <div style="height:60px"></div>

                <div class="line"></div>

                <strong>Authorized Signature</strong>

            </div>

            <div style="clear:both"></div>

        </div>

    </div>

</div>

</body>
</html>

