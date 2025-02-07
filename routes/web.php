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
use App\Http\Resources\Attendance;
use App\Models\User;
use Illuminate\Http\Request as Request;

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
    Route::get('/logs/generate-pdf', [LogController::class, 'generatePDF'])->name('logs.pdf');

    // STUDENT RELATED ROUTES
    Route::post('/addStudent', [StudentController::class, 'create'])->name('addStudent');
    Route::get('/students', [StudentController::class, 'view'])->name('students');
    Route::delete('/deleteStudent', [StudentController::class, 'delete'])->name('deleteStudent');
    Route::patch('/updateStudent', [StudentController::class, 'update'])->name('updateStudent');
    // ATTENDANCE RELATED ROUTES
    Route::get('/attendance', [StudentAttendanceController::class, 'view'])->name('attendance');
    Route::post('/student-attendance', [StudentAttendanceController::class, 'recordAttendance'])->name('attendanceStudent');
    Route::get('/studentAttendace/recent', [StudentAttendance::class, 'recent'])->name('getAttendanceRecent');
    // Route::post

    // EVENTS RELATED ROUTES
    Route::post('/addEvent', [EventController::class, 'create'])->name('addEvent');
    Route::get('/events', [EventController::class, 'view'])->name('events');
    Route::delete('/deleteEvent', [EventController::class, 'delete'])->name('deleteEvent');
    Route::patch('/updateEvent', [EventController::class, 'update'])->name('updateEvent'); // Add this line
});


require __DIR__ . '/auth.php';



// THE CODE BELOW IS USED FOR DEVELOPMENT AND TESTING  PURPOSES ONLY
// API TESTING OR DEVELOPMENT
Route::get('/api/test/1', function () {
    $data = new Attendance(User::all());
    return view('test.test_1', compact('data'));
})->name('api_test_1');

Route::get('/api/test/2', function () {
    // $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    // $data = $response->json(); // Convert response to array
    return response()->json([
        "message" => "WOrking",
    ]);
});

Route::post('/api/test/3', function (Request $request) {

    return response()->json([
        "message" => "POST created successfully",
        "data" => $request->name

    ]);
})->name('postAPI');
