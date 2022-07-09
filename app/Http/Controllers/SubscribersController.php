<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Email;
use App\Models\Event;
use App\Models\Subscriber;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class SubscribersController extends Controller
{

    //list all subscribers
    public function index()
    {
        $subscribers = Email::distinct('email')->pluck('email');
        return view('admin.subscribers.index', compact('subscribers'));
    }

    //delete subscriber
    public function delete($email)
    {
        $subscriber = Email::where('email', $email)->delete();
        return redirect()->back();
        return $email;
    }

    //look at all events that subscriber applied
    public function applicationHistory($email)
    {
        $applications = Application::where('inputs', 'LIKE', '%' . $email . '%')->get();
        $eventIDs = [];
        foreach ($applications as $application) {
            array_push($eventIDs, $application->event_id);
        }
        $events = Event::whereIn('id', $eventIDs)->get();
        return view('admin.subscribers.applicationHistory', compact(['events', 'email']));
    }

    //invite subscriber on event
    public function inviteSubscriber($eventID)
    {
        $subscribers = Email::all();
        $event = Event::find($eventID);
        return view('admin.subscribers.inviteSubscriber', compact('subscribers', 'event'));
    }

    public function sendInvitations(Request $request)
    {

        $event = Event::find($request->input('eventID'));
        $message = $request->input('message');
        $subject = $request->input('subject');

        $base =  "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $base = $this->strSplit($base, 3, '/');
        $image = $base[0] . ':8000/images/events/' . $event->picture;



        //get all emails
        $limit = $request->input('limit');
        $emails = [];

        for ($i = 1; $i <= $limit; $i++) {
            $input_name = 'emails-' . $i;
            $checkbox = $request->input($input_name);

            if ($checkbox != null) {
                array_push($emails, $checkbox);
            }
        }

        if (count($emails) == 0) {
            return redirect()->back()->with('message', 'Oznacite vsaj eden elektronski naslov');
        }

        foreach ($emails as $email) {
            Mail::to($email)->send(new SendMailable($message, $event->name, $image, $subject));
        }

        return 'success';
    }


    private function strSplit($source, $index, $delim)
    {
        $outStr[0] = $source;
        $outStr[1] = '';

        $partials = explode($delim, $source);

        if (isset($partials[$index]) && strlen($partials[$index]) > 0) {
            $splitPos = strpos($source, $partials[$index]);

            $outStr[0] = substr($source, 0, $splitPos - 1);
            $outStr[1] = substr($source, $splitPos);
        }

        return $outStr;
    }
}
