<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Fine;
use App\Models\FineSettings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentAttendanceController extends Controller
{
    public function view()
    {
        date_default_timezone_set('Asia/Manila');
        $time = date("H:i");
        $event = Event::where('date', '=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->first();

        if ($event) {
            // Check if periods have ended and calculate fines
            $checkInEnd = date('H:i', strtotime($event->checkIn_end));
            $checkOutEnd = date('H:i', strtotime($event->checkOut_end));

            if ($time > $checkInEnd) {
                $this->calculateMissingAttendance($event, 'checkIn');
            }
            if ($time > $checkOutEnd) {
                $this->calculateMissingAttendance($event, 'checkOut');
            }
        }

        // Remove automatic fine calculation from view method
        // Only get pending attendance status
        $pending = Event::where('date', '=', date('Y-m-d'))
            ->where(function (Builder $query) use ($time) {
                $query->orWhere(function (Builder $query) use ($time) {
                    $query->where('checkIn_start', '<', $time)
                        ->where('checkIn_end', '>', $time);
                })
                ->orWhere(function (Builder $query) use ($time) {
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

    protected function calculateMissingAttendance($event, $type)
    {
        $settings = FineSettings::firstOrCreate(['id' => 1], [
            'fine_amount' => 25.00
        ]);

        // Get all students
        $allStudents = Student::all();
        
        foreach ($allStudents as $student) {
            // Check attendance record
            $attendance = StudentAttendance::where('student_rfid', $student->s_rfid)
                ->where('event_id', $event->id)
                ->first();

            // Get or create fine record
            $fine = Fine::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'event_id' => $event->id
                ],
                [
                    'absences' => 0,
                    'fine_amount' => $settings->fine_amount,
                    'total_fines' => 0,
                    'morning_checkin' => false,
                    'morning_checkout' => false,
                    'afternoon_checkin' => false,
                    'afternoon_checkout' => false
                ]
            );

            // Calculate missing periods and fines
            $missingPeriods = 0;
            $currentTime = date('H:i');

            // Morning periods
            if ($currentTime > date('H:i', strtotime($event->checkIn_end))) {
                if (!$attendance || !$attendance->attend_checkIn) {
                    $missingPeriods++;
                    $fine->morning_checkin = false;
                }
            }
            
            if ($currentTime > date('H:i', strtotime($event->checkOut_end))) {
                if (!$attendance || !$attendance->attend_checkOut) {
                    $missingPeriods++;
                    $fine->morning_checkout = false;
                }
            }

            // Afternoon periods
            if ($currentTime > date('H:i', strtotime($event->checkIn_end))) {
                if (!$attendance || !$attendance->afternoon_checkin) {
                    $missingPeriods++;
                    $fine->afternoon_checkin = false;
                }
            }
            
            if ($currentTime > date('H:i', strtotime($event->checkOut_end))) {
                if (!$attendance || !$attendance->afternoon_checkout) {
                    $missingPeriods++;
                    $fine->afternoon_checkout = false;
                }
            }

            // Update fine record - ₱25 per missed period
            $fine->absences = $missingPeriods;
            $fine->total_fines = $missingPeriods * $settings->fine_amount;
            $fine->save();
        }
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

        // After recording attendance, check and create fines if needed
        $this->checkAndCreateFines($student->id, $request->event_id);

        // LASTLY SEND A RESPONSE TO THE WEB SERVER OR PAGE
        return response()->json([
            "message" => "Student Attendance recorded successfully!",
            "isRecorded" => true,
        ]);
    }

    protected function checkAndCreateFines($studentId, $eventId)
    {
        $settings = FineSettings::first();
        $attendance = StudentAttendance::where('student_id', $studentId)
            ->where('event_id', $eventId)
            ->first();

        if (!$attendance) {
            // Create fine record for absence
            Fine::create([
                'student_id' => $studentId,
                'event_id' => $eventId,
                'absences' => 1,
                'fine_amount' => $settings->fine_amount,
                'total_fines' => $settings->fine_amount
            ]);
        }
    }

    public function recent()
    {
        date_default_timezone_set('Asia/Manila');
        $time = date("H:i");
        $event = Event::where('date', '=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$event) {
            return null;
        }

        $students = StudentAttendance::join('students', 'students.s_rfid', '=', 'student_attendances.student_rfid')
            ->where('event_id', $event->id);

        // Show students based on current period
        if ($time >= $event->checkIn_start && $time <= $event->checkIn_end) {
            $students->whereNotNull('attend_checkIn');
        } else if ($time >= $event->checkOut_start && $time <= $event->checkOut_end) {
            $students->whereNotNull('attend_checkOut');
        }

        return $students->get();
    }
}
