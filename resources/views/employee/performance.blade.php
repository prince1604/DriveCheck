@extends('layouts.app')

@section('title', 'Performance Review')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Performance /</span> Performance Review
</h4>

<div class="row">
    <!-- Weekly Goal Chart -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Weekly Goal Progress</h5>
                </div>
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <div id="goalChart" class="mt-2 w-100"></div>
                <div class="text-center mt-3">
                    <h6 class="mb-1">Target: {{ $weeklyTarget }} Checks / Week</h6>
                    <p class="text-muted mb-0">You have completed {{ $weeklyChecks }} checks this week.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity Timeline -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Activity Timeline (Last 5 Checks)</h5>
            </div>
            <div class="card-body">
                @if($timelineChecks->count() > 0)
                <ul class="timeline mb-0">
                    @foreach($timelineChecks as $check)
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-1">
                                <h6 class="mb-0 text-primary fw-bold">{{ $check->vehicle_no }}</h6>
                                <small class="text-muted">{{ $check->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-2">{{ $check->person_name }} was checked at <span class="fw-bold">{{ $check->checkingPoint->name ?? 'Unknown Point' }}</span>.</p>
                            <div class="d-flex flex-wrap">
                                <div class="avatar avatar-xs me-2">
                                    <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-time-five"></i></span>
                                </div>
                                <span>{{ $check->shift_type }} Shift</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <div class="text-center py-5">
                    <p class="text-muted mb-0">No recent activity found to display on timeline.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const percentage = {{ $completionPercentage }};
        
        let color = '#71dd37'; // Success green
        if(percentage < 50) color = '#ff3e1d'; // Danger red
        else if(percentage < 80) color = '#ffab00'; // Warning orange

        const options = {
            series: [percentage],
            chart: {
                height: 350,
                type: 'radialBar',
                fontFamily: 'Public Sans, sans-serif'
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    },
                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            color: '#566a7f',
                            fontSize: '17px',
                        },
                        value: {
                            color: '#566a7f',
                            fontSize: '36px',
                            fontWeight: 600,
                            show: true,
                            formatter: function (val) {
                                return val + "%"
                            }
                        }
                    }
                }
            },
            fill: {
                colors: [color]
            },
            stroke: {
                lineCap: 'round'
            },
            labels: ['Goal Reached'],
        };

        const chart = new ApexCharts(document.querySelector("#goalChart"), options);
        chart.render();
    });
</script>
<style>
/* Basic Timeline CSS to simulate Sneat's timeline */
.timeline {
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
}
.timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 10px;
    bottom: 0;
    width: 2px;
    background: #e2e8f0;
}
.timeline-item {
    position: relative;
    padding-left: 2.5rem;
    padding-bottom: 1.5rem;
}
.timeline-item:last-child {
    padding-bottom: 0;
}
.timeline-point {
    position: absolute;
    left: 4px;
    top: 5px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #696cff;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e7e7ff;
}
.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
@endpush
