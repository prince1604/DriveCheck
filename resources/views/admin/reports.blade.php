@extends('layouts.app')

@section('title', 'Reports & Analytics')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Administration /</span> Reports & Analytics
</h4>

<style>
    /* Fix Select2 Height & alignment to match Bootstrap form-control */
    .select2-container .select2-selection--single {
        height: 38.6px !important;
        border: 1px solid #d9dee3 !important;
        border-radius: 0.375rem !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #697a8d !important;
        padding-left: 0.875rem !important;
        line-height: normal !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
        right: 5px !important;
    }
</style>

<div class="row">
    <!-- Activity Heatmap -->
    <div class="col-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">7-Day Shift Activity </h5>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="heatmapOptions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heatmapOptions">
                        <!-- <a class="dropdown-item" href="javascript:void(0);" onclick="window.print()"><i class="bx bx-printer me-1"></i> Print Chart</a> -->
                        <a class="dropdown-item" href="{{ route('admin.vehicle-checks.index') }}"><i class="bx bx-table me-1"></i> View Raw Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">This visualizes the intensity of vehicle checking operations broken down by Shift Type over the last 7 days. Darker colors represent higher volumes of checks.</p>
                <div id="activityHeatmap" class="w-100" style="min-height: 350px;"></div>
            </div>
        </div>
    </div>
    
    <!-- Custom Export Section -->
    <div class="col-12 mb-4">
        <div class="card h-100 shadow-sm border-0 border-start border-primary border-5">
            <div class="card-header bg-white border-bottom pb-3">
                <h5 class="card-title fw-bold text-primary mb-0"><i class="bx bx-export me-2"></i> Custom Report Export</h5>
                <small class="text-muted">Generate dynamic PDF and CSV reports of vehicle check records.</small>
            </div>
            <div class="card-body pt-4">
                <form id="exportForm" action="{{ route('admin.reports.export') }}" method="GET">
                    <div class="bg-lighter rounded p-4 mb-3 border">
                        <div class="row g-3">
                            <div class="col-md-12 mb-2">
                                <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Report Title</label>
                                <input type="text" class="form-control bg-white" name="report_title" placeholder="e.g. Weekly Vehicle Checking Report - Botad Station" value="Vehicle Checking Custom Report" required>
                                <small class="text-muted d-block mt-1">This title will appear dynamically at the top of the exported file.</small>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Start Date</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control flatpickr-date-input bg-white" name="start_date" placeholder="YYYY-MM-DD">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">End Date</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control flatpickr-date-input bg-white" name="end_date" placeholder="YYYY-MM-DD">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Shift Type</label>
                                <select class="form-select select2-report" name="shift_type" data-placeholder="All Shifts">
                                    <option value="">All Shifts</option>
                                    <option value="Morning">Morning Shift</option>
                                    <option value="Evening">Evening Shift</option>
                                    <option value="Night">Night Shift</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Police Station</label>
                                <select class="form-select select2-report" name="police_station" data-placeholder="All Stations">
                                    <option value="">All Stations</option>
                                    @foreach($policeStations ?? [] as $station)
                                        <option value="{{ $station }}">{{ $station }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <button type="submit" name="export_format" value="csv" class="btn btn-outline-success fw-bold me-2 px-4">
                            <i class="bx bx-file me-1"></i> Export CSV
                        </button>
                        <button type="submit" name="export_format" value="pdf" class="btn btn-primary fw-bold px-4">
                            <i class="bx bxs-file-pdf me-1"></i> Export PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const heatmapData = {!! json_encode($heatmapData) !!};

        const options = {
            series: heatmapData,
            chart: {
                height: 350,
                type: 'heatmap',
                fontFamily: 'Public Sans, sans-serif',
                toolbar: { show: false }
            },
            dataLabels: {
                enabled: true,
                style: {
                    colors: ['#fff']
                }
            },
            colors: ['#696cff'], // Sneat Primary
            xaxis: {
                labels: { style: { colors: '#a1acb8', fontSize: '13px' } }
            },
            yaxis: {
                labels: { style: { colors: '#a1acb8', fontSize: '13px', fontWeight: 600 } }
            },
            title: {
                text: 'Vehicle Checks Distribution',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#566a7f'
                }
            },
            plotOptions: {
                heatmap: {
                    shadeIntensity: 0.5,
                    radius: 4,
                    useFillColorAsStroke: false,
                    colorScale: {
                        ranges: [{
                                from: 0,
                                to: 10,
                                name: 'Low',
                                color: '#e7e7ff'
                            },
                            {
                                from: 11,
                                to: 50,
                                name: 'Medium',
                                color: '#a3a4ff'
                            },
                            {
                                from: 51,
                                to: 1000,
                                name: 'High',
                                color: '#696cff'
                            }
                        ]
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#activityHeatmap"), options);
        chart.render();

        // Initialize Select2
        $('.select2-report').select2({
            width: '100%',
            allowClear: true,
            placeholder: function() {
                $(this).data('placeholder');
            }
        });

        // Initialize Flatpickr
        flatpickr('.flatpickr-date-input', {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        // Handle Form Submission for Pre-flight Check
        let clickedFormat = 'pdf'; // Default
        
        $('#exportForm button[type="submit"]').on('click', function() {
            clickedFormat = $(this).val();
        });

        $('#exportForm').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const formData = form.serialize();
            
            $.ajax({
                url: "{{ route('admin.reports.check-export') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    if (response.count > 0) {
                        // Records exist, proceed with download
                        const actionUrl = form.attr('action') + '?' + formData + '&export_format=' + clickedFormat;
                        window.open(actionUrl, '_blank');
                    } else {
                        // No records, show alert without refreshing
                        Swal.fire({
                            icon: 'error',
                            title: 'No Records Found',
                            text: 'No records found for the selected time period and criteria.',
                            confirmButtonText: 'OK',
                            customClass: { confirmButton: 'btn btn-primary' },
                            buttonsStyling: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while checking records.',
                        confirmButtonText: 'OK',
                        customClass: { confirmButton: 'btn btn-primary' },
                        buttonsStyling: false
                    });
                }
            });
        });
    });
</script>
@endpush
