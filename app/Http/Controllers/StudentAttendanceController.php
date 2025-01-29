<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function view()
    {
        return view('pages.attendance');
    }
}
