<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create(Request $request)
    {
        $fields = $request->validate([
            "event_name" => ['required'],
            "checkIn_start" => ['required', "date_format:H:i"],
            "checkIn_end" => ['required', "date_format:H:i", "after:checkIn_start"],
            "checkOut_start" => ['required', "date_format:H:i", "after:checkIn_end"],
            "checkOut_end" => ['required', "date_format:H:i", "after:checkOut_start"],
        ]);
        $fields['date'] = Carbon::now();
        $fields['admin_id'] = Auth::user()->id;
        Event::create($fields);

        return back()->with(["successful" => "Event created successfully"]);
    }

    public function view()
    {
        return view('pages.events');
    }
}
