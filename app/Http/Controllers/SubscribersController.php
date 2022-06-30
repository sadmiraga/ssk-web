<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Email;
use App\Models\Event;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Email::distinct('email')->pluck('email');
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function delete($email)
    {
        $subscriber = Email::where('email', $email)->delete();
        return redirect()->back();
        return $email;
    }

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

    public function inviteSubscriber($eventID)
    {
        $subscribers = Email::all();
        $event = Event::find($eventID);
        return view('admin.subscribers.inviteSubscriber', compact('subscribers', 'event'));
    }

    public function sendInvitations(Request $request)
    {
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
            return redirect()->back()->with('message', 'Oznacite vsaj en email');
        }

        dd($emails);
    }
}
