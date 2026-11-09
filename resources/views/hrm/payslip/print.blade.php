  @if($payroll)

  <style>
@media print {

    .card-header,
    .card-body form,
    .btn-print {
        display: none;
    }

    body {
        background: #fff;
    }

}

.payslip {

    margin-top: 25px;
    border: 1px solid #ccc;
    padding: 25px;
    background: #fff;

}

.company-title {

    text-align: center;
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 15px;
    margin-bottom: 20px;

}

.company-title h2 {

    margin: 0;
    color: #0d6efd;

}

.info-table {

    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;

}

.info-table td {

    padding: 6px;

}

.salary-table {

    width: 100%;
    border-collapse: collapse;

}

.salary-table th {

    background: #0d6efd;
    color: #fff;

}

.salary-table th,
.salary-table td {

    border: 1px solid #ccc;
    padding: 8px;

}

.total {

    font-weight: bold;
    background: #f5f5f5;

}

.signature {

    margin-top: 60px;
    width: 100%;

}

.signature td {

    text-align: center;

}

.signature div {

    border-top: 1px solid #000;
    width: 170px;
    margin: auto;
    padding-top: 5px;

}

.company-header {
    width: 100%;
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.company-header table {
    width: 100%;
    border-collapse: collapse;
}

.company-header td {
    border: none;
    vertical-align: middle;
}

.company-logo {
    width: 18%;
}

.company-logo img {
    width: 258px;
    height: auto;
}

.company-info {
    width: 82%;
    text-align: right;
}

.company-info h2 {
    margin: 0;
    color: #0d6efd;
    font-size: 28px;
    font-weight: 700;
}

.company-info p {
    margin: 3px 0;
    color: #555;
    font-size: 13px;
}

.payslip-title {
    text-align: center;
    margin: 20px 0;
}

.payslip-title h3 {
    margin: 0;
    color: #222;
    font-size: 24px;
    font-weight: bold;
}

.payslip-title span {
    display: inline-block;
    margin-top: 8px;
    padding: 6px 18px;
    background: #0d6efd;
    color: #fff;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
}

.back-btn {
    align-items: center;
    gap: 8px;
    padding: 13px 18px;
    background: #0d6efd;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    transition: .3s ease;
    box-shadow: 0 2px 8px rgba(13, 110, 253, .25);
}

.back-btn:hover {
    background: #0b5ed7;
    color: #fff;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, .35);
}

.back-btn i {
    font-size: 13px;
}
  </style>

  <div class="card mt-3">

      <div class="card-body">

          <div class="text-end btn-print mb-3">

              <button onclick="window.print()" class="btn btn-primary back-btn">

                  <i class="fa fa-print"></i>

                  Print Payslip

              </button>
              <a href="{{ route('admin.pay.slip') }}" class="back-btn">
                  <i class="fas fa-arrow-left"></i> Back
              </a>

          </div>

          <div class="payslip">

              <div class="company-header">

                  <table>

                      <tr>

                          <td class="company-logo">
                              <img src="{{ asset($setting->logo) }}" alt="Logo">
                          </td>

                          <td class="company-info">

                              <h2>{{ $setting->title }}</h2>

                              <p>{{ $setting->address }}</p>

                              <p>
                                  <strong>Mobile :</strong> {{ $setting->primary_mobile }}
                              </p>

                              <p>
                                  <strong>Email :</strong> {{ $setting->primary_email }}
                              </p>

                          </td>

                      </tr>

                  </table>

              </div>

              <div class="payslip-title">

                  <h3>EMPLOYEE PAY SLIP</h3>

                  <span>
                      {{ $payroll_month }} - {{ $payroll_year }}
                  </span>

              </div>


              <table class="info-table">

                  <tr>

                      <td><b>Employee ID</b></td>

                      <td>{{ $payroll->employee_code }}</td>

                      <td><b>Name</b></td>

                      <td>{{ $payroll->name }}</td>

                  </tr>

                  <tr>

                      <td><b>Department</b></td>

                      <td>{{ $payroll->department }}</td>

                      <td><b>Designation</b></td>

                      <td>{{ $payroll->designation }}</td>

                  </tr>

              </table>


              <table class="salary-table">

                  <tr>

                      <th>Earnings</th>

                      <th align="right">Amount</th>

                      <th>Deductions</th>

                      <th align="right">Amount</th>

                  </tr>

                  <tr>

                      <td>Basic Salary</td>

                      <td align="right">{{ number_format($payroll->basic_salary,2) }}</td>

                      <td>Late Deduction</td>

                      <td align="right">{{ number_format($payroll->late_deduction,2) }}</td>

                  </tr>

                  <tr>

                      <td>House Rent</td>

                      <td align="right">{{ number_format($payroll->house_rent,2) }}</td>

                      <td>Provident Fund</td>

                      <td align="right">{{ number_format($payroll->provident_fund,2) }}</td>

                  </tr>

                  <tr>

                      <td>Medical</td>

                      <td align="right">{{ number_format($payroll->medical_allowance,2) }}</td>

                      <td>Loan</td>

                      <td align="right">{{ number_format($payroll->loan_deduction,2) }}</td>

                  </tr>

                  <tr>

                      <td>Conveyance</td>

                      <td align="right">{{ number_format($payroll->conveyance_allowance,2) }}</td>

                      <td>Advance</td>

                      <td align="right">{{ number_format($payroll->advance_deduction,2) }}</td>

                  </tr>

                  <tr>

                      <td>Food</td>

                      <td align="right">{{ number_format($payroll->food_allowance,2) }}</td>

                      <td>Tax</td>

                      <td align="right">{{ number_format($payroll->tax,2) }}</td>

                  </tr>

                  <tr>

                      <td>Other Allowance</td>

                      <td align="right">{{ number_format($payroll->other_allowance,2) }}</td>

                      <td>Other Deduction</td>

                      <td align="right">{{ number_format($payroll->other_deduction,2) }}</td>

                  </tr>

                  <tr class="total">

                      <td><b>Gross Salary</b></td>

                      <td align="right">

                          <b>{{ number_format($payroll->gross_salary,2) }}</b>

                      </td>

                      <td><b>Total Deduction</b></td>

                      <td align="right">

                          <b>{{ number_format($payroll->total_deduction,2) }}</b>

                      </td>

                  </tr>

                  <tr class="total">

                      <td colspan="3">

                          <h4>NET SALARY</h4>

                      </td>

                      <td align="right">

                          <h4>{{ number_format($payroll->net_salary,2) }}</h4>

                      </td>

                  </tr>

              </table>

              <table class="signature">

                  <tr>

                      <td>

                          <div>

                              Employee Signature

                          </div>

                      </td>

                      <td>

                          <div>

                              Authorized Signature

                          </div>

                      </td>

                  </tr>

              </table>

          </div>

      </div>

  </div>

  @endif