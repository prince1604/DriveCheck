@extends('layouts.app')

@section('title', 'My Attendance')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Performance /</span> My Attendance
</h4>

<div class="row">
    <div class="col-lg-8 col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Attendance Overview (Current Month)</h5>
                <span class="badge bg-label-primary">July 2026</span>
            </div>
            <div class="card-body">
                <div class="row text-center mb-4 mt-3">
                    <div class="col-4 border-end">
                        <h3 class="text-primary fw-bold mb-0">{{ $presentDays }}</h3>
                        <span class="text-muted">Present Days</span>
                    </div>
                    <div class="col-4 border-end">
                        <h3 class="text-danger fw-bold mb-0">{{ $absentDays }}</h3>
                        <span class="text-muted">Absent Days</span>
                    </div>
                    <div class="col-4">
                        <h3 class="text-info fw-bold mb-0">{{ $totalWorkingDays }}</h3>
                        <span class="text-muted">Total Working Days</span>
                    </div>
                </div>
                
                <div class="alert alert-success d-flex" role="alert">
                    <span class="badge badge-center rounded-pill bg-success border-label-success p-3 me-2"><i class="bx bx-check fs-4"></i></span>
                    <div class="d-flex flex-column ps-1">
                        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Excellent Attendance!</h6>
                        <span>Your attendance record is currently at 91.6%. Keep up the good work.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-12 mb-4">
        <div class="card h-100 border-0 shadow-sm bg-primary text-white text-center">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="bx bx-qr-scan fs-1 mb-3"></i>
                <h4 class="text-white fw-bold">Digital Check-In</h4>
                <p class="mb-4">Use the mobile app to scan the station QR code for instant attendance logging.</p>
                <button class="btn btn-light text-primary fw-bold" onclick="Swal.fire('Scanning...', 'Camera module is required for QR check-in.', 'warning')">Open Scanner</button>
            </div>
        </div>
    </div>
</div>
@endsection
