@extends('layouts.admin.print_app')
@section('content')
    <table class="table table-bordered table-condensed table-striped align-middle">
        <thead class="text-nowrap">
            <tr>
                <th class="text-center" width="40px">Sl#</th>
                <th>Group Name</th>
                <th>Members</th>
                <th class="text-center">Month-Year</th>
                <th class="text-right">Target</th>
                <th class="text-right">Achievement</th>
                <th class="text-right">Difference</th>
                <th class="text-center">Achieve</th>
            </tr>
        </thead>
        <tbody>
            @php
                use App\Services\TargetAchievement\TargetAchievement;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>
                        @foreach ($row->members as $key => $member)
                            {{ $key > 0 ? ', ' : '' }}
                            {{ $member->staff->name }}
                        @endforeach
                    </td>
                    @php
                        $staff_id = $row->members->pluck('staff_id');
                        $target = @$row->targets
                            ->where('month', $month)
                            ->where('year', $year)
                            ->first()->total_target_amount;
                        $achievement = TargetAchievement::achievement($month, $year, $staff_id);
                    @endphp
                    <td class="text-center">{{ date('F', strtotime($month)) . ' - ' . $year }}</td>
                    <td class="text-right">{{ number_format($target, 2, '.', ',') }}</td>
                    <td class="text-right">{{ number_format($achievement, 2, '.', ',') }}</td>
                    <td class="text-right">{{ number_format($target - $achievement, 2, '.', ',') }}</td>
                    <td class="text-center">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                style="width:{{ round(($achievement * 100) / $target) }}%; height:5px;"
                                aria-valuenow="{{ round(($achievement * 100) / $target) }}" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <span
                            class="progress-parcent">{{ number_format(($achievement * 100) / $target, 2, '.', ',') }}%</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding-top: 10px;">Print Date & Time : {{ date('d-m-Y h:i:s A') }}</div>
@endsection
