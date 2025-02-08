<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fine extends Model
{
    protected $fillable = [
        'student_id',
        'event_id', 
        'morning_checkin',
        'morning_checkout',
        'afternoon_checkin',
        'afternoon_checkout',
        'fine_amount',
        'absences',
        'total_fines'
    ];

    protected $casts = [
        'morning_checkin' => 'boolean',
        'morning_checkout' => 'boolean',
        'afternoon_checkin' => 'boolean',
        'afternoon_checkout' => 'boolean',
        'fine_amount' => 'decimal:2',
        'total_fines' => 'decimal:2'
    ];

    protected $with = ['student', 'event']; // Auto-load relationships

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getFullNameAttribute()
    {
        return $this->student->s_fname . ' ' . $this->student->s_lname;
    }
}
