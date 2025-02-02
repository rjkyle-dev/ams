<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function view()
    {
        $event = Event::where('date', '=', date('Y-m-d'))->get();
        if (empty($event)) {
            $event = null;
        } else {
            $event = $event->first();
        }
        return view('pages.attendance', compact('event'));
    }
}