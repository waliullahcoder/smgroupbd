@extends('layouts.admin.app')

@section('content')
<style>
    .card-header{
      margin-top:10px;
    }
    </style>
<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">
                    <i class="fas fa-user-check text-success"></i>
                    Edit Payroll
                </h5>

            </div>

            <div class="card-body">

                
                  <form action="{{ route('admin.payroll.update',$id) }}" method="POST">
                            @csrf
                            @method('PUT')
                       <input type="hidden" name="employee_id" value="{{$data->id}}">
                        <div class="row g-3">

                            <!-- Payroll Information -->

                            <div class="col-lg-4">
                                <label><b>Payroll Month</b></label>
                                <select name="payroll_month" class="form-control">
                                    @for($i=1;$i<=12;$i++)
                                        <option value="{{ $i }}"
                                            {{ $data->payroll_month==$i ? 'selected' : '' }}>
                                            {{ date('F',mktime(0,0,0,$i,1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label><b>Payroll Year</b></label>
                                <select name="payroll_year" class="form-control">
                                    @for($i=date('Y')-2;$i<=date('Y')+2;$i++)
                                        <option value="{{ $i }}"
                                            {{ $data->payroll_year==$i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label><b>Payment Type</b></label>
                                <select name="payment_type" class="form-control">
                                    <option value="Monthly" {{ $data->payment_type=='Monthly'?'selected':'' }}>Monthly</option>
                                    <option value="Daily" {{ $data->payment_type=='Daily'?'selected':'' }}>Daily</option>
                                    <option value="Hourly" {{ $data->payment_type=='Hourly'?'selected':'' }}>Hourly</option>
                                </select>
                            </div>

                            <!-- Salary -->
                                
                           <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-money-bill-wave"></i>
                                Salary Structure
                            </div>

                            <div class="card-body">

                                <div class="row g-3">

                                    <div class="col-md-3">
                                        <label>Basic Salary</label>
                                        <input type="number" name="basic_salary" id="basic_salary" class="form-control salary" value="{{ old('basic_salary',$data->basic_salary) }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>House Rent</label>
                                        <input type="number" name="house_rent" id="house_rent" class="form-control salary" value="{{ old('house_rent',$data->house_rent) }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Medical</label>
                                        <input type="number" name="medical_allowance" id="medical_allowance" class="form-control salary" value="{{old('medical_allowance',$data->medical_allowance)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Conveyance</label>
                                        <input type="number" name="conveyance_allowance" id="conveyance_allowance" class="form-control salary" value="{{old('conveyance_allowance',$data->conveyance_allowance)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Food</label>
                                        <input type="number" name="food_allowance" id="food_allowance" class="form-control salary" value="{{old('food_allowance',$data->food_allowance)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Mobile Bill</label>
                                        <input type="number" name="mobile_allowance" id="mobile_allowance" class="form-control salary" value="{{old('mobile_allowance',$data->mobile_allowance)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Other Allowance</label>
                                        <input type="number" name="other_allowance" id="other_allowance" class="form-control salary"  value="{{old('other_allowance',$data->other_allowance)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>OT Amount</label>
                                        <input type="number" name="overtime_amount" id="overtime_amount" class="form-control salary" value="{{old('overtime_amount',$data->overtime_amount)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label><b>Gross Salary</b></label>
                                        <input type="number" id="gross_salary" name="gross_salary" class="form-control" readonly value="{{ $data->gross_salary }}">
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="card mb-3">

                            <div class="card-header bg-danger text-white">
                                <i class="fas fa-minus-circle"></i>
                                Salary Deduction
                            </div>

                            <div class="card-body">

                                <div class="row g-3">

                                    <div class="col-md-3">
                                        <label>Late Deduction</label>
                                        <input type="number" name="late_deduction" id="late_deduction" class="form-control deduction" value="{{old('late_deduction',$data->late_deduction)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Tax</label>
                                        <input type="number" name="tax" id="tax" class="form-control deduction" value="{{old('tax',$data->tax)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Provident Fund</label>
                                        <input type="number" name="provident_fund" id="provident_fund" class="form-control deduction" value="{{old('provident_fund',$data->provident_fund)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Loan</label>
                                        <input type="number" name="loan_deduction" id="loan_deduction" class="form-control deduction" value="{{old('loan_deduction',$data->loan_deduction)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Advance</label>
                                        <input type="number" name="advance_deduction" id="advance_deduction" class="form-control deduction" value="{{old('advance_deduction',$data->advance_deduction)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Attendance Deduction</label>
                                        <input type="number" name="attendance_deduction" id="attendance_deduction" class="form-control deduction" value="{{old('attendance_deduction',$data->attendance_deduction)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Other Deduction</label>
                                        <input type="number" name="other_deduction" id="other_deduction" class="form-control deduction" value="{{old('other_deduction',$data->other_deduction)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label><b>Total Deduction</b></label>
                                        <input type="number" id="total_deduction" name="total_deduction" class="form-control" readonly value="{{$data->total_deduction}}">
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="card mb-3">

                            <div class="card-header bg-success text-white">
                                <i class="fas fa-gift"></i>
                                Bonus & Addition
                            </div>

                            <div class="card-body">

                                <div class="row g-3">

                                    <div class="col-md-3">
                                        <label>Festival Bonus</label>
                                        <input type="number" name="festival_bonus" id="festival_bonus" class="form-control addition" value="{{old('festival_bonus',$data->festival_bonus)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Performance Bonus</label>
                                        <input type="number" name="performance_bonus" id="performance_bonus" class="form-control addition" value="{{old('performance_bonus',$data->performance_bonus)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Commission</label>
                                        <input type="number" name="commission" id="commission" class="form-control addition" value="{{old('commission',$data->commission)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label>Other Addition</label>
                                        <input type="number" name="other_addition" id="other_addition" class="form-control addition" value="{{old('other_addition',$data->other_addition)}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label><b>Total Addition</b></label>
                                        <input type="number" id="total_addition" name="total_addition" class="form-control" readonly value="{{$data->total_addition}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label><b>Net Salary</b></label>
                                        <input type="number" id="net_salary" name="net_salary" class="form-control bg-success fw-bold text-light" readonly value="{{$data->net_salary}}">
                                    </div>

                                </div>

                            </div>

                        </div>

                            <!-- Payment -->

                            <div class="col-lg-3">
                                <label><b>Payment Date</b></label>
                                <input type="date" name="payment_date" class="form-control"  value="{{old('payment_date',$data->payment_date)}}">
                            </div>

                            <div class="col-lg-3">
                                <label><b>Payment Method</b></label>
                                <select name="payment_method" class="form-control">
                                     <option value="Cash" {{ $data->payment_type=='Cash'?'selected':'' }}>Cash</option>
                                      <option value="Bank" {{ $data->payment_type=='Bank'?'selected':'' }}>Bank</option>
                                       <option value="Bkash" {{ $data->payment_type=='Bkash'?'selected':'' }}>Bkash</option>
                                     <option value="Rocket" {{ $data->payment_type=='Rocket'?'selected':'' }}>Rocket</option>
                                    <option value="Nogod" {{ $data->payment_type=='Nogod'?'selected':'' }}>Nogod</option>
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <label><b>Bank Name</b></label>
                                <input type="text" name="bank_name" class="form-control" value="{{ old('ac_branch',$data->ac_branch) }}">
                            </div>

                            <div class="col-lg-3">
                                <label><b>Account No</b></label>
                                <input type="text" name="account_no" class="form-control" value="{{ old('ac_no',$data->ac_no) }}">
                            </div>

                            <div class="col-lg-3">
                                <label><b>Transaction No</b></label>
                                <input type="text" name="transaction_no" class="form-control" value="{{ old('transaction_no',$data->transaction_no) }}">
                            </div>

                            <div class="col-lg-3">
                                <label><b>Payment Status</b></label>
                                <select name="payment_status" class="form-control">
                                <option value="Pending" {{ $data->payment_status=='Pending'?'selected':'' }}>Pending</option>
                                <option value="Paid" {{ $data->payment_status=='Paid'?'selected':'' }}>Paid</option>
                                <option value="Cancelled" {{ $data->payment_status=='Cancelled'?'selected':'' }}>Cancelled</option>
                            </select>
                            </div>

                            <div class="col-lg-6">
                                <label><b>Remarks</b></label>
                                <textarea name="remarks" class="form-control">{{ old('remarks',$data->remarks) }}</textarea>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-success">
                                    <i class="fas fa-save"></i> Save Payroll
                                </button>

                                <a href="{{ route('admin.payroll.index') }}" class="btn btn-secondary">
                                    Back
                                </a>
                            </div>

                        </div>
                    </form>

               






            </div>

        </div>

    </div>

</div>

@endsection

@push('js')


<script>
function calc(){

    let gross =
        (+$('#basic_salary').val()||0)+
        (+$('#house_rent').val()||0)+
        (+$('#medical_allowance').val()||0)+
        (+$('#conveyance_allowance').val()||0)+
        (+$('#food_allowance').val()||0)+
        (+$('#mobile_allowance').val()||0)+
        (+$('#other_allowance').val()||0)+
        (+$('#overtime_amount').val()||0);

    $('#gross_salary').val(gross.toFixed(2));

    let deduction =
        (+$('#late_deduction').val()||0)+
        (+$('#tax').val()||0)+
        (+$('#provident_fund').val()||0)+
        (+$('#loan_deduction').val()||0)+
        (+$('#advance_deduction').val()||0)+
        (+$('#attendance_deduction').val()||0)+
        (+$('#other_deduction').val()||0);

    $('#total_deduction').val(deduction.toFixed(2));

    let addition =
        (+$('#festival_bonus').val()||0)+
        (+$('#performance_bonus').val()||0)+
        (+$('#commission').val()||0)+
        (+$('#other_addition').val()||0);

    $('#total_addition').val(addition.toFixed(2));

    let net = gross + addition - deduction;

    $('#net_salary').val(net.toFixed(2));
}

$(document).on('keyup change','.salary,.deduction,.addition',calc);

calc();
</script>

@endpush