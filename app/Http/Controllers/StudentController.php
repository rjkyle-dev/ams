<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function create(Request $request)
    {
        dd('working');
    }

    public function view()
    {
        return view('pages.students');
    }
}
