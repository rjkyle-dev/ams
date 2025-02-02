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
        $event = Event::find($request->event_id)->get();
        $student = StudentAttendance::where('s_rfid', $request->s_rfid)
            ->where('event_id', $request->event_id)
            ->get();

        // CHECK IF THE STUDENT ALREADY HAS A RECORD TODAY OR AT THE CURRENT TIME
        if ($student->empty) {
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
            if ($time > $event->checkOut_start && $time < $event->checkOut_end) {
                $student = $student->first();
                StudentAttendance::where('event_id', $request->event_id)
                    ->where('student_rfid', $request->s_rfid)->update([
                        "attend_checkOut" => "true",
                    ]);
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
