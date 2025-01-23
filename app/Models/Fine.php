<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    /** @use HasFactory<\Database\Factories\FineFactory> */
    use HasFactory;

    protected $fillable = [
        "attendance_id",
        "fines",
        "morning_checkIn",
        "morning_checkOut",
        "afternoon_checkIn",
        "afternoon_checkOut",
    ];
}
