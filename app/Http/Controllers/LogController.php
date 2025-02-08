<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LogController extends Controller
{
    public function viewLogs()
    {
        $logs = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->orderBy('events.date', 'desc')
            ->get();

        // Get all fines including student details
        $fines = Fine::join('students', 'fines.student_id', '=', 'students.id')
            ->join('events', 'fines.event_id', '=', 'events.id')
            ->select(
                'fines.*',
                'students.s_fname',
                'students.s_lname',
                'students.s_program',
                'students.s_set',
                'students.s_lvl',
                'events.event_name', 
                'events.date'
            )
            ->where(function($query) {
                $query->where('absences', '>', 0)
                      ->orWhere('morning_checkin', false)
                      ->orWhere('morning_checkout', false)
                      ->orWhere('afternoon_checkin', false)
                      ->orWhere('afternoon_checkout', false);
            })
            ->orderBy('events.date', 'desc')
            ->orderBy('students.s_lname')
            ->get();

        return view('pages.logs', compact('logs', 'fines'));
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
