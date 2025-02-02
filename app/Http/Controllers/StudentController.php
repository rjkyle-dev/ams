<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            's_rfid' => 'required',
            's_studentID' => 'required',
            's_fname' => 'required',
            's_lname' => 'required',
            's_mname' => 'nullable',
            's_suffix' => 'nullable',
            's_program' => 'required',
            's_lvl' => 'required',
            's_set' => 'required',
            's_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        // Check RFID first
        if (Student::where('s_rfid', $request->s_rfid)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'RFID is already registered to another student'
            ]);
        }

        // Then check Student ID
        if (Student::where('s_studentID', $request->s_studentID)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student ID is already registered'
            ]);
        }

        // Finally check name combination if needed
        if (Student::where('s_fname', $request->s_fname)
                ->where('s_lname', $request->s_lname)
                ->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'A student with the same full name already exists'
            ]);
        }

        try {
            $studentData = $request->except('s_image');
            
            if ($request->hasFile('s_image')) {
                $file = $request->file('s_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');
                $studentData['s_image'] = $filename;
            }

            $studentData['s_status'] = 'active'; // Set default status
            
            Student::create($studentData);

            return response()->json([
                'status' => 'success',
                'message' => "You've successfully added a student"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error adding student: ' . $e->getMessage()
            ]);
        }
    }

    public function view()
    {
        return view('pages.students');
    }
}
