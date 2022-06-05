<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getMonths()
    {
        $months = [];
        $thisMonth = date('Y-m');
        $lastMonth = date('Y-m', strtotime(date('Y-m') . " -1 month"));
        $monthBefore = date('Y-m', strtotime(date('Y-m') . " -2 month"));

        array_push($months, $thisMonth);
        array_push($months, $lastMonth);
        array_push($months, $monthBefore);

        return $months;
    }
}
