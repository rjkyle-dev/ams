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
        "attend_day",
        "attend_date",
        "attend_rowUpdate",
    ];
}
