<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Salary Sheet</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 13px;
            color: #333;
            background: #f5f6fa;
            padding: 20px;
        }

        .container {
            background: #fff;
            border: 1px solid #d9d9d9;
            padding: 20px;
        }

        /*==========================
            HEADER
        ==========================*/

        .company-header {
            width: 100%;
            border-bottom: 3px solid #4990ad;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .company-header table {
            width: 100%;
            border: none;
        }

        .company-header td {
            border: none;
            vertical-align: middle;
        }

        .logo {
            width: 130px;
        }

        .logo img {
            width: 110px;
        }

        .company-info {
            text-align: right;
        }

        .company-info h1 {
            color: #4990ad;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .company-info p {
            margin: 3px 0;
            color: #555;
            font-size: 13px;
        }

        .sheet-title {
            text-align: center;
            margin: 25px 0;
        }

        .sheet-title h2 {
            font-size: 24px;
            color: #4990ad;
            margin-bottom: 5px;
        }

        .sheet-title span {
            display: inline-block;
            padding: 6px 18px;
            background: #4990ad;
            color: #fff;
            border-radius: 30px;
            font-size: 13px;
        }

        /*==========================
            TABLE
        ==========================*/

        table.salary-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table.salary-table th {
            background: #4990ad;
            color: #fff;
            border: 1px solid #a4c9ff;
            padding: 10px;
            text-align: center;
        }

        table.salary-table td {
            border: 1px solid #dcdcdc;
            padding: 8px;
        }

        table.salary-table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        table.salary-table tbody tr:hover {
            background: #eef5ff;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        tfoot th {
            background: #212529;
            color: #fff;
            padding: 10px;
        }

        /*==========================
            SIGNATURE
        ==========================*/

        .signature {
            width: 100%;
            margin-top: 70px;
            border: none;
        }

        .signature td {
            border: none;
            width: 33%;
            text-align: center;
        }

        .signature .line {
            border-top: 1px solid #000;
            width: 180px;
            margin: auto;
            padding-top: 6px;
            font-weight: bold;
        }

        /*==========================
            PRINT BUTTON
        ==========================*/

        .print-btn {
            text-align: center;
            margin-bottom: 20px;
        }

        .print-btn button {
            background: #4990ad;
            color: #fff;
            border: none;
            padding: 10px 30px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .print-btn button:hover {
            background: #4990ad;
        }

        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {

            body {
                background: #fff;
                padding: 0;
                color:black;
            }

            .container {
                border: none;
            }

            .print-btn {
                display: none;
            }
            
        }
    </style>

</head>

<body>

<div class="print-btn">
    <button onclick="window.print()">🖨 Print Salary Sheet</button>
</div>

<div class="container">

    <!-- Header -->

    <div class="company-header">

        <table>

            <tr>

                <td class="logo">

                    <img src="{{ asset($setting->logo) }}">

                </td>

                <td class="company-info">

                    <h1>{{ $setting->title }}</h1>

                    <p>{{ $setting->address }}</p>

                    <p>
                        {{ $setting->primary_mobile }}
                        |
                        {{ $setting->primary_email }}
                    </p>

                </td>

            </tr>

        </table>

    </div>


    <!-- Salary Title -->

    <div class="sheet-title">

        <h2>EMPLOYEE SALARY SHEET</h2>

        <span>

            Payroll :
            {{ date('F',mktime(0,0,0,$request->payroll_month,1)) }}
            {{ $request->payroll_year }}

        </span>

    </div>


    <!-- Salary Table -->

    <table class="salary-table">

        <thead>

        <tr>

            <th width="5%">SL</th>
            <th width="10%">EmployeeID</th>
            <th>Name</th>
            <th style="text-align:right">Basic</th>
            <th style="text-align:right">House Rent</th>
            <th style="text-align:right">Medical</th>
            <th style="text-align:right">Other</th>
            <th style="text-align:right">Deduction</th>
            <th style="text-align:right">Net Salary</th>

        </tr>

        </thead>

        <tbody>

        @foreach($payrolls as $row)

            <tr>

                <td class="text-center">{{ $loop->iteration }}</td>

                <td class="text-center">{{ $row->employee_code }}</td>

                <td class="text-center">{{ $row->name }}</td>

                <td class="text-right">{{ number_format($row->basic_salary,2) }}</td>

                <td class="text-right">{{ number_format($row->house_rent,2) }}</td>

                <td class="text-right">{{ number_format($row->medical_allowance,2) }}</td>

                <td class="text-right">{{ number_format($row->other_allowance,2) }}</td>

                <td class="text-right">{{ number_format($row->total_deduction,2) }}</td>

                <td class="text-right">

                    <strong>{{ number_format($row->net_salary,2) }}</strong>

                </td>

            </tr>

        @endforeach

        </tbody>

        <tfoot>

        <tr>

            <th colspan="3" style="text-align:right">
                GRAND TOTAL
            </th>

            <th style="text-align:right">{{ number_format($payrolls->sum('basic_salary'),2) }}</th>

            <th style="text-align:right">{{ number_format($payrolls->sum('house_rent'),2) }}</th>

            <th style="text-align:right">{{ number_format($payrolls->sum('medical_allowance'),2) }}</th>

            <th style="text-align:right">{{ number_format($payrolls->sum('other_allowance'),2) }}</th>

            <th style="text-align:right">{{ number_format($payrolls->sum('total_deduction'),2) }}</th>

            <th style="text-align:right">{{ number_format($payrolls->sum('net_salary'),2) }}</th>

        </tr>

        </tfoot>

    </table>


    <!-- Signature -->

    <table class="signature">

        <tr>

            <td>

                <div class="line">

                    Prepared By

                </div>

            </td>

            <td>

                <div class="line">

                    Checked By

                </div>

            </td>

            <td>

                <div class="line">

                    Approved By

                </div>

            </td>

        </tr>

    </table>

</div>

</body>

</html>