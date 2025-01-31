<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentController;
use App\Models\StudentAttendance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminCodeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin-code', function () {
    return view('auth.admin-code');
})->name('admin.code');

Route::post('/admin-code', [AdminCodeController::class, 'verify'])->name('admin.code.verify');

Route::get('/register', function () {
    if (!session('admin_code_verified')) {
        return redirect()->route('admin.code');
    }
    return view('auth.register');
})->name('register');

Route::middleware('auth')->group(function () {

    // DASHBOARD RELATED ROUTES
    Route::get('/dashboard', [DashboardController::class, 'viewDashboard'])->name('dashboard');


    // PROFILE RELATED ROUTES
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // LOGS RELATED ROUTES
    Route::get('/logs', [LogController::class, 'viewLogs'])->name('logs');


    // STUDENT RELATED ROUTES
    Route::post('/addStudent', [StudentController::class, 'create'])->name('addStudent');
    Route::get('/students', [StudentController::class, 'view'])->name('students');

    // ATTENDANCE RELATED ROUTES
    Route::get('/attendance', [StudentAttendanceController::class, 'view'])->name('attendance');
    // Route::post

    // EVENTS RELATED ROUTES
    Route::post('/addEvent', [EventController::class, 'create'])->name('addEvent');
    Route::get('/events', [EventController::class, 'view'])->name('events');
});

require __DIR__ . '/auth.php';
