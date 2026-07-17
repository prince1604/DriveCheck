@extends('layouts.app')

@section('title', 'Duty Roster')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Administration /</span> Duty Roster
</h4>

<div class="card shadow-sm border-0 mb-4 premium-hover">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">Employee Shift Assignments</h5>
        <div>
            <button class="btn btn-success btn-sm fw-bold shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                <i class="bx bx-plus me-1"></i> Add Assignment
            </button>
            <!-- <button class="btn btn-primary btn-sm fw-bold shadow-sm" onclick="Swal.fire('Info', 'Auto-scheduling algorithm is coming in Phase 2.', 'info')">
                <i class="bx bx-calendar-star me-1"></i> Auto-Schedule
            </button> -->
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Employee</th>
                    <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Current Shift</th>
                    <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Duty Time</th>
                    <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Assigned Point</th>
                    <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Status</th>
                    <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($employees as $emp)
                <tr>
                    <td>
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="avatar avatar-sm me-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">{{ substr($emp->name, 0, 2) }}</span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fw-semibold">{{ $emp->roster_name ?? $emp->name }}</span>
                                <small class="text-muted">{{ $emp->employee_id }} {!! $emp->roster_name ? '<span class="text-primary">(Roster Name)</span>' : '' !!}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($emp->current_shift == 'Unassigned')
                            <span class="badge bg-label-secondary">Unassigned</span>
                        @elseif(str_contains($emp->current_shift, 'Morning'))
                            <span class="badge bg-label-info text-uppercase"><i class='bx bx-sun me-1'></i> {{ $emp->current_shift }}</span>
                        @elseif(str_contains($emp->current_shift, 'Evening'))
                            <span class="badge bg-label-warning text-uppercase"><i class='bx bx-time-five me-1'></i> {{ $emp->current_shift }}</span>
                        @else
                            <span class="badge bg-label-dark text-uppercase"><i class='bx bx-moon me-1'></i> {{ $emp->current_shift }}</span>
                        @endif
                    </td>
                    <td>
                        @if($emp->duty_start_time && $emp->duty_end_time)
                            <span class="fw-semibold text-primary"><i class="bx bx-time me-1"></i> {{ \Carbon\Carbon::parse($emp->duty_start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($emp->duty_end_time)->format('h:i A') }}</span>
                        @else
                            <span class="text-muted">Not Set</span>
                        @endif
                    </td>
                    <td>
                        @if($emp->assigned_point == 'None')
                            <span class="text-muted">Not Assigned</span>
                        @else
                            <i class="bx bx-map-pin text-danger me-1"></i> {{ $emp->assigned_point }}
                        @endif
                    </td>
                    <td><span class="badge bg-{{ $emp->status_color }} text-uppercase">{{ $emp->duty_status }}</span></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-icon btn-outline-secondary" title="Change Shift" data-bs-toggle="modal" data-bs-target="#assignShiftModal" onclick="populateModal('{{ $emp->id }}', '{{ addslashes($emp->name) }}', '{{ $emp->duty_start_time ? \Carbon\Carbon::parse($emp->duty_start_time)->format('H:i') : '' }}', '{{ $emp->duty_end_time ? \Carbon\Carbon::parse($emp->duty_end_time)->format('H:i') : '' }}', '{{ $emp->current_shift == 'Unassigned' ? '' : $emp->current_shift }}', '{{ $emp->assigned_checking_point_id ?? '' }}', '{{ addslashes($emp->roster_name ?? '') }}')">
                            <i class="bx bx-edit-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                
                @if($employees->isEmpty())
                <tr>
                    <td colspan="5" class="text-center py-4">No active employees found to assign.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Assign Shift Modal -->
<div class="modal fade" id="assignShiftModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignShiftModalTitle">Assign Duty Shift</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assignShiftForm">
                <div class="modal-body">
                    <p class="mb-4">Assigning shift for <strong id="modalEmpName" class="text-primary"></strong>.</p>
                    <input type="hidden" id="modalEmpId" name="employee_id">
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="rosterName" class="form-label">Roster Display Name (Optional)</label>
                            <input type="text" id="rosterName" class="form-control" placeholder="Enter name to show in Duty Roster">
                            <small class="text-muted">Leave blank to use the original employee name.</small>
                        </div>
                    </div>
                    
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
                            <label for="shiftType" class="form-label">Shift Type (Auto-selected)</label>
                            <select id="shiftType" class="form-select" required>
                                <option value="" disabled selected>Select Shift</option>
                                <option value="Morning">Morning Shift</option>
                                <option value="Evening">Evening Shift</option>
                                <option value="Night">Night Shift</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label for="checkingPoint" class="form-label">Checking Point</label>
                            <select id="checkingPoint" class="form-select" required>
                                <option value="" disabled selected>Select Point</option>
                                @foreach($checkingPoints as $point)
                                    <option value="{{ $point->id }}">{{ $point->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Assignment Modal -->
<div class="modal fade" id="addAssignmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAssignmentModalTitle">Add Duty Shift Assignment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAssignmentForm">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="addEmployeeId" class="form-label">Select Employee</label>
                            <select id="addEmployeeId" class="form-select" required>
                                <option value="" disabled selected>Select Employee</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }} ({{ $emp->employee_id }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="addRosterName" class="form-label">Roster Display Name (Optional)</label>
                            <input type="text" id="addRosterName" class="form-control" placeholder="Enter name to show in Duty Roster">
                            <small class="text-muted">Leave blank to use the original employee name.</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="addDutyStartTime" class="form-label">Start Time</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="addDutyStartTime" class="form-control flatpickr-time-input bg-white" placeholder="HH:MM" required>
                                <span class="input-group-text"><i class="bx bx-time"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="addDutyEndTime" class="form-label">End Time</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="addDutyEndTime" class="form-control flatpickr-time-input bg-white" placeholder="HH:MM" required>
                                <span class="input-group-text"><i class="bx bx-time"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="addShiftType" class="form-label">Shift Type (Auto-selected)</label>
                            <select id="addShiftType" class="form-select" required>
                                <option value="" disabled selected>Select Shift</option>
                                <option value="Morning">Morning Shift</option>
                                <option value="Evening">Evening Shift</option>
                                <option value="Night">Night Shift</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label for="addCheckingPoint" class="form-label">Checking Point</label>
                            <select id="addCheckingPoint" class="form-select" required>
                                <option value="" disabled selected>Select Point</option>
                                @foreach($checkingPoints as $point)
                                    <option value="{{ $point->id }}">{{ $point->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Assignment</button>
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
            allowInput: true
        });
    });

    function populateModal(id, name, dutyStartTime, dutyEndTime, shiftType, pointId, rosterName = '') {
        document.getElementById('modalEmpId').value = id;
        document.getElementById('modalEmpName').innerText = name;
        document.getElementById('rosterName').value = rosterName;
        document.getElementById('dutyStartTime').value = dutyStartTime;
        document.getElementById('dutyEndTime').value = dutyEndTime;
        document.getElementById('shiftType').value = shiftType;
        if(pointId) {
            document.getElementById('checkingPoint').value = pointId;
        } else {
            document.getElementById('checkingPoint').value = "";
        }
    }

    document.getElementById('dutyStartTime').addEventListener('change', function() {
        const timeValue = this.value; // Format: "HH:mm" (24-hour)
        if (!timeValue) {
            document.getElementById('shiftType').value = "";
            return;
        }
        
        const hour = parseInt(timeValue.split(':')[0], 10);
        
        let shift = "";
        if (hour >= 8 && hour < 16) {
            shift = "Morning";
        } else if (hour >= 16 && hour < 24) {
            shift = "Evening";
        } else {
            shift = "Night";
        }
        
        document.getElementById('shiftType').value = shift;
    });

    document.getElementById('assignShiftForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const empId = document.getElementById('modalEmpId').value;
        const dutyStartTime = document.getElementById('dutyStartTime').value;
        const dutyEndTime = document.getElementById('dutyEndTime').value;
        const shiftType = document.getElementById('shiftType').value;
        const checkingPoint = document.getElementById('checkingPoint').value;
        const rosterName = document.getElementById('rosterName').value;
        
        if(!dutyStartTime || !dutyEndTime || !shiftType || !checkingPoint) return;
        
        fetch('{{ route('admin.duty-roster.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                employee_id: empId,
                duty_start_time: dutyStartTime,
                duty_end_time: dutyEndTime,
                assigned_shift: shiftType,
                assigned_checking_point_id: checkingPoint,
                roster_name: rosterName
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                Swal.fire({
                    title: 'Success', 
                    text: 'Shift assigned successfully!', 
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    });

    document.getElementById('addDutyStartTime').addEventListener('change', function() {
        const timeValue = this.value; // Format: "HH:mm" (24-hour)
        if (!timeValue) {
            document.getElementById('addShiftType').value = "";
            return;
        }
        
        const hour = parseInt(timeValue.split(':')[0], 10);
        
        let shift = "";
        if (hour >= 8 && hour < 16) {
            shift = "Morning";
        } else if (hour >= 16 && hour < 24) {
            shift = "Evening";
        } else {
            shift = "Night";
        }
        
        document.getElementById('addShiftType').value = shift;
    });

    document.getElementById('addAssignmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const empId = document.getElementById('addEmployeeId').value;
        const dutyStartTime = document.getElementById('addDutyStartTime').value;
        const dutyEndTime = document.getElementById('addDutyEndTime').value;
        const shiftType = document.getElementById('addShiftType').value;
        const checkingPoint = document.getElementById('addCheckingPoint').value;
        const rosterName = document.getElementById('addRosterName').value;
        
        if(!empId || !dutyStartTime || !dutyEndTime || !shiftType || !checkingPoint) return;
        
        fetch('{{ route('admin.duty-roster.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                employee_id: empId,
                duty_start_time: dutyStartTime,
                duty_end_time: dutyEndTime,
                assigned_shift: shiftType,
                assigned_checking_point_id: checkingPoint,
                roster_name: rosterName
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                Swal.fire({
                    title: 'Success', 
                    text: 'Shift assignment added successfully!', 
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    });
</script>
@endpush
