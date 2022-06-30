<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\hoursExport;
use App\Models\User;
use App\Models\Hour;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ShiftsController extends Controller
{
    public function myShifts()
    {

        $user = User::find(Auth::id());

        $hours = Hour::where('user_id', Auth::id())->orderBy('startDate', 'desc')->get();
        //get current month name
        $month = date('Y-m');
        $currentMonth = getMonthName($month);

        //get query hours from this month
        $date = date('Y-m');
        $thisMonthHours = Hour::where('user_id', Auth::id())->where('startDate', 'LIKE', "$date%")->get();

        $hoursCount = 0;
        foreach ($thisMonthHours as $data) {
            $hoursCount = $hoursCount + $data->duration;
        }


        $salary = $hoursCount * $user->hour_rate;
        $months = $this->getMonths();
        return view('admin.shifts.index', compact('hours', 'months', 'currentMonth', 'hoursCount', 'salary', 'user'));
    }

    public function newShift()
    {
        return view('admin.shifts.create');
    }

    public function storeShift(Request $request)
    {
        $request->validate([
            'shift-type' => 'required',
            'start-date' => 'required',
            'start-time' => 'required',
            'end-date' => 'required',
            'end-time' => 'required',
        ]);

        $startDate = $request->input('start-date');
        $startTime = $request->input('start-time');

        $endDate = $request->input('end-date');
        $endTime = $request->input('end-time');

        //date error
        if ($startDate > $endDate) {
            return redirect()->back()->with('error', 'Napaka pri vnosu datuma.');
        }

        //time error
        if ($startTime > $endTime) {
            if ($startDate == $endDate) {
                return redirect()->back()->with('error', 'Napaka pri vnosu časa.');
            }
        }

        $start = strtotime(date('Y-m-d H:i:s', strtotime("$startDate $startTime")));
        $end = strtotime(date('Y-m-d H:i:s', strtotime("$endDate $endTime")));
        $duration = round(abs($start - $end) / 3600, 2);

        $userID = Auth::id();

        $hour = new Hour();
        $hour->shiftType = $request->input('shift-type');
        $hour->startDate = $startDate;
        $hour->startTime = $startTime;
        $hour->endDate = $endDate;
        $hour->endTime = $endTime;
        $hour->user_id = $userID;
        $hour->duration = $duration;
        $hour->save();
        return redirect()->route('hours.myhours')->with('successMessage', 'Uspešno ste zabeležili opravljene ure.');
    }


    public function downloadMyHours($yearMonth)
    {
        $user = Auth::user();

        $pieces = explode('-', $yearMonth);
        $year = $pieces[0];

        $testHours = Hour::where('user_id', $user->id)->where('startDate', 'LIKE', "$yearMonth%")->get();
        if (count($testHours) == 0) {
            return redirect()->back()->with('errorMessage', 'Nimate opravljenih ur v izbranem mesecu');
        }


        $fileName =  $user->firstName . '-' . $user->lastName . '-' . getMonthName($yearMonth) . '-' . $year . '.xlsx';

        return Excel::download(new hoursExport($user->id, $yearMonth), $fileName);
    }


    public function viewShifts($userID)
    {
        $hours = Hour::where('user_id', $userID)->orderBy('startDate', 'desc')->get();
        $user = User::find($userID);

        if (count($hours) == 0) {
            return redirect()->back()->with('errorMessage', 'Izbrani zaposleni nima vnešenih ur');
        }

        return view('admin.shifts.viewShifts', compact('hours', 'userID', 'user'));
    }

    public function downloadExcel($userID, $yearMonth)
    {
        $user = User::find($userID);
        $pieces = explode('-', $yearMonth);
        $year = $pieces[0];
        $fileName =  $user->firstName . '-' . $user->lastName . '-' . getMonthName($yearMonth) . '-' . $year . '.xlsx';
        return Excel::download(new hoursExport($user->id, $yearMonth), $fileName);
    }
}
