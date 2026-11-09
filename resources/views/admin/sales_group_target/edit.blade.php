@extends('layouts.admin.edit_app')

@section('content')
    <div class="row g-3">
        @if (Auth::user()->hasRole('Software Admin'))
            <div class="col-lg-3 col-sm-6">
                <label for="company_id" class="form-label"><b>Company Name <span class="text-danger">*</span></b></label>
                <select name="company_id" id="company_id" class="select form-select" data-placeholder="Select Company" required>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $data->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="{{ Auth::user()->hasRole('Software Admin') ? 'col-lg-3' : 'col-lg-4' }} col-sm-6">
            <label for="name" class="form-label"><b>Group Name <span class="text-danger">*</span></b></label>
            <select name="group_id" id="group_id" class="select form-select" data-placeholder="Select Group" required>
                <option value=""></option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ $data->group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="{{ Auth::user()->hasRole('Software Admin') ? 'col-lg-3' : 'col-lg-4' }} col-sm-6">
            <label for="month" class="form-label"><b>Month <span class="text-danger">*</span></b></label>
            <select name="month" id="month" class="select form-select" data-placeholder="Select Month.." required>
                @php
                    $months = [
                        '1' => 'January',
                        '2' => 'February',
                        '3' => 'March',
                        '4' => 'April',
                        '5' => 'May',
                        '6' => 'June',
                        '7' => 'July',
                        '8' => 'August',
                        '9' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December',
                    ];
                @endphp
                @foreach ($months as $key => $value)
                    <option value="{{ $key }}" {{ $key == $data->month ? 'selected' : '' }}>{{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="{{ Auth::user()->hasRole('Software Admin') ? 'col-lg-3' : 'col-lg-4' }} col-sm-6">
            <label for="year" class="form-label"><b>Year <span class="text-danger">*</span></b></label>
            <select name="year" id="year" class="select form-select" data-placeholder="Select Year.." required>
                @for ($i = date('Y'); $i <= 2030; $i++)
                    <option value="{{ $i }}" {{ $i == $data->year ? 'selected' : '' }}>{{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-12">
            <div class="row g-3 justify-content-end">
                <div class="col-md-3">
                    <label class="form-check-label me-2">Target Type</label>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input target_type" name="target_type" value="both"
                                {{ $data->target_type == 'both' ? 'checked' : '' }}><span class="ms-1">Both</span>
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input target_type" name="target_type" value="amount"
                                {{ $data->target_type == 'amount' ? 'checked' : '' }}><span class="ms-1">Amount</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <table class="table table-bordered align-middle target-table" id="targetByQty">
                <thead class="bg-primary text-white">
                    <th>Category</th>
                    <th class="target_qty" style="display: {{ $data->target_type == 'both' ? 'block' : 'none' }};">Target
                        Quantity</th>
                    <th>Target Amount</th>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        @php
                            $i++;
                            $target = 0;
                            $target_amount = 0;
                            foreach ($data->target_categories as $target_category) {
                                if ($category->id == $target_category->category_id) {
                                    $target = $target_category->target;
                                    $target_amount = $target_category->target_amount;
                                }
                            }
                        @endphp
                        <tr>
                            <td>
                                <input type="hidden" name="category_id[]" value="{{ $category->id }}">
                                <input type="text" class="form-control" value="{{ $category->name }}" readonly>
                            </td>
                            <td class="target_qty" style="display: {{ $data->target_type == 'both' ? 'block' : 'none' }};">
                                <input type="number" class="form-control target" name="target[]"
                                    value="{{ $target }}" oninput="countTarget()">
                            </td>
                            <td>
                                <input type="number" class="form-control targetAmt" name="target_amount[]"
                                    value="{{ $target_amount }}" oninput="countTargetAmount()">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td id="total-target"><span class="px-2">Total Target</span></td>
                        <td class="target_qty" style="display: {{ $data->target_type == 'both' ? 'block' : 'none' }};">
                            <input type="number" class="form-control" id="totalTarget" name="total_target"
                                value="{{ $data->total_target }}" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control" id="totalTargetAmt" name="total_target_amount"
                                value="{{ $data->total_target_amount }}" readonly>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        function countTarget() {
            var totalTarget = 0;
            $(".target").each(function() {
                var target = parseInt($(this).val());
                totalTarget += isNaN(target) ? 0 : target;
            });
            $('#totalTarget').val(totalTarget);
        }

        function countTargetAmount() {
            var totalTarget = 0;
            $(".targetAmt").each(function() {
                var target = parseInt($(this).val());
                totalTarget += isNaN(target) ? 0 : target;
            });

            $('#totalTargetAmt').val(totalTarget);
        }

        $(document).ready(function() {
            $(document).on('click', '.target_type', function(event) {
                var target_type = $("input[name='target_type']:checked").val();
                if (target_type == 'both') {
                    $('.target_qty').show();
                } else {
                    $('.target_qty').hide();
                }
            });
        });
    </script>
@endpush
