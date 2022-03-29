<?php

namespace App\Helpers;

class Helper
{

    function getData($inputs){
        dd($inputs);
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
                    "description" => $rawInputs[2]
                ];

                array_push($finalFields, $inputs);
            }
        }

        return collect($finalFields);
    }
}
