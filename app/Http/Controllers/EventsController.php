<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

use App\Models\Event;
use App\Models\Form;
use App\Models\Application;

class EventsController extends Controller
{

    //INDEX
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    //CREATE
    public function create()
    {
        return view('admin.events.create');
    }

    //CREATE - STORE
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
            $event->ticketPrice = $request->input('ticketPrice');
            $event->specialTicketPrice = $request->input('specialTicketPrice');
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

        return redirect("/doloci-formo/$event->id")->with('successMessage', 'Uspesno ste dodali dogodek');
    }

    public function delete($eventID)
    {
        $event = Event::find($eventID);
        $event->delete();
        return redirect()->back();
    }

    public function edit($eventID)
    {
        $event = Event::find($eventID);

        if ($event->form_id == null) {
            $inputs = null;
            $form = null;
        } else {
            $form = Form::find($event->form_id);
            $inputs = convertToArray($form->inputs);
        }

        return view('admin.events.edit', compact('event', 'inputs', 'form'));
    }

    public function storeEdit(Request $request)
    {
        $request->validate([
            'eventName' => 'required',
            'eventDate' => 'required',
            'eventTime' => 'required',
            'eventLocation' => 'required',
            'eventDescription' => 'required',
            'eventID' => 'required'
        ]);

        $event = Event::find($request->input('eventID'));
        $event->name = $request->input('eventName');
        $event->date = $request->input('eventDate');
        $event->time = $request->input('eventTime');
        $event->location = $request->input('eventLocation');
        $event->description = $request->input('eventDescription');

        $ticketCheckbox = $request->input('ticketCheckbox');
        if ($ticketCheckbox != null) {
            $event->ticketPrice = $request->input('ticketPrice');
            $event->specialTicketPrice = $request->input('specialTicketPrice');
        } else {
            $event->ticketPrice = null;
            $event->specialTicketPrice = null;
        }

        $image = $request->file('eventPicture');

        if ($image != null) {
            $var = date_create();
            $time = date_format($var, 'YmdHis');
            $imageName = $time . '-' . $request->input('eventName') . $image->getClientOriginalName();

            $event->picture = $imageName;

            //move image
            $image->move(public_path('images/events'), $imageName);
        }

        $event->save();

        return redirect()->route('events.single', $event->id);
    }

    public function setForm($eventID)
    {
        $forms = Form::all();
        return view('admin.events.setForm', compact('forms', 'eventID'));
    }

    public function setFormExe(Request $request)
    {
        $event = Event::find($request->input('eventID'));
        $event->form_id = $request->input('formID');
        $event->save();
        $route = '/dogodek/' . $event->id;
        return redirect($route);
    }

    public function single($eventID)
    {
        $event = Event::find($eventID);
        $form = Form::find($event->form_id);

        if ($form != null) {
            $inputs = convertToArray($form->inputs);
        } else {
            $form = null;
            $inputs = null;
        }


        $applications = Application::where('event_id', $event->id)->get();

        return view('admin.events.single', compact('event', 'inputs', 'form', 'applications'));
    }
}
