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


function getMonthName($monthIndex)
{
    //dd($monthIndex);

    $payload = explode('-', $monthIndex);

    $monthIndex = intval($payload[1]);

    switch ($monthIndex) {
        case 1:
            return 'Januar';
            break;
        case 2:
            return 'Februar';
            break;
        case 3:
            return 'Mart';
            break;
        case 4:
            return 'April';
            break;
        case 5:
            return 'Maj';
            break;
        case 6:
            return 'Junij';
            break;
        case 7:
            return 'Julij';
            break;
        case 8:
            return 'Avgust';
            break;
        case 9:
            return 'September';
            break;
        case 10:
            return 'Oktober';
            break;
        case 11:
            return 'November';
            break;
        case 12:
            return 'December';
            break;
    }
}


function range_date($first, $last)
{
    $arr = array();
    $now = strtotime($first);
    $last = strtotime($last);

    while ($now <= $last) {
        $arr[] = date('Y-m-d', $now);
        $now = strtotime('+1 day', $now);
    }

    return $arr;
}


function convertDateForExcel($date)
{
    $strDate = strval($date);

    $pieces = explode('-', $strDate);

    $excelDate = $pieces[2] . '.' . $pieces[1] . '.' . $pieces[0];
    return $excelDate;
}

function dayToSlo($day)
{
    switch ($day) {
        case 'Monday':
            return 'Ponedeljek';

        case 'Tuesday':
            return 'Torek';

        case 'Wednesday':
            return 'Sreda';

        case 'Thursday':
            return 'Četrtek';

        case 'Friday':
            return 'Petek';

        case 'Saturday':
            return 'Sobota';

        case 'Sunday':
            return 'Nedelja';
    }
}

function cutTimeStamp($time)
{
    $strTime = strval($time);
    $new =  rtrim($strTime, "0");
    $newer = rtrim($new, ':');
    return $newer;
}
