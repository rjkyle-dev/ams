<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'event_id',
        'student_rfid',
        'fine_amount',
        'morning_checkIn_missed',
        'morning_checkOut_missed', 
        'afternoon_checkIn_missed',
        'afternoon_checkOut_missed',
        'total_fines'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_rfid', 's_rfid');
    }

    public function attendance()
    {
        return $this->belongsTo(StudentAttendance::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
