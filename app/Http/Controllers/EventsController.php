<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

use App\Models\Event;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'eventPicture' => 'required'
        ]);



        $event = new Event();
        $event->name = $request->input('eventName');
        $event->date = $request->input('eventDate');
        $event->time = $request->input('eventTime');
        $event->location = $request->input('eventLocation');
        $event->description = $request->input('eventDescription');

        $ticketCheckbox = $request->input('ticketCheckbox');

        if ($ticketCheckbox != null) {
            $event->ticket = $request->input('ticketPrice');
        }

        //get image from form
        $image = $request->file('eventPicture');

        //make name for image
        $var = date_create();
        $time = date_format($var, 'YmdHis');
        $imageName = $time . '-' . $request->input('eventName') . $image->getClientOriginalName();

        $event->picture = $imageName;

        //move image
        $image->move(public_path('images/events'), $imageName);

        $event->save();

        return redirect('/dogodki')->with('successMessage', 'Uspesno ste dodali dogodek');
    }
}
