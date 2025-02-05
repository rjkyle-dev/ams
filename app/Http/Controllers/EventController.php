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
        date_default_timezone_set('Asia/Manila');
        $fields['date'] = Carbon::now();
        $fields['admin_id'] = Auth::user()->id;
        Event::create($fields);

        return back()->with(["success" => "Event created successfully"]);
    }

    public function view()
    {
        $events = Event::all();
        return view('pages.events', compact('events'));
    }

    public function delete(Request $request)
    {
        dd('deleting events');
    }
    public function update(Request $request)
    {
        dd('updating events');
    }
}
