<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        $studentCount = Student::all()->count();
        return view('dashboard', compact('studentCount'));
    }

    public function test(Request $request) {}
}
