<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function viewLogs()
    {
        return view('pages.logs');
    }
}
