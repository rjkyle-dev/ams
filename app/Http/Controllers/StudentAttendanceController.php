<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\StudentAttendance;
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


    public function recordAttendance(Request $request)
    {
        // FIRST VALIDATE REQUEST FORM
        $fields = $request->validate([
            "s_rfid" => ['required'],
        ]);
        // INITIALIZE VARIABLES, ETC
        $time = date("H: a");
        $student = StudentAttendance::where('s_rfid',)->get();
        $event = Event::where('id', $request->event_id)->get()->first();
        // CHECK IF THE STUDENT ALREADY HAS A RECORD TODAY OR AT THE CURRENT TIME
        if ($student->empty) {

            // CHECK IF CHECK IN
            if ($time > $event->checkIn_start && $time < $event->checkIn_end) {
                StudentAttendance::create([]);
            }
        }



        // RECORD THE DATA TO THE DATABASE

        // LASTLY SEND A RESPONSE TO THE WEB SERVER OR PAGE
        return response()->json([
            "message" => "Student Attendance recorded successfully!",
            "isRecorded" => true,
        ]);
    }
}
