@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-edit text-warning"></i>
            Edit Expense
        </h5>

        <a href="{{ route('admin.expense.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.expense.update',$expense->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Expense Head <span class="text-danger">*</span>
                    </label>

                    <select name="expense_head_id" class="form-select select" required>

                        <option value="">Select Expense Head</option>

                        @foreach($coas as $coa)

                            <option value="{{ $coa->id }}"
                                {{ $expense->expense_head_id == $coa->id ? 'selected' : '' }}>

                                {{ $coa->id }} - {{ $coa->head_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Expense Month <span class="text-danger">*</span>
                    </label>

                    <select name="expense_month" class="form-select" required>

                        @for($i=1;$i<=12;$i++)

                            <option value="{{ $i }}"
                                {{ $expense->expense_month == $i ? 'selected' : '' }}>

                                {{ date('F', mktime(0,0,0,$i,1)) }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label><b>Expense Year</b></label>

                    <select name="expense_year" class="form-control">

                        @for($i=date('Y')-2;$i<=date('Y')+2;$i++)

                            <option value="{{ $i }}"
                                {{ $expense->expense_year == $i ? 'selected' : '' }}>

                                {{ $i }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Expense Amount <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="expense_amount"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ $expense->expense_amount }}"
                           required>

                </div>
                

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Expense Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                           name="expense_date"
                           class="form-control"
                           value="{{ $expense->expense_date }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Pending"
                            {{ $expense->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="Approved"
                            {{ $expense->status=='Approved'?'selected':'' }}>
                            Approved
                        </option>

                        <option value="Paid"
                            {{ $expense->status=='Paid'?'selected':'' }}>
                            Paid
                        </option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">Remarks</label>

                    <textarea name="remarks"
                              rows="1"
                              class="form-control">{{ $expense->remarks }}</textarea>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-warning">

                <i class="fas fa-save"></i> Update

            </button>

        </div>

    </form>

</div>

@endsection