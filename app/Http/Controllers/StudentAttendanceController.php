<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Student;
use App\Models\StudentAttendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentAttendanceController extends Controller
{
    public function view()
    {
        date_default_timezone_set('Asia/Manila');
        $time = $time = date("H:i");
        $event = Event::where('date', '=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get()
            ->first();

        $pending = Event::where('date', '=', date('Y-m-d'))
            ->where(function (Builder $query) {
                $query->orWhere(function (Builder $query) {
                    $time = $time = date("H:i");
                    $query->where('checkIn_start', '<', $time)
                        ->where('checkIn_end', '>', $time);
                })
                    ->orWhere(function (Builder $query) {
                        $time = $time = date("H:i");
                        $query->where('checkOut_start', '<', $time)
                            ->where('checkOut_end', '>', $time);
                    });
            })
            ->get();



        if (empty($event)) {
            $event = null;
            return view('pages.attendance', compact('event'));
        }
        if ($time > $event->checkOut_end || $time < $event->checkIn_start || ($time > $event->checkIn_end && $time < $event->checkOut_start)) {
            $event = null;
        }


        if (empty($pending->first())) {
            $pending = null;
        }
        $students = $this->recent();
        return view('pages.attendance', compact('event', 'students', 'pending'));
    }



    public function recordAttendance(Request $request)
    {
        // FIRST VALIDATE REQUEST FORM
        $fields = $request->validate([
            "s_rfid" => ['required'],
        ]);

        // CHECK IF STUDENT EXIST IN THE MASTERLIST
        if (empty(Student::whereAny(['s_rfid', 's_studentID'], $request->s_rfid)->get()->first())) {
            return response()->json([
                "message" => "I am sorry but the student does not exist in the masterlist",
                "isRecorded" => false,
                "doesntExist" => true,
            ]);
        }


        // INITIALIZE VARIABLES, ETC
        date_default_timezone_set('Asia/Manila');
        $time = date("H:i");
        $currentTimestamp = now();
        $currentTime = date('H:i:s');

        $event = Event::find($request->event_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->first();

        $student = StudentAttendance::where('student_rfid', $request->s_rfid)
            ->where('event_id', $request->event_id)
            ->get()
            ->first();

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
                    "attend_checkIn" => $currentTime,
                    "event_id" => $request->event_id,
                    "student_rfid" => $request->s_rfid,
                    "didCheckIn" => "true"
                ]);
            }

            // CHECK IF CHECK OUT
            if ($time > $event->checkOut_start && $time < $event->checkOut_end) {
                StudentAttendance::create([
                    "attend_checkOut" => $currentTime,
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
                    "message" => "Student has already checked in",
                    "isRecorded" => false
                ]);
            }

            if ($time > $event->checkOut_start && $time < $event->checkOut_end && $student->attend_checkOut) {
                return response()->json([
                    "message" => "Student has already checked out",
                    "isRecorded" => false
                ]);
            }

            if ($time > $event->checkOut_start && $time < $event->checkOut_end) {
                StudentAttendance::where('event_id', $request->event_id)
                    ->where('student_rfid', $request->s_rfid)
                    ->update([
                        "attend_checkOut" => $currentTime,
                    ]);
            }
        }


        // LASTLY SEND A RESPONSE TO THE WEB SERVER OR PAGE
        return response()->json([
            "message" => "Student Attendance recorded successfully!",
            "isRecorded" => true,
        ]);
    }

    public function recent()
    {
        date_default_timezone_set('Asia/Manila');
        $time = $time = date("H:i");
        $event = Event::where('date', '=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get()
            ->first();

        $students = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid');

        if (($time < $event->checkIn_end && $time > $event->checkIn_start)) {
            $students = $students
                ->where('attend_checkIn', 'true')
                ->where('event_id', $event->id)
                ->get();
        }
        if ($time < $event->checkOut_end && $time > $event->checkOut_start) {
            $students = $students->where('attend_checkOut', "true")
                ->where('event_id', $event->id)
                ->get();
        }

        if ($time > $event->checkOut_end || $time < $event->checkIn_start || ($time > $event->checkIn_end && $time < $event->checkOut_start)) {
            $event = null;
            $students = null;
        }

        return $students;
    }
}
