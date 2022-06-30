<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Form;
use App\Models\Application;
use App\Models\Email;

class GuestController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('guest.index', compact('events'));
    }

    public function apply($eventID)
    {
        $event = Event::find($eventID);

        if ($event->form_id != null) {
            $form = Form::find($event->form_id);
            $inputs = convertToArray($form->inputs);
        } else {
            $form = null;
            $inputs = null;
        }


        return view('guest.apply', compact('event', 'inputs', 'event', 'form'));
    }

    public function saveApply(Request $request)
    {



        $application =  new Application();
        $application->form_id = $request->input('formID');
        $application->event_id = $request->input('eventID');

        $form = Form::find($request->input('formID'));
        $inputs = convertToArray($form->inputs);
        $data = "";

        foreach ($inputs as $input) {
            $chunk = $request->input($input['name']);

            if ($data != "") {
                $data = $data . ',' . $chunk;
            } else {
                $data = $chunk;
            }


            if ($input['type'] == 'email') {
                if ($request->input('newsletter')) {
                    $mail = new Email();
                    $mail->event_id = $request->input('eventID');
                    $mail->email = $chunk;
                    $mail->save();
                }
            }
        }

        $application->inputs = $data;
        $application->save();


        return view('guest.thankyou');
    }
}
