<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    /** @use HasFactory<\Database\Factories\StudentAttendanceFactory> */
    use HasFactory;

    protected $fillable = [
        "attend_checkIn",
        "attend_checkOut",
        "event_id",
        "student_rfid",
        "didCheckIn"
    ];
}
