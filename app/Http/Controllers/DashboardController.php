<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        $studentCount = Student::count();
        $graduateCount = Student::where('s_status', 'graduate')->count();

        return view('dashboard', compact('studentCount', 'graduateCount'));
    }

    public function test(Request $request) {}
}
