<?php

namespace App\Http\Controllers;

use App\Exports\StudentAttendanceExport;
use App\Models\Event;
use App\Models\Log;
use App\Models\StudentAttendance;
use App\Models\Fine;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

use function Pest\Laravel\json;

class LogController extends Controller
{
    public function viewLogs()
    {
        $logs = StudentAttendance::join('students', function($join){
            $join->on('student_attendances.student_rfid', '=', 'students.s_rfid')
            ->orOn('student_attendances.student_rfid', '=', 'students.s_studentID');
        })
            ->join('events', 'events.id', '=', 'student_attendances.event_id')
            ->get();

        // Get fines with related student and event data
        $fines = Fine::with(['student', 'event'])
            ->orderBy('created_at', 'desc')
            ->get();


        $events = Event::select('*')->orderBy('created_at')->get();
        return view('pages.logs', compact('logs', 'fines', 'events'));
    }

    public function exportFile(Request $request){

        $request->validate([
            "event_id"=>['required'],
            "file_type"=>['required']
        ]);


        if($request->file_type == "pdf"){

          return $this->generatePDF($request);
        }

        if($request->file_type == "excel"){
            return $this->generateExcel($request);
        }


        return back()->with(['failed'=>"Something went wrong"]);
    }

    protected function generatePDF(Request $request)
    {
        $logs = StudentAttendance::select('*', 'student_attendances.created_at')
            ->join('students', function($join){
                $join->on('student_attendances.student_rfid', '=', 'students.s_rfid')
                ->orOn('student_attendances.student_rfid', '=', 'students.s_studentID');
            })->join('events', 'events.id', '=', 'student_attendances.event_id');
        if($request->event_id){
            $logs = $logs->where('event_id', $request->event_id);
        }
          if($request->s_lvl){
            $logs = $logs->where('s_lvl', $request->s_lvl);
        }
        if($request->s_set){
            $logs = $logs->where('s_set', $request->s_set);
        }
        if($request->s_program){
            $logs = $logs->where('s_program', $request->s_program);
        }
        if($request->s_status){
            $logs = $logs->where('s_status', $request->s_status);
        }
        $logs = $logs->get();
        $pdf = PDF::loadView('reports.attendance', compact('logs'));

        return $pdf->download('burh_attendance_report.pdf');


    }
    protected function generateExcel(Request $request){
        $request->validate([
            "event_id"=> ['required']
        ]);
        $logs = StudentAttendance::select('students.s_studentID',
        'students.s_lname', 'students.s_fname',
        'students.s_program',  'students.s_set',
        'students.s_lvl',  'student_attendances.attend_checkIn',
        'student_attendances.attend_checkOut', 'events.event_name',
        'student_attendances.created_at')
            ->join('students', function($join){
                $join->on('student_attendances.student_rfid', '=', 'students.s_rfid')
                ->orOn('student_attendances.student_rfid', '=', 'students.s_studentID');
            })->join('events', 'events.id', '=', 'student_attendances.event_id');
        if($request->event_id){
            $logs = $logs->where('event_id', $request->event_id);
        }
          if($request->s_lvl){
            $logs = $logs->where('s_lvl', $request->s_lvl);
        }
        if($request->s_set){
            $logs = $logs->where('s_set', $request->s_set);
        }
        if($request->s_program){
            $logs = $logs->where('s_program', $request->s_program);
        }
        if($request->s_status){
            $logs = $logs->where('s_status', $request->s_status);
        }
        $logs = $logs->get();
        $students = new StudentAttendanceExport;
        $students->setCollection($logs);
        return Excel::download( $students, $logs->first()->event_name . "_student_attendance_report.xlsx");

    }

    protected function generateCSV(Request $request){
        $request->validate([
            "event_id"=> ['required']
        ]);

        $csv = Csv::class;
    }

    public function filterByCategory(Request $request){
        $students = StudentAttendance::select('*', 'student_attendances.created_at')->join('students', function($join){
            $join->on('student_attendances.student_rfid', '=', 'students.s_rfid')
            ->orOn('student_attendances.student_rfid', '=', 'students.s_studentID');
        })->join('events', 'events.id', '=', 'student_attendances.event_id')
        ;

        if ($request->query('set')) {
            $set = explode(',', $request->query('set'));
            $students = $students->where('s_set', $set);
        }
        if ($request->query('lvl')) {
            $lvl = explode(',', $request->query('lvl'));
            $students = $students->where('s_lvl', $lvl);
        }
        if ($request->query('program')) {
            $program = explode(',', $request->query('program'));
            $students = $students->where('s_program', $program);
        }

        if($request->query('event_id')){
            $students = $students->where('event_id', $request->query('event_id'));
        }

        $students = $students->get();

        if (empty($students->first())) {
            return response()->json([
                'message' => 'Student not found',
                'students' => null,
                'query' => $request->query(),
            ]);
        }

        return response()->json([
            'message' => 'Working fine',
            'students' => $students,
            'query' => $request->query(),
        ]);
    }
}
