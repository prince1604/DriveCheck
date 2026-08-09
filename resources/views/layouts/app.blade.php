<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, viewport-fit=cover" />
    
    <!-- PWA / Full Screen Mobile App Meta Tags -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#16161c">
    
    <title>
        @if(auth()->check())
            {{ auth()->user()->user_type_id == 1 ? 'Admin' : 'Employee' }} || 
            @if(Request::segment(2))
                {{ ucwords(str_replace('-', ' ', Request::segment(2))) }}
            @elseif(Request::segment(1))
                {{ ucwords(str_replace('-', ' ', Request::segment(1))) }}
            @else
                Dashboard
            @endif
        @else
            {{ config('app.name', 'DriveCheck') }}
        @endif
    </title>

    <link rel="icon" type="image/png" href="{{ asset('img/gujarat-police-seeklogo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    
    <style>
        .swal2-container {
            z-index: 9999 !important;
        }
        /* Custom Dark Mode is now handled by Obsidian CSS below */

        .premium-hover {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .premium-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -10px rgba(105, 108, 255, 0.4) !important;
            z-index: 2;
        }
        
        .avatar-initial {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .premium-hover:hover .avatar-initial {
            transform: scale(1.15) rotate(5deg);
        }
        
        /* Fix Avatar Image Clipping */
        .avatar {
            border-radius: 50% !important;
            background-color: transparent !important;
        }
        .avatar img {
            border-radius: 50% !important;
            background-color: transparent !important;
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

        /* Extreme High-Contrast Dark Mode Styling */
        html.dark-mode body,
        html.dark-mode .layout-wrapper,
        html.dark-mode .layout-container,
        html.dark-mode .layout-page,
        html.dark-mode .content-wrapper,
        html.dark-mode .footer {
            background-color: #000000 !important; /* Pure pitch black for maximum contrast */
            background-image: none !important;
            color: #d1d5db !important;
        }

        html.dark-mode .layout-navbar,
        html.dark-mode .layout-menu,
        html.dark-mode .bg-navbar-theme,
        html.dark-mode .bg-menu-theme {
            background: #16161c !important; /* Stark contrast dark gray */
            border-right: 1px solid #3f3f4e !important;
            border-bottom: 1px solid #3f3f4e !important;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.9) !important;
        }

        html.dark-mode .card {
            background: #1c1c24 !important; /* Very prominent contrasting gray */
            border: 1px solid #3f3f4e !important;
            box-shadow: 0 8px 30px 0 rgba(0, 0, 0, 0.8) !important;
        }
        
        /* Preserve Dashboard Colored Cards in Dark Mode */
        html.dark-mode .card.bg-label-primary { background: rgba(105, 108, 255, 0.15) !important; border-color: rgba(105, 108, 255, 0.3) !important; }
        html.dark-mode .card.bg-label-info { background: rgba(3, 195, 236, 0.15) !important; border-color: rgba(3, 195, 236, 0.3) !important; }
        html.dark-mode .card.bg-label-success { background: rgba(113, 221, 55, 0.15) !important; border-color: rgba(113, 221, 55, 0.3) !important; }
        html.dark-mode .card.bg-label-warning { background: rgba(255, 171, 0, 0.15) !important; border-color: rgba(255, 171, 0, 0.3) !important; }
        html.dark-mode .card.bg-label-danger { background: rgba(255, 62, 29, 0.15) !important; border-color: rgba(255, 62, 29, 0.3) !important; }
        html.dark-mode .card.bg-label-secondary { background: rgba(133, 146, 163, 0.15) !important; border-color: rgba(133, 146, 163, 0.3) !important; }

        html.dark-mode .card-header {
            background: transparent !important;
            border-bottom: 1px solid #3f3f4e !important;
        }

        html.dark-mode .table {
            color: #e5e7eb !important;
        }

        html.dark-mode .table-light,
        html.dark-mode .table thead th {
            background: #252530 !important;
            color: #ffffff !important;
            border-bottom: 1px solid #3f3f4e !important;
        }

        html.dark-mode .table tbody tr:hover {
            background: #2a2a35 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5) !important;
        }

        html.dark-mode .bg-lighter,
        html.dark-mode .bg-white {
            background: #16161c !important;
            border-color: #3f3f4e !important;
        }

        html.dark-mode .text-dark,
        html.dark-mode .text-body,
        html.dark-mode .text-heading,
        html.dark-mode .card-title,
        html.dark-mode .card-header,
        html.dark-mode label,
        html.dark-mode legend {
            color: #ffffff !important; /* Maximum text contrast */
        }
        
        /* Fix ApexCharts & SVGs in Dark Mode */
        html.dark-mode .apexcharts-text tspan,
        html.dark-mode .apexcharts-legend-text,
        html.dark-mode .apexcharts-datalabel,
        html.dark-mode .apexcharts-datalabel-label,
        html.dark-mode .apexcharts-datalabel-value,
        html.dark-mode .apexcharts-tooltip-text {
            fill: #ffffff !important;
            color: #ffffff !important;
        }
        html.dark-mode .apexcharts-tooltip {
            background: #1c1c24 !important;
            border: 1px solid #3f3f4e !important;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.9) !important;
        }
        html.dark-mode .apexcharts-tooltip-title {
            background: #252530 !important;
            border-bottom: 1px solid #3f3f4e !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }
        
        html.dark-mode .apexcharts-tooltip-text-y-label,
        html.dark-mode .apexcharts-tooltip-text-y-value,
        html.dark-mode .apexcharts-tooltip-text-z-value {
            color: #ffffff !important;
        }

        html.dark-mode .modal-content {
            background-color: #1c1c24 !important;
            border: 1px solid #3f3f4e !important;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.9) !important;
        }

        html.dark-mode .page-link {
            background-color: #16161c !important;
            border-color: #3f3f4e !important;
            color: #d1d5db !important;
        }
        
        html.dark-mode .page-item.active .page-link {
            background-color: #3f3f4e !important;
            border-color: #525266 !important;
            color: #ffffff !important;
        }

        html.dark-mode .form-control,
        html.dark-mode .form-select,
        html.dark-mode .input-group-text {
            background-color: #16161c !important;
            border: 1px solid #3f3f4e !important;
            color: #ffffff !important;
        }

        /* Select2 Dark Mode Fixes */
        html.dark-mode .select2-container--default .select2-selection--single,
        html.dark-mode .select2-container--default .select2-selection--multiple {
            background-color: #16161c !important;
            border: 1px solid #3f3f4e !important;
        }
        
        html.dark-mode .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #ffffff !important;
        }

        html.dark-mode .select2-dropdown {
            background-color: #1c1c24 !important;
            border: 1px solid #3f3f4e !important;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.9) !important;
        }

        html.dark-mode .select2-search--dropdown .select2-search__field {
            background-color: #16161c !important;
            border: 1px solid #3f3f4e !important;
            color: #ffffff !important;
        }

        html.dark-mode .select2-container--default .select2-results__option {
            background-color: transparent !important;
            color: #d1d5db !important;
        }

        html.dark-mode .select2-container--default .select2-results__option--highlighted[aria-selected],
        html.dark-mode .select2-container--default .select2-results__option--highlighted[data-selected] {
            background-color: #696cff !important;
            color: #ffffff !important;
        }

        html.dark-mode .select2-container--default .select2-results__option[aria-selected="true"] {
            background-color: #2a2a35 !important;
            color: #ffffff !important;
        }

        html.dark-mode .form-control:focus,
        html.dark-mode .form-select:focus {
            background-color: #1c1c24 !important;
            border-color: #696cff !important;
            box-shadow: 0 0 0 0.25rem rgba(105, 108, 255, 0.3) !important;
        }

        html.dark-mode .dropdown-menu {
            background: #1c1c24 !important;
            border: 1px solid #3f3f4e !important;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.9) !important;
        }

        html.dark-mode .dropdown-item {
            color: #d1d5db !important;
        }
        
        html.dark-mode .dropdown-item:hover {
            background: #2a2a35 !important;
            color: #ffffff !important;
        }
        
        html.dark-mode .text-muted {
            color: #a1acb8 !important;
        }

        /* Mobile Bottom Navigation */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 65px;
            background-color: #ffffff;
            box-shadow: 0 -4px 15px rgba(0,0,0,0.05);
            z-index: 1050;
            justify-content: space-around;
            align-items: center;
            padding-bottom: env(safe-area-inset-bottom);
        }
        .mobile-bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #697a8d;
            text-decoration: none;
            font-size: 11px;
            font-weight: 500;
            flex: 1;
            height: 100%;
            transition: color 0.2s;
        }
        .mobile-bottom-nav-item:hover {
            color: #696cff;
        }
        .mobile-bottom-nav-item i {
            font-size: 24px;
            margin-bottom: 2px;
        }
        .mobile-bottom-nav-item.active {
            color: #696cff;
            font-weight: 600;
        }
        
        @media (max-width: 991.98px) {
            .mobile-bottom-nav {
                display: flex;
            }
            .layout-page,
            .content-wrapper {
                padding-bottom: 35px !important; /* Space for bottom nav */
            }
            .footer {
                display: none !important; /* Hide footer on mobile completely */
            }
            .layout-menu-toggle {
                display: none !important; /* Hide hamburger menu toggle */
            }
            #layout-menu {
                display: none !important; /* Force hide the sidebar */
            }
        }
        
        /* Dark Mode for Mobile Nav */
        html.dark-mode .mobile-bottom-nav {
            background-color: #16161c !important;
            border-top: 1px solid #3f3f4e !important;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.8) !important;
        }
        html.dark-mode .mobile-bottom-nav-item {
            color: #a1acb8 !important;
        }
        html.dark-mode .mobile-bottom-nav-item.active {
            color: #696cff !important;
        }

        /* Dark Mode Offcanvas (Bottom Sheet) */
        html.dark-mode .offcanvas {
            background-color: rgba(28, 28, 36, 0.75) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        html.dark-mode .offcanvas .text-muted {
            color: #a1acb8 !important;
        }
        html.dark-mode .offcanvas .bg-label-secondary {
            background-color: rgba(133, 146, 163, 0.15) !important;
            color: #d1d5db !important;
        }
        html.dark-mode .offcanvas .bg-label-danger {
            background-color: rgba(255, 62, 29, 0.15) !important;
            color: #ff3e1d !important;
        }
        html.dark-mode .offcanvas .text-body {
            color: #d1d5db !important;
        }

        /* 🌙 Dark Mode SweetAlert2 */
        html.dark-mode .swal2-popup {
            background-color: #1c1c24 !important;
            color: #d1d5db !important;
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            border-radius: 16px !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.8) !important;
        }
        html.dark-mode .swal2-title, html.dark-mode .swal2-html-container {
            color: #d1d5db !important;
        }
        html.dark-mode .swal2-icon.swal2-success {
            border-color: #71dd37 !important;
            color: #71dd37 !important;
        }
        html.dark-mode .swal2-icon.swal2-success [class^=swal2-success-line] {
            background-color: #71dd37 !important;
        }
        html.dark-mode .swal2-icon.swal2-success .swal2-success-ring {
            border-color: rgba(113, 221, 55, 0.3) !important;
        }
        html.dark-mode .swal2-icon.swal2-warning {
            border-color: #ffab00 !important;
            color: #ffab00 !important;
        }
        html.dark-mode .swal2-icon.swal2-error {
            border-color: #ff3e1d !important;
            color: #ff3e1d !important;
        }
        html.dark-mode .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
            background-color: #ff3e1d !important;
        }

        /* 📊 DataTables Global Fixes */
        .dataTables_length, .dataTables_filter {
            margin-bottom: 1rem;
        }
        .table-hover tbody tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        /* 📱 Senior Native App Mobile Experience (Cards, Tables, Spacing) */
        @media (max-width: 767.98px) {
            /* Pure App Backgrounds */
            body { background-color: #f5f5f9 !important; }
            html.dark-mode body { background-color: #000000 !important; }
            
            /* Full Width Mobile Search Box */
            .dataTables_filter {
                text-align: left !important;
            }
            .dataTables_filter label {
                width: 100% !important;
                display: block;
            }
            .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
                margin-top: 8px;
            }
            
            /* Center DataTables Footer (Info & Pagination) */
            .dataTables_wrapper .row:last-child {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1rem;
                padding-top: 1rem;
            }
            .dataTables_info, .dataTables_paginate {
                text-align: center !important;
                width: 100% !important;
                padding-top: 0 !important;
            }
            .pagination {
                justify-content: center !important;
                flex-wrap: wrap !important;
                gap: 5px;
            }

            /* Lift Modals and Toasts above Bottom Nav */
            .modal-dialog {
                margin-bottom: 95px !important; /* Prevents save buttons from being hidden */
            }
            .toast-container {
                bottom: 90px !important; /* Moves alerts above the bottom bar */
                z-index: 1090 !important;
            }

            .layout-page, .content-wrapper {
                padding-bottom: 85px !important; /* Space above bottom nav */
            }
            .container-xxl {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            /* Native App Cards (Floating, rounded, soft shadows) */
            .card {
                border: none !important;
                border-radius: 16px !important;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04) !important;
                margin-bottom: 16px !important;
                /* Removed forced background-color to preserve bg-label-* utility classes */
            }
            html.dark-mode .card {
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6) !important;
                border: 1px solid rgba(255,255,255,0.03) !important;
            }
            .card-header {
                padding: 16px 16px 8px 16px !important;
                border-bottom: none !important;
                background: transparent !important;
            }
            .card-header h5 {
                font-weight: 700 !important;
                font-size: 1.15rem !important;
                letter-spacing: -0.5px;
            }
            .card-body {
                padding: 16px !important;
            }

            /* Native App Tables (Transformed into Floating Row Lists) */
            .table-responsive {
                border: none !important;
                border-radius: 16px !important;
                background: transparent !important;
                padding-bottom: 8px; /* Room for shadow */
            }
            .table {
                display: block !important;
                width: 100% !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
                white-space: nowrap !important;
                background: transparent !important;
                border-collapse: separate !important;
                border-spacing: 0 8px !important; /* Spacing between floating rows */
                padding: 0 4px;
            }
            .table thead th {
                border: none !important;
                background: transparent !important;
                font-size: 10px !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                letter-spacing: 1px !important;
                padding: 0 16px 8px 16px !important;
                color: #a1acb8 !important;
            }
            .table tbody tr {
                background-color: #ffffff !important;
                border-radius: 12px !important;
                box-shadow: 0 2px 8px rgba(0,0,0,0.04) !important;
                transition: transform 0.2s !important;
            }
            html.dark-mode .table tbody tr {
                background-color: #252530 !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.4) !important;
            }
            .table tbody td {
                border-top: none !important;
                border-bottom: none !important;
                padding: 16px 16px !important; /* Taller tap targets */
                vertical-align: middle !important;
            }
            /* Round the corners of the first and last td to complete the row card */
            .table tbody td:first-child { border-top-left-radius: 12px !important; border-bottom-left-radius: 12px !important; }
            .table tbody td:last-child { border-top-right-radius: 12px !important; border-bottom-right-radius: 12px !important; }

            /* Premium Inputs & Buttons */
            .form-control, .form-select {
                border-radius: 12px !important;
                padding: 12px 16px !important;
                font-size: 16px !important; /* Prevents iOS auto-zoom */
                background-color: #f1f5f9 !important;
                border: none !important;
            }
            html.dark-mode .form-control, html.dark-mode .form-select {
                background-color: #252530 !important;
                border: 1px solid rgba(255,255,255,0.05) !important;
                color: #ffffff !important;
            }
            /* Native feeling Select2 dropdowns */
            .select2-container--default .select2-selection--single {
                border-radius: 12px !important;
                height: 48px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 48px !important;
                padding-left: 16px !important;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 48px !important;
            }
            .select2-dropdown {
                border-radius: 12px !important;
                border: none !important;
                box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
            }
            html.dark-mode .select2-dropdown {
                box-shadow: 0 8px 32px rgba(0,0,0,0.8) !important;
                border: 1px solid rgba(255,255,255,0.05) !important;
            }
            .btn {
                border-radius: 12px !important;
                padding: 12px 20px !important;
                font-weight: 600 !important;
                letter-spacing: 0.5px !important;
            }
        }
    </style>
