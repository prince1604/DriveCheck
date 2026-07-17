@extends('layouts.app')

@section('title', 'Coming Soon')

@section('content')
<div class="container-xxl container-p-y text-center d-flex flex-column justify-content-center align-items-center h-100" style="min-height: 70vh;">
    <div class="misc-wrapper">
        <h2 class="mb-2 mx-2 fw-bold text-primary">Module Under Construction! 🚧</h2>
        <p class="mb-4 mx-2 text-muted">We're working hard on bringing this feature to you. It will be available in the next system update.</p>
        
        <div class="mt-4 mb-5">
            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" 
                 alt="under-maintenance" 
                 width="400" 
                 class="img-fluid" 
                 data-app-dark-img="illustrations/page-misc-under-maintenance-dark.png" 
                 data-app-light-img="illustrations/page-misc-under-maintenance.png">
        </div>
        
        <a href="{{ auth()->user()->user_type_id == 1 ? route('admin.dashboard') : route('employee.dashboard') }}" class="btn btn-primary fw-bold">
            <i class="bx bx-left-arrow-alt me-1"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection
