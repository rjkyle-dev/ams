<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LogController extends Controller
{
    public function viewLogs()
    {
        $logs = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->get();
        return view('pages.logs', compact('logs'));
    }

    public function generatePDF()
    {
        $logs = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->get();

        $pdf = PDF::loadView('reports.attendance', compact('logs'));
        return $pdf->download('attendance_report.pdf');
    }
}
