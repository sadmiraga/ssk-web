<?php

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
