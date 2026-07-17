@extends('layouts.app')

@section('title', 'My Duty Roster')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Performance /</span> My Duty Roster
</h4>

<div class="row">
    <!-- Header Card -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center flex-column flex-sm-row p-4">
                <div class="text-center text-sm-start mb-3 mb-sm-0 d-flex align-items-center">
                    <div class="avatar avatar-md me-3 d-none d-sm-flex align-items-center justify-content-center bg-label-primary rounded">
                        <i class="bx bx-briefcase fs-4"></i>
                    </div>
                    <div>
                        <h4 class="card-title text-primary mb-1 fw-bold">My Duty Assignment</h4>
                        <p class="mb-0 text-muted"><strong class="text-dark">{{ auth()->user()->roster_name ?? auth()->user()->name }}</strong>, you are currently assigned to the <span class="fw-bold text-dark">{{ $currentShift }} Shift</span>.</p>
                    </div>
                </div>
                <div>
                    <span class="badge bg-label-primary rounded-pill px-4 py-2 fs-6 shadow-sm border border-primary border-opacity-10">
                        <i class="bx bx-pulse me-1"></i> Status: {{ $dutyStatus }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Shift Icon Card -->
    <div class="col-12 col-md-5 col-lg-4 mb-4">
        @php
            $textColor = 'text-primary';
            $iconBg = 'bg-label-primary';
            $icon = 'bx-time';
            
            if(str_contains($currentShift, 'Morning')) {
                $textColor = 'text-warning';
                $iconBg = 'bg-label-warning';
                $icon = 'bx-sun';
            } elseif(str_contains($currentShift, 'Evening')) {
                $textColor = 'text-primary';
                $iconBg = 'bg-label-primary';
                $icon = 'bx-time-five';
            } elseif(str_contains($currentShift, 'Night')) {
                $textColor = 'text-dark';
                $iconBg = 'bg-label-dark';
                $icon = 'bx-moon';
            }
        @endphp
        
        <div id="shiftCardContainer" class="card h-100 border-0 shadow-sm shift-card">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center p-5">
                
                <div class="avatar avatar-xl mb-4" style="width: 100px; height: 100px;">
                    <span id="shiftIconContainer" class="avatar-initial rounded-circle {{ $iconBg }} w-100 h-100">
                        <i id="shiftIcon" class="bx {{ $icon }}" style="font-size: 4rem;"></i>
                    </span>
                </div>
                
                <h4 id="shiftTitle" class="mb-3 fw-bold text-dark text-uppercase" style="letter-spacing: 1px;">
                    {{ $currentShift == 'Unassigned' ? 'Unassigned' : $currentShift . ' Shift' }}
                </h4>
                
                <div id="shiftTimePill" class="px-4 py-2 rounded bg-lighter border border-light">
                    <h6 id="shiftTimeText" class="mb-0 fw-semibold {{ $textColor }} d-flex align-items-center" style="letter-spacing: 0.5px;">
                        <i class="bx bx-timer me-2 fs-4"></i>
                        @if(auth()->user()->duty_start_time && auth()->user()->duty_end_time)
                            {{ \Carbon\Carbon::parse(auth()->user()->duty_start_time)->format('h:i') }} <span class="fs-6 opacity-75 mx-1">{{ \Carbon\Carbon::parse(auth()->user()->duty_start_time)->format('A') }}</span> - {{ \Carbon\Carbon::parse(auth()->user()->duty_end_time)->format('h:i') }} <span class="fs-6 opacity-75 ms-1">{{ \Carbon\Carbon::parse(auth()->user()->duty_end_time)->format('A') }}</span>
                        @else
                            No Active Hours
                        @endif
                    </h6>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Deployment Details Card -->
    <div class="col-12 col-md-7 col-lg-8 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header border-bottom py-3 bg-transparent">
                <h5 class="mb-0 fw-bold"><i class="bx bx-map-alt me-2 text-primary fs-4 align-middle"></i> Deployment Details</h5>
            </div>
            <div class="card-body mt-3">
                <style>
                    .hover-shadow-sm:hover {
                        box-shadow: 0 0.125rem 0.25rem rgba(161, 172, 184, 0.4);
                        border-color: #696cff !important;
                    }
                    .transition-all { transition: all 0.2s ease-in-out; }
                </style>
                <div class="row g-4 mb-4">
                    <div class="col-12 col-md-6">
                        <div class="border rounded p-3 h-100 d-flex align-items-center transition-all hover-shadow-sm" style="background-color: #fcfdfd;">
                            <div class="avatar avatar-md me-3">
                                <span class="avatar-initial rounded-circle bg-label-danger"><i class="bx bx-map-pin fs-4"></i></span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-muted text-uppercase fw-semibold" style="font-size: 0.70rem; letter-spacing: 1px;">Assigned Checkpoint</h6>
                                <h5 class="mb-0 fw-bold mt-1 text-dark">{{ $assignedPoint }}</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="border rounded p-3 h-100 d-flex align-items-center transition-all hover-shadow-sm" style="background-color: #fcfdfd;">
                            <div class="avatar avatar-md me-3">
                                <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-user-pin fs-4"></i></span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-muted text-uppercase fw-semibold" style="font-size: 0.70rem; letter-spacing: 1px;">Reporting Officer</h6>
                                <h5 class="mb-0 fw-bold mt-1 text-dark">Station Admin</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-auto border d-flex flex-column flex-md-row justify-content-between align-items-md-center bg-lighter rounded p-3">
                    <div class="d-flex flex-column mb-3 mb-md-0">
                        <span class="fw-bold text-dark fs-6"><i class="bx bx-info-circle me-1 text-primary"></i> Update Duty Time?</span>
                        <small class="text-muted ms-md-4">Set your duty time and a shift will be assigned automatically.</small>
                    </div>
                    <button type="button" class="btn btn-primary px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#setDutyModal">
                        <i class="bx bx-time me-2"></i> Set Duty Time
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Set Duty Modal -->
<div class="modal fade" id="setDutyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setDutyModalTitle">Set Duty Time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="setDutyForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dutyStartTime" class="form-label">Start Time</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="dutyStartTime" class="form-control flatpickr-time-input bg-white" placeholder="HH:MM" required>
                                <span class="input-group-text"><i class="bx bx-time"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dutyEndTime" class="form-label">End Time</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="dutyEndTime" class="form-control flatpickr-time-input bg-white" placeholder="HH:MM" required>
                                <span class="input-group-text"><i class="bx bx-time"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="autoShift" class="form-label">Assigned Shift (Auto-selected)</label>
                            <select id="autoShift" class="form-select" disabled>
                                <option value="" disabled selected>Will be selected automatically</option>
                                <option value="Morning">Morning Shift</option>
                                <option value="Evening">Evening Shift</option>
                                <option value="Night">Night Shift</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Duty Time</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr('.flatpickr-time-input', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            allowInput: true,
            disableMobile: "true"
        });
    });

    document.getElementById('dutyStartTime').addEventListener('change', function() {
        const timeValue = this.value; // Format: "HH:mm" (24-hour)
        if (!timeValue) {
            document.getElementById('autoShift').value = "";
            return;
        }
        
        const hour = parseInt(timeValue.split(':')[0], 10);
        
        // Logic for shift calculation based on start time only
        let shift = "";
        if (hour >= 8 && hour < 16) {
            shift = "Morning";
        } else if (hour >= 16 && hour < 24) {
            shift = "Evening";
        } else {
            shift = "Night";
        }
        
        document.getElementById('autoShift').value = shift;
    });

    document.getElementById('setDutyForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const newShift = document.getElementById('autoShift').value;
        const dutyStartTime = document.getElementById('dutyStartTime').value;
        const dutyEndTime = document.getElementById('dutyEndTime').value;
        if(!newShift || !dutyStartTime || !dutyEndTime) return;
        
        // Post to backend
        fetch('{{ route('employee.duty-roster.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                duty_start_time: dutyStartTime,
                duty_end_time: dutyEndTime,
                assigned_shift: newShift
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Update DOM dynamically
                updateShiftCard(newShift, dutyStartTime, dutyEndTime);
                
                Swal.fire({
                    title: 'Success', 
                    text: 'Duty time and shift updated successfully!', 
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                
                bootstrap.Modal.getInstance(document.getElementById('setDutyModal')).hide();
            }
        });
    });
    
    function updateShiftCard(shiftName, startTime, endTime) {
        const cardContainer = document.getElementById('shiftCardContainer');
        const iconContainer = document.getElementById('shiftIconContainer');
        const icon = document.getElementById('shiftIcon');
        const title = document.getElementById('shiftTitle');
        const pill = document.getElementById('shiftTimePill');
        const timeText = document.getElementById('shiftTimeText');
        
        let textColor, iconBgClass, iconClass, timeHTML;
        
        if (shiftName.includes('Morning')) {
            textColor = 'text-warning';
            iconBgClass = 'bg-label-warning';
            iconClass = 'bx-sun';
        } else if (shiftName.includes('Evening')) {
            textColor = 'text-primary';
            iconBgClass = 'bg-label-primary';
            iconClass = 'bx-time-five';
        } else if (shiftName.includes('Night')) {
            textColor = 'text-dark';
            iconBgClass = 'bg-label-dark';
            iconClass = 'bx-moon';
        }
        
        // Helper for formatting time
        function formatAmPm(timeStr) {
            const [h, m] = timeStr.split(':');
            let hour = parseInt(h, 10);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12;
            hour = hour ? hour : 12; 
            return `${String(hour).padStart(2, '0')}:${m} <span class="fs-6 opacity-75 mx-1">${ampm}</span>`;
        }
        
        // Set Times
        if(startTime && endTime) {
            timeHTML = `${formatAmPm(startTime)} - ${formatAmPm(endTime)}`;
        } else {
            timeHTML = `No Active Hours`;
        }
        
        // Apply Changes
        iconContainer.className = `avatar-initial rounded-circle ${iconBgClass} w-100 h-100`;
        icon.className = `bx ${iconClass}`;
        
        title.className = `mb-3 fw-bold text-dark text-uppercase`;
        title.innerText = shiftName + ' Shift';
        
        timeText.className = `mb-0 fw-semibold ${textColor} d-flex align-items-center`;
        timeText.innerHTML = `<i class="bx bx-timer me-2 fs-4"></i> ${timeHTML}`;
        
        // Top status card update
        document.querySelector('.card-title.text-primary.mb-1.fw-bold').nextElementSibling.innerHTML = `You are currently assigned to the <span class="fw-bold text-dark">${shiftName} Shift</span>.`;
    }
</script>
@endpush
