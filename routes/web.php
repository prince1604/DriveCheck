<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->user_type_id == 1 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('employee.dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/employees', [AdminController::class, 'employees'])->name('employees');
    Route::post('/employees', [AdminController::class, 'store'])->name('employees.store');
    Route::put('/employees/{user}', [AdminController::class, 'update'])->name('employees.update');
    Route::post('/employees/{user}/toggle-status', [AdminController::class, 'toggleStatus'])->name('employees.toggle_status');
    Route::delete('/employees/{user}', [AdminController::class, 'destroy'])->name('employees.destroy');
    
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    
    // New Feature Routes
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/check-export', [AdminController::class, 'checkExport'])->name('reports.check-export');
    Route::get('/reports/export', [AdminController::class, 'exportReport'])->name('reports.export');
    Route::get('/duty-roster', [AdminController::class, 'dutyRoster'])->name('duty-roster');
    Route::post('/duty-roster/update', [AdminController::class, 'updateDutyRoster'])->name('duty-roster.update');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    
    Route::resource('checking-points', \App\Http\Controllers\CheckingPointController::class)->except(['create', 'show', 'edit']);
    Route::resource('vehicle-checks', \App\Http\Controllers\VehicleCheckController::class)->except(['create', 'show', 'edit']);
});

Route::middleware(['auth', 'role:employee', 'check.active'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');
    Route::put('/profile', [EmployeeController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/account', [EmployeeController::class, 'destroyAccount'])->name('account.destroy');
    
    // New Feature Routes
    Route::get('/duty-roster', [EmployeeController::class, 'dutyRoster'])->name('duty-roster');
    Route::post('/duty-roster', [EmployeeController::class, 'updateDutyRoster'])->name('duty-roster.update');
    Route::get('/performance', [EmployeeController::class, 'performance'])->name('performance');
    
    Route::resource('vehicle-checks', \App\Http\Controllers\VehicleCheckController::class)->except(['create', 'show', 'edit']);
});
