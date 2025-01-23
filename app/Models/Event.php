<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;


    protected $fillable = [
        "event_name",
        "date",
        "checkIn_start",
        "checkIn_end",
        "checkOut_start",
        "checkOut_end",
        "admin_id",
    ];
}