</head>

<body>
    @php
        $user = auth()->user();
        $isAdmin = $user && $user->user_type_id == 1;
    @endphp
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo py-4">
                    <a href="{{ $isAdmin ? route('admin.dashboard') : route('employee.dashboard') }}" class="app-brand-link gap-2 align-items-center">
                        <img src="{{ asset('img/gujarat-police-seeklogo.png') }}" alt="Logo" style="height: 40px; width: auto; object-fit: contain;">
                        <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize fs-5">Botad Police</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                        <a href="{{ $isAdmin ? route('admin.dashboard') : route('employee.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>

                    <!-- Vehicle Checking -->
                    <li class="menu-item {{ request()->routeIs('admin.vehicle-checks.*') || request()->routeIs('employee.vehicle-checks.*') ? 'active' : '' }}">
                        <a href="{{ $isAdmin ? route('admin.vehicle-checks.index') : route('employee.vehicle-checks.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-car"></i>
                            <div data-i18n="Vehicle Checking">Vehicle Checking</div>
                        </a>
                    </li>

                    @if($isAdmin)
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Management</span></li>
                    <li class="menu-item {{ request()->routeIs('admin.checking-points.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.checking-points.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-map-pin"></i>
                            <div data-i18n="Checking Points">Checking Points</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.employees') ? 'active' : '' }}">
                        <a href="{{ route('admin.employees') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div data-i18n="Employees">Employees</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Administration</span></li>
                    <li class="menu-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                        <a href="{{ route('admin.reports') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                            <div data-i18n="Reports">Reports</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.duty-roster') ? 'active' : '' }}">
                        <a href="{{ route('admin.duty-roster') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="Duty Roster">Duty Roster</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div data-i18n="Settings">Settings</div>
                        </a>
                    </li>
                    @else
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">My Account</span></li>
                    <li class="menu-item {{ request()->routeIs('employee.profile') ? 'active' : '' }}">
                        <a href="{{ route('employee.profile') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Profile">My Profile</div>
                        </a>
                    </li>
                    
                    <li class="menu-header small text-uppercase"><span class="menu-header-text"> Performance</span></li>
                    <li class="menu-item {{ request()->routeIs('employee.duty-roster') ? 'active' : '' }}">
                        <a href="{{ route('employee.duty-roster') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar-star"></i>
                            <div data-i18n="My Duty Roster">My Duty Roster</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('employee.performance') ? 'active' : '' }}">
                        <a href="{{ route('employee.performance') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-line-chart"></i>
                            <div data-i18n="Performance">Performance</div>
                        </a>
                    </li>
                    @endif
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <form class="nav-item d-flex align-items-center m-0" action="{{ $isAdmin ? route('admin.vehicle-checks.index') : route('employee.vehicle-checks.index') }}" method="GET">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" name="global_search" class="form-control border-0 shadow-none" placeholder="Search vehicle, name, etc..." aria-label="Search..." value="{{ request('global_search') }}" />
                                <button type="submit" class="d-none"></button>
                            </form>
                        </div>
                        <!-- /Search -->
                        
                        <ul class="navbar-nav flex-row align-items-center ms-auto">


                            <!-- Fullscreen Toggle (Desktop Only) -->
                            <li class="nav-item me-2 me-xl-2 d-none d-lg-block">
                                <a class="nav-link hide-arrow" href="javascript:void(0);" onclick="toggleFullScreen()">
                                    <i class='bx bx-fullscreen bx-sm' id="fullscreen-icon"></i>
                                </a>
                            </li>

                            <!-- Style Switcher -->
                            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-2">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class='bx bx-sun bx-sm' id="theme-icon"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="setTheme('light')">
                                            <span class="align-middle"><i class='bx bx-sun me-2'></i>Light</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="setTheme('dark')">
                                            <span class="align-middle"><i class="bx bx-moon me-2"></i>Dark</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- / Style Switcher-->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        @if($user->profile_photo)
                                            <img src="{{ str_starts_with($user->profile_photo, 'profile_photos/') ? asset('storage/' . $user->profile_photo) : asset($user->profile_photo) }}" alt class="rounded-circle" style="object-fit: cover; width: 40px; height: 40px;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold h-100 w-100" style="background-color: {{ $isAdmin ? '#696cff' : '#71dd37' }}">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @if($user->profile_photo)
                                                            <img src="{{ str_starts_with($user->profile_photo, 'profile_photos/') ? asset('storage/' . $user->profile_photo) : asset($user->profile_photo) }}" alt class="rounded-circle" style="object-fit: cover; width: 40px; height: 40px;">
                                                        @else
                                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold h-100 w-100" style="background-color: {{ $isAdmin ? '#696cff' : '#71dd37' }}">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ $user->name }}</span>
                                                    <small class="text-muted">{{ $isAdmin ? 'Admin' : 'Employee' }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ $isAdmin ? route('admin.profile') : route('employee.profile') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-white border-top shadow-sm mt-auto" style="border-top: 2px solid #696cff !important;">
                        <div class="container-xxl d-flex flex-wrap justify-content-between align-items-center py-3 flex-md-row flex-column text-center text-md-start">
                            <div class="mb-2 mb-md-0 d-flex flex-column flex-md-row align-items-center">
                                <span class="fw-bold text-primary fs-5 me-2" style="letter-spacing: 1px;"></i> Botad Police</span>
                                <span class="text-muted d-none d-md-inline">|</span>
                                <span class="text-muted ms-md-2 mt-1 mt-md-0 fw-semibold">
                                    © <script>document.write(new Date().getFullYear());</script> DriveCheck System
                                </span>
                            </div>
                            <div class="d-flex align-items-center mt-2 mt-md-0">
                                <span class="badge bg-label-primary px-3 py-2 rounded-pill"><i class="bx bx-check-shield me-1"></i> Secure Portal</span>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Mobile Bottom Navigation -->
        @if(auth()->check())
        <div class="mobile-bottom-nav d-lg-none">
            @if(auth()->user()->user_type_id == 1)
                <!-- Admin Mobile Nav -->
                <a href="{{ route('admin.dashboard') }}" class="mobile-bottom-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bx bx-home-circle"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('admin.vehicle-checks.index') }}" class="mobile-bottom-nav-item {{ request()->routeIs('admin.vehicle-checks.*') ? 'active' : '' }}">
                    <i class="bx bx-check-shield"></i>
                    <span>Checks</span>
                </a>
                <a href="{{ route('admin.employees') }}" class="mobile-bottom-nav-item {{ request()->routeIs('admin.employees*') ? 'active' : '' }}">
                    <i class="bx bx-group"></i>
                    <span>Employees</span>
                </a>
                <a href="#" class="mobile-bottom-nav-item" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas">
                    <i class="bx bx-grid-alt"></i>
                    <span>Menu</span>
                </a>
            @else
                <!-- Employee Mobile Nav -->
                <a href="{{ route('employee.dashboard') }}" class="mobile-bottom-nav-item {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <i class="bx bx-home-circle"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('employee.vehicle-checks.index') }}" class="mobile-bottom-nav-item {{ request()->routeIs('employee.vehicle-checks.*') ? 'active' : '' }}">
                    <i class="bx bx-scan"></i>
                    <span>Scans</span>
                </a>
                <a href="{{ route('employee.duty-roster') }}" class="mobile-bottom-nav-item {{ request()->routeIs('employee.duty-roster') ? 'active' : '' }}">
                    <i class="bx bx-calendar-event"></i>
                    <span>Duty</span>
                </a>
                <a href="#" class="mobile-bottom-nav-item" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas">
                    <i class="bx bx-grid-alt"></i>
                    <span>Menu</span>
                </a>
            @endif
        </div>

        <!-- Mobile Menu Offcanvas (Bottom Sheet) -->
        <div class="offcanvas offcanvas-bottom d-lg-none" tabindex="-1" id="mobileMenuOffcanvas" style="height: auto; border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <div class="offcanvas-header justify-content-center border-bottom pb-2 pt-3">
                <div style="width: 40px; height: 5px; background: #d1d5db; border-radius: 5px;"></div>
            </div>
            <div class="offcanvas-body pt-4 pb-5">
                <h6 class="text-muted fw-bold mb-3 px-2 text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Menu Options</h6>
                <div class="row g-3">
                    @if(auth()->user()->user_type_id == 1)
                        <!-- Admin Grid Menu -->
                        <div class="col-4 text-center">
                            <a href="{{ route('admin.profile') }}" class="text-body d-block p-3 rounded {{ request()->routeIs('admin.profile') ? 'bg-primary text-white shadow-sm' : 'bg-label-secondary' }}">
                                <i class="bx bx-user-circle fs-2 mb-2"></i><br>
                                <span style="font-size: 12px; font-weight: 500;">Profile</span>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="{{ route('admin.checking-points.index') }}" class="text-body d-block p-3 rounded {{ request()->routeIs('admin.checking-points.*') ? 'bg-primary text-white shadow-sm' : 'bg-label-secondary' }}">
                                <i class="bx bx-map-pin fs-2 mb-2"></i><br>
                                <span style="font-size: 12px; font-weight: 500;">Points</span>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="{{ route('admin.reports') }}" class="text-body d-block p-3 rounded {{ request()->routeIs('admin.reports') ? 'bg-primary text-white shadow-sm' : 'bg-label-secondary' }}">
                                <i class="bx bx-bar-chart-alt-2 fs-2 mb-2"></i><br>
                                <span style="font-size: 12px; font-weight: 500;">Reports</span>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="{{ route('admin.duty-roster') }}" class="text-body d-block p-3 rounded {{ request()->routeIs('admin.duty-roster') ? 'bg-primary text-white shadow-sm' : 'bg-label-secondary' }}">
                                <i class="bx bx-calendar fs-2 mb-2"></i><br>
                                <span style="font-size: 12px; font-weight: 500;">Roster</span>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="{{ route('admin.settings') }}" class="text-body d-block p-3 rounded {{ request()->routeIs('admin.settings') ? 'bg-primary text-white shadow-sm' : 'bg-label-secondary' }}">
                                <i class="bx bx-cog fs-2 mb-2"></i><br>
                                <span style="font-size: 12px; font-weight: 500;">Settings</span>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger d-block p-3 rounded bg-label-danger w-100 text-decoration-none border-0 h-100">
                                    <i class="bx bx-power-off fs-2 mb-2"></i><br>
                                    <span style="font-size: 12px; font-weight: 500;">Logout</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Employee Grid Menu -->
                        <div class="col-4 text-center">
                            <a href="{{ route('employee.profile') }}" class="text-body d-block p-3 rounded {{ request()->routeIs('employee.profile') ? 'bg-primary text-white shadow-sm' : 'bg-label-secondary' }}">
                                <i class="bx bx-user-circle fs-2 mb-2"></i><br>
                                <span style="font-size: 12px; font-weight: 500;">Profile</span>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="{{ route('employee.performance') }}" class="text-body d-block p-3 rounded {{ request()->routeIs('employee.performance') ? 'bg-primary text-white shadow-sm' : 'bg-label-secondary' }}">
                                <i class="bx bx-line-chart fs-2 mb-2"></i><br>
                                <span style="font-size: 12px; font-weight: 500;">Stats</span>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link text-danger d-block p-3 rounded bg-label-danger w-100 text-decoration-none border-0 h-100">
                                    <i class="bx bx-power-off fs-2 mb-2"></i><br>
                                    <span style="font-size: 12px; font-weight: 500;">Logout</span>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK',
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'OK',
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
            @endif

            @if($errors->any())
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += "{{ $error }}\n";
                @endforeach
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessages,
                    confirmButtonText: 'OK',
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
            @endif
        });

        // Theme Toggle Functionality
        function setTheme(theme) {
            const htmlTag = document.documentElement;
            const themeIcon = document.getElementById('theme-icon');
            
            if (theme === 'dark') {
                htmlTag.classList.add('dark-mode');
                if (themeIcon) themeIcon.classList.replace('bx-sun', 'bx-moon');
                localStorage.setItem('theme', 'dark');
            } else {
                htmlTag.classList.remove('dark-mode');
                if (themeIcon) themeIcon.classList.replace('bx-moon', 'bx-sun');
                localStorage.setItem('theme', 'light');
            }
        }

        // Check local storage on load
        if(localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
            const themeIcon = document.getElementById('theme-icon');
            if(themeIcon) themeIcon.classList.replace('bx-sun', 'bx-moon');
        }
        // Fullscreen Logic
        function toggleFullScreen() {
            const doc = window.document;
            const docEl = doc.documentElement;
            const icon = document.getElementById('fullscreen-icon');

            const requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
            const cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

            if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
                if(requestFullScreen) requestFullScreen.call(docEl);
                if(icon) {
                    icon.classList.remove('bx-fullscreen');
                    icon.classList.add('bx-exit-fullscreen');
                }
            } else {
                if(cancelFullScreen) cancelFullScreen.call(doc);
                if(icon) {
                    icon.classList.remove('bx-exit-fullscreen');
                    icon.classList.add('bx-fullscreen');
                }
            }
        }
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    @stack('scripts')
</body>
</html>