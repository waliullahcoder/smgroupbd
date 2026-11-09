@extends('layouts.admin.app')

@section('content')

<div class="row g-3">
    <div class="col-12">

        <form action="{{ route('admin.holiday.store') }}" method="POST">
            @csrf

            <div class="card">

                <div class="card-header py-2">

                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0 text-uppercase">
                            New Holiday
                        </h6>

                        <div>

                            <a href="{{ route('admin.holiday.index') }}"
                                class="btn btn-primary btn-sm">
                                Go Back
                            </a>

                            <button class="btn btn-primary btn-sm">
                                Save
                            </button>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-3">
                            <label><b>Holiday Name</b></label>
                            <input type="text"
                                   name="holiday_name"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-3">
                            <label><b>Holiday Type</b></label>

                            <select name="holiday_type"
                                    class="form-select"
                                    required>

                                <option value="Public Holiday">Public Holiday</option>
                                <option value="Government Holiday">Government Holiday</option>
                                <option value="Festival Holiday">Festival Holiday</option>
                                <option value="Company Holiday">Company Holiday</option>
                                <option value="Optional Holiday">Optional Holiday</option>
                                <option value="Weekend">Weekend</option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label><b>Branch</b></label>

                            <select name="branch_id"
                                    class="form-select">

                                <option value="">All Branch</option>

                                @foreach($branches as $branch)

                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>
                         <div class="col-md-3">

                            <label><b>Status</b></label>

                            <select name="status"
                                    class="form-select">

                                <option value="1" selected>
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="col-md-3">

                            <label><b>From Date</b></label>

                            <input type="date"
                                   id="from_date"
                                   name="from_date"
                                   value="{{ date('Y-m-d') }}"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-3">

                            <label><b>To Date</b></label>

                            <input type="date"
                                   id="to_date"
                                   name="to_date"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-3">

                            <label><b>Total Days</b></label>

                            <input type="number"
                                   id="total_days"
                                   name="total_days"
                                   class="form-control"
                                   step="0.5"
                                   readonly>

                        </div>

                        <div class="col-md-3">

                            <label><b>Repeat Every Year</b></label>

                            <select name="repeat_yearly"
                                    class="form-select">

                                <option value="1">
                                    Yes
                                </option>

                                <option value="0" selected>
                                    No
                                </option>

                            </select>

                        </div>

                       

                        <div class="col-md-12">

                            <label><b>Description</b></label>

                            <textarea class="form-control"
                                      rows="4"
                                      name="description"></textarea>

                        </div>

                    </div>

                </div>

                <div class="card-footer text-end">

                    <button class="btn btn-primary btn-sm">
                        Save
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection

@push('js')

<script>

$(document).ready(function(){

    calculateDays();

    $('#from_date,#to_date').on('change',function(){

        calculateDays();

    });

    function calculateDays(){

        let from = $('#from_date').val();
        let to   = $('#to_date').val();

        if(from != '' && to != ''){

            let start = new Date(from);
            let end   = new Date(to);

            let diff = Math.floor((end-start)/(1000*60*60*24))+1;

            if(diff<0){

                diff=0;

            }

            $('#total_days').val(diff);

        }else{

            $('#total_days').val('');

        }

    }

});

</script>

@endpush