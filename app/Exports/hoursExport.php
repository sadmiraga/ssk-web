<?php

namespace App\Exports;

use App\Models\Hour;
use App\Models\User;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;



class hoursExport implements FromView
{
    use Exportable;

    private $userID;
    private $yearMonth;
    private $hours;
    private $name;
    private $monthName;
    private $timespan;
    private $range;

    public function __construct($userID, $yearMonth)
    {

        $user = User::find($userID);

        $this->userID = $userID;
        $this->yearMonth = $yearMonth;
        $this->hours = Hour::where('user_id', $userID)->where('startDate', 'LIKE', "$yearMonth%")->get();
        $this->name = $user->firstName . ' ' . $user->lastName;
        $this->monthName = getMonthName($yearMonth);
        $this->range = range_date(date('Y-m-01', strtotime($yearMonth)), date('Y-m-t', strtotime($yearMonth)));
        $this->hour_rate = $user->hour_rate;

        $start = date('Y-m-t', strtotime($yearMonth));
        $start = explode('-', $start);
        $this->timespan = '01.' . $start[1] . '.' . $start[0] . ' - ' . $start[2] . '.' . $start[1] . '.' . $start[0];
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.hours', [
            'userID' => $this->userID,
            'hours' => $this->hours,
            'name' => $this->name,
            'monthName' => $this->monthName,
            'timespan' => $this->timespan,
            'range' => $this->range,
            'hour_rate' => $this->hour_rate,
        ]);
    }
}
