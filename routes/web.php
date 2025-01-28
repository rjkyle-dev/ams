<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    // DASHBOARD RELATED ROUTES
    Route::get('/dashboard', [DashboardController::class, 'viewDashboard'])->name('dashboard');


    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // LOGS RELATED ROUTES
    Route::get('/logs', [LogController::class, 'viewLogs'])->name('logs');


    // STUDENT RELATED ROUTES
    Route::post('/addStudent', [StudentController::class, 'create'])->name('addStudent');
});

require __DIR__ . '/auth.php';
