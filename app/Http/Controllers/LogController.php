<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function viewLogs()
    {
        $logs = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->get();
        return view('pages.logs', compact('logs'));
    }
}
