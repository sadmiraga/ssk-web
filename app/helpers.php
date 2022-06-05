<?php

use App\Models\Application;
use App\Models\Event;


function cutDescription($description)
{
    $data = substr($description, -100);
    $data = $data . ' ...';
    return $data;
}

function numberOfApplications($eventID)
{
    $event = Event::find($eventID);

    if ($event->form_id == null) {
        return 'Ni določene forme za prijavo';
    } else {
        $applications = Application::where('form_id', $event->form_id)->where('event_id', $event->id)->get();
        $message =  'Prijavljenih: ' . count($applications);
        return $message;
    }
}

function getEventName($email)
{
    $application = Application::where('inputs', 'LIKE', '%' . $email . '%')->get();
    $event = Event::find($application[0]->event_id);
    return $event->name;
}

function convertToArray($fields)
{
    $finalFields = [];
    $chars = explode("[", $fields);

    foreach ($chars as $char) {
        if ($char != null) {

            $rawInputs = explode(",", $char);

            $inputs = [
                "name" => $rawInputs[0],
                "type" => $rawInputs[1],
                "description" =>  rtrim($rawInputs[2], "]")
            ];

            array_push($finalFields, $inputs);
        }
    }
    return collect($finalFields);
}


function translateInputType($input)
{
    switch ($input) {
        case 'password':
            return 'Geslo';
        case 'email':
            return 'Elektronski naslov';
        case 'text':
            return 'Besedilo';
        case 'number':
            return 'Številka';
        case 'file':
            return 'Datoteka';
    }
}
