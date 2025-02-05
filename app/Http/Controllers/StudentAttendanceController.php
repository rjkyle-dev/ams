<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Student;
use App\Models\StudentAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function view()
    {
        date_default_timezone_set('Asia/Manila');
        $time = $time = date("H:i");
        $event = Event::where('date', '=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get();
        if (empty($event)) {
            $event = null;
            return view('pages.attendance', compact('event'));
        }
        $event = $event->first();
        if ($time > $event->checkOut_end || $time < $event->checkIn_start || ($time > $event->checkIn_end && $time < $event->checkOut_start)) {
            $event = null;
        }

        return view('pages.attendance', compact('event'));
    }


    public function recordAttendance(Request $request)
    {
        // FIRST VALIDATE REQUEST FORM
        $fields = $request->validate([
            "s_rfid" => ['required', 'exists:students,s_rfid'],
        ]);

        // INITIALIZE VARIABLES, ETC
        date_default_timezone_set('Asia/Manila');
        $time = date("H:i");
        $event = Event::find($request->event_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->first();
        $student = StudentAttendance::where('student_rfid', $request->s_rfid)
            ->where('event_id', $request->event_id)
            ->get()
            ->first();

        if (empty(Student::where('s_rfid', $request->s_rfid)->get())) {
            return response()->json([
                "message" => "I am sorry but the student does not exist in the masterlist",
                "isRecorded" => false
            ]);
        }

        // DETERMINE IF IT IS ALREADY PAST THE SET CHECK IN AND CHECK OUT TIME
        if ($time < $event->checkIn_start || ($time > $event->checkIn_end && $time < $event->checkOut_start) || $time > $event->checkOut_end) {
            return response()->json([
                "message" => "I am sorry, but your attendance can only be recorded during the set time frame",
                "isRecorded" => false
            ]);
        }

        // CHECK IF THE STUDENT ALREADY HAS A RECORD TODAY OR AT THE CURRENT TIME
        if (empty($student)) {
            // CHECK IF CHECK IN
            if ($time > $event->checkIn_start && $time < $event->checkIn_end) {
                StudentAttendance::create([
                    "attend_checkIn" => "true",
                    "event_id" => $request->event_id,
                    "student_rfid" => $request->s_rfid,
                    "didCheckIn" => "true"
                ]);
            }

            // CHECK IF CHECK OUT
            if ($time > $event->checkOut_start && $time < $event->checkOut_end) {
                StudentAttendance::create([
                    "attend_checkOut" => "true",
                    "event_id" => $request->event_id,
                    "student_rfid" => $request->s_rfid,
                ]);
            }
        }
        // UPDATE THE ROW IF STUDENT ALREADY ATTENDED IN THE EVENT
        else {
            // CHECK IF STUDENT ALREADY HAVE A RECORD
            if ($time > $event->checkIn_start && $time < $event->checkIn_end && $student->attend_checkIn) {
                return response()->json([
                    "message" => "Student have already check in",
                    "isRecorded" => false
                ]);
            }

            if ($time > $event->checkOut_start && $time < $event->checkOut_end && $student->attend_checkOut) {
                return response()->json([
                    "message" => "Student have already check out",
                    "isRecorded" => false
                ]);
            }

            if ($time > $event->checkOut_start && $time < $event->checkOut_end) {
                $student = $student->first();
                StudentAttendance::where('event_id', $request->event_id)
                    ->where('student_rfid', $request->s_rfid)->update([
                        "attend_checkOut" => "true",
                    ]);
            }
        }


        // LASTLY SEND A RESPONSE TO THE WEB SERVER OR PAGE
        return response()->json([
            "message" => "Student Attendance recorded successfully!",
            "isRecorded" => true,
        ]);
    }
}
