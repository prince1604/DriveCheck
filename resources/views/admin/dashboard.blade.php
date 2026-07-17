@extends('layouts.app')

@section('content')
<style>
    /* Premium Dashboard Enhancements */
    .premium-hover {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .premium-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px -10px rgba(105, 108, 255, 0.4) !important;
        z-index: 2;
    }
    
    .avatar-initial {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .premium-hover:hover .avatar-initial {
        transform: scale(1.15) rotate(5deg);
    }
    
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(105, 108, 255, 0.08) !important;
    }

    .text-gradient-primary {
        background: linear-gradient(135deg, #696cff, #8592a3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<div class="row mb-4">
  <div class="col-12 col-lg-6 col-md-12 mb-4 mb-lg-0">
    <div class="card h-100 bg-label-primary border-0 shadow-sm premium-hover">
      <div class="d-flex align-items-end row h-100">
        <div class="col-sm-7 h-100 d-flex flex-column justify-content-center">
          <div class="card-body">
            <h5 class="card-title text-gradient-primary fw-bold" style="font-size: 1.4rem;">Welcome Admin! 🎉</h5>
            <p class="mb-4 text-primary">
              Here is what's happening in your system today. You have <span class="fw-bold">{{ $activeEmployees }}</span> active employees and <span class="fw-bold">{{ $todayChecks }}</span> vehicle checks today.
            </p>
            <a href="{{ route('admin.vehicle-checks.index') }}" class="btn btn-sm btn-primary shadow-sm">View All Checks</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-12 col-lg-3 col-md-6 mb-4 mb-lg-0">
    <div class="card h-100 bg-label-info border-0 shadow-sm premium-hover">
      <div class="card-body d-flex flex-column justify-content-center">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <span class="avatar-initial rounded bg-info text-white shadow-sm"><i class="bx bx-group"></i></span>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1 mt-3 text-info">Total Emp.</span>
        <h3 class="card-title mb-0 fw-bold text-info">{{ $employeeCount }}</h3>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-3 col-md-6 mb-4 mb-lg-0">
    <div class="card h-100 bg-label-success border-0 shadow-sm premium-hover">
      <div class="card-body d-flex flex-column justify-content-center">
        <div class="card-title d-flex align-items-start justify-content-between">
          <div class="avatar flex-shrink-0">
            <span class="avatar-initial rounded bg-success text-white shadow-sm"><i class="bx bx-map-pin"></i></span>
          </div>
        </div>
        <span class="fw-semibold d-block mb-1 mt-3 text-success">Total Pts.</span>
        <h3 class="card-title mb-0 fw-bold text-success">{{ $totalPoints }}</h3>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-12 col-lg-4 col-md-4 mb-4 order-2 d-flex flex-column">
        <div class="card flex-grow-1 mb-4 bg-label-warning border-0 shadow-sm premium-hover">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-warning text-white shadow-sm"><i class="bx bx-car"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1 mt-3 text-warning">Total Vehicle Checks</span>
                <h3 class="card-title mb-0 fw-bold text-warning">{{ $totalChecks }}</h3>
            </div>
        </div>
        <div class="card flex-grow-1 bg-label-danger border-0 shadow-sm premium-hover">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-danger text-white shadow-sm"><i class="bx bx-calendar-event"></i></span>
                    </div>
                </div>
                <span class="fw-semibold d-block mb-1 mt-3 text-danger">Today's Checks</span>
                <h3 class="card-title mb-0 fw-bold text-danger">{{ $todayChecks }}</h3>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="col-12 col-lg-8 col-md-8 mb-4 order-3">
        <div class="card h-100 bg-label-secondary border-0 shadow-sm premium-hover">
            <div class="card-header d-flex align-items-center justify-content-between pb-1">
                <h5 class="card-title m-0 me-2 fw-bold">Vehicle Checks (Last 7 Days)</h5>
            </div>
            <div class="card-body">
                <div id="checksChart"></div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Charts Row -->
<div class="row">
    <!-- Checks by Shift -->
    <div class="col-12 col-md-6 col-lg-4 mb-4 order-4">
        <div class="card h-100 bg-label-dark border-0 shadow-sm premium-hover">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2 fw-bold">Checks by Shift</h5>
                </div>
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <div id="shiftChart" class="w-100 mt-2"></div>
            </div>
        </div>
    </div>
    
    <!-- Checks by Checking Point -->
    <div class="col-12 col-md-6 col-lg-8 mb-4 order-5">
        <div class="card h-100 bg-label-info border-0 shadow-sm premium-hover">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2 fw-bold text-info">Top Checking Points</h5>
                </div>
            </div>
            <div class="card-body d-flex flex-column justify-content-center">
                <div id="pointChart" class="w-100 mt-2"></div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Checks Table -->
<div class="row">
    <div class="col-12 order-6">
        <div class="card shadow-sm border-0 mb-4 bg-label-primary premium-hover">
            <div class="card-header bg-transparent py-3" style="border-bottom: 1px solid rgba(105, 108, 255, 0.15);">
                <h5 class="mb-0 fw-bold text-primary">Recent Vehicle Checks</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-uppercase text-dark fw-bold small border-bottom-0">Person & Vehicle</th>
                                <th class="px-4 py-3 text-uppercase text-dark fw-bold small border-bottom-0">Checking Point</th>
                                <th class="px-4 py-3 text-uppercase text-dark fw-bold small border-bottom-0">Shift & Time</th>
                                <th class="px-4 py-3 text-uppercase text-dark fw-bold small border-bottom-0">Recorded By</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            @forelse($recentChecks as $check)
                            @php
                                $badgeColors = ['bg-label-primary', 'bg-label-success', 'bg-label-danger', 'bg-label-warning', 'bg-label-info', 'bg-label-dark'];
                                $badgeClass = $check->checkingPoint ? $badgeColors[$check->checkingPoint->id % count($badgeColors)] : 'bg-label-secondary';
                            @endphp
                            <tr>
                                <td class="px-4 py-3" style="border-bottom: 1px solid rgba(105, 108, 255, 0.1);">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bx bx-car"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $check->person_name }}</div>
                                            <div class="small text-muted fw-semibold">{{ $check->vehicle_no }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3" style="border-bottom: 1px solid rgba(105, 108, 255, 0.1);">
                                    <span class="badge {{ $badgeClass }} fw-bold shadow-sm">{{ $check->checkingPoint->name ?? 'N/A' }}</span>
                                </td>
                                <td class="px-4 py-3" style="border-bottom: 1px solid rgba(105, 108, 255, 0.1);">
                                    <div class="fw-bold text-dark">{{ $check->shift_date ? $check->shift_date->format('d M, Y') : 'N/A' }} ({{ $check->shift_type }})</div>
                                    <div class="small text-muted"><i class="bx bx-time-five me-1"></i>{{ $check->checking_time ? \Carbon\Carbon::parse($check->checking_time)->format('h:i A') : 'N/A' }}</div>
                                </td>
                                <td class="px-4 py-3" style="border-bottom: 1px solid rgba(105, 108, 255, 0.1);">
                                    <div class="fw-bold text-dark">{{ $check->user->name ?? 'Unknown' }}</div>
                                    <div class="small text-muted">{{ $check->employee_id_no }}</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted" style="border-bottom: 1px solid rgba(105, 108, 255, 0.1);">No recent vehicle checks found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent text-center py-3" style="border-top: 1px solid rgba(105, 108, 255, 0.15);">
                <a href="{{ route('admin.vehicle-checks.index') }}" class="btn btn-primary fw-bold shadow-sm">View All Records <i class="bx bx-right-arrow-alt ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data for Area Chart (Last 7 Days)
        const dates = {!! $dates->reverse()->values()->toJson() !!};
        const counts = {!! $checkCounts->reverse()->values()->toJson() !!};

        const chartOptions = {
            series: [{
                name: 'Vehicle Checks',
                data: counts
            }],
            chart: {
                height: 300,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Public Sans, sans-serif'
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            colors: ['#696cff'], // Sneat Primary Color
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: dates,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#a1acb8', fontSize: '13px' } }
            },
            yaxis: {
                labels: { style: { colors: '#a1acb8', fontSize: '13px' } }
            },
            grid: {
                borderColor: '#e2e8f0',
                strokeDashArray: 4,
                yaxis: { lines: { show: true } }
            },
            tooltip: {
                theme: 'light'
            }
        };

        const chart = new ApexCharts(document.querySelector("#checksChart"), chartOptions);
        chart.render();

        // Data for Shift Chart (Donut)
        const shiftData = {!! json_encode($shiftData) !!};
        const shiftOptions = {
            series: shiftData,
            labels: ['Morning Shift', 'Evening Shift', 'Night Shift'],
            chart: {
                type: 'donut',
                height: 320,
                fontFamily: 'Public Sans, sans-serif'
            },
            colors: ['#696cff', '#71dd37', '#ffab00'], // Primary, Success, Warning
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: { fontSize: '14px' },
                            value: { fontSize: '22px', fontWeight: 600, color: '#566a7f' },
                            total: {
                                show: true,
                                label: 'Total',
                                color: '#a1acb8'
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            legend: { show: true, position: 'bottom' },
            stroke: { show: false }
        };
        const shiftChart = new ApexCharts(document.querySelector("#shiftChart"), shiftOptions);
        shiftChart.render();

        // Data for Points Chart (Bar)
        const pointLabels = {!! $pointLabels->toJson() !!};
        const pointData = {!! $pointData->toJson() !!};
        const pointOptions = {
            series: [{
                name: 'Checks',
                data: pointData
            }],
            chart: {
                type: 'bar',
                height: 320,
                toolbar: { show: false },
                fontFamily: 'Public Sans, sans-serif',
                parentHeightOffset: 0
            },
            colors: ['#03c3ec'], // Info
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                    barHeight: '50%'
                }
            },
            dataLabels: { enabled: false },
            xaxis: {
                categories: pointLabels,
                labels: { style: { colors: '#a1acb8', fontSize: '13px' } }
            },
            yaxis: {
                labels: { style: { colors: '#a1acb8', fontSize: '13px' } }
            },
            grid: {
                borderColor: '#e2e8f0',
                strokeDashArray: 4,
            },
            tooltip: {
                theme: 'light'
            }
        };
        const pointChart = new ApexCharts(document.querySelector("#pointChart"), pointOptions);
        pointChart.render();
    });
</script>
@endpush
@endsection
