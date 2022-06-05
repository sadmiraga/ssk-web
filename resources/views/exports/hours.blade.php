<table>
    <thead>

        <?php
        $exist = false;
        ?>


        <!-- evidenca dela -->
        <tr>
            <th style="background:lightgray;"></th>
            <th style="width: 200%;background:lightgray;">EVIDENCA DELA</th>
            <th style="background:lightgray;border-right:1px solid black;"></th>
        </tr>

        <!-- empty -->
        <tr>
            <td style="background:lightgray;"></td>
            <td style="background:lightgray;"></td>
            <th style="background:lightgray;"></th>
        </tr>

        <tr>
            <th style="background:lightgray;">a ) MLADINSKI CENTER VELENJE</th>
            <th style="background:lightgray;"></th>
            <th style="background:lightgray;"></th>
        </tr>

        <tr>
            <th style="background:lightgray;">b ) ZAVOD MLADINE ŠALEŠKE DOLINE</th>
            <th style="background:lightgray;"></th>
            <th style="background:lightgray;"></th>
        </tr>

        <tr>
            <th style="background:lightgray;">c ) ŠALEŠKI ŠTUDENTSKI KLUB </th>
            <th style="background:lightgray;"></th>
            <th style="background:lightgray;"></th>
        </tr>


        <tr></tr>

        <tr>
            <td style="width:200%;background:lightgray;">IME IN PRIIMEK</td>
            <td style="width:200%;background:lightgray;">{{ $name }}</td>
            <th style="background:lightgray;"></th>
        </tr>

        <tr></tr>

        <tr>
            <td style="width:200%;background:lightgray;">VRSTA DEL/A</td>
            <td style="width:200%;background:lightgray;">{{ $hours[0]->shiftType }}</td>
            <th style="background:lightgray;"></th>
        </tr>

        <tr></tr>

        <tr>
            <td style="width:200%;background:lightgray;">MESEC</td>
            <td style="width:200%;background:lightgray;">{{ $monthName }}</td>
            <td style="width:200%;background:lightgray;">{{ $timespan }}</td>
        </tr>

        <tr></tr>


    </thead>
    <tbody>

        <!-- HOURS HEADING -->
        <tr>
            <td style="background:#a5a5a5;">Datum</td>
            <td style="background:#a5a5a5;">Dan</td>
            <td style="background:#a5a5a5;">Ura Prihoda</td>
            <td style="width:200%;background:#a5a5a5;">Ura Odhoda</td>
            <td style="width:200%;background:#a5a5a5;">URE</td>
            <td style="width:200%;background:#a5a5a5;">VRSTA DELA</td>
        </tr>


        @foreach ($range as $date)
            <?php
            $realLoop = $loop->iteration;
            $exist = false;
            ?>

            <tr>
                <td
                    @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                    {{ convertDateForExcel($date) }}</td>
                <td
                    @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                    {{ dayToSlo(date('l', strtotime($date))) }}</td>


                @foreach ($hours as $hour)
                    @if ($hour->startDate == $date)
                        <?php
                        $exist = true;
                        ?>

                        <td
                            @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                            {{ cutTimeStamp($hour->startTime) }}</td>
                        <td
                            @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                            {{ cutTimeStamp($hour->endTime) }}</td>
                        <td
                            @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                            {{ $hour->duration }}</td>
                        <td
                            @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                            {{ $hour->shiftType }}</td>
                    @endif
                @endforeach


                @if ($exist != true)
                    <td
                        @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                    </td>
                    <td
                        @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                    </td>
                    <td
                        @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                    </td>
                    <td
                        @if ($realLoop % 2 == 0) style="background:lightgray;" @else style="background:#e2e2e2;" @endif>
                    </td>
                @endif


            </tr>
        @endforeach

        <tr></tr>

        <tr>
            <td style="width:300%;background:#a5a5a5;">Urna postavka</td>
            <td style="background:#a5a5a5;">{{ $hour_rate . '€' }}</td>
            <td style="background:#a5a5a5;">Skupaj Ure:</td>
            <td style="background:#a5a5a5;">{{ $hours->sum('duration') }}</td>
        </tr>


        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td
                style="background:#a5a5a5;border-top:3px solid black;border-bottom:3px solid black;border-left:3px solid black;">
                Izplačilo</td>
            <td
                style="background:#a5a5a5;;border-top:3px solid black;border-bottom:3px solid black;border-right:3px solid black;">
                {{ round($hours->sum('duration') * $hour_rate, 2) . ' €' }}</td>
        </tr>


        <tr>
            <td style="width:200%;border:1px solid black;background:#a5a5a5">ODOBRIL</td>
            <td style="background:lightgray;"></td>
            <td style="width:200%;border:1px solid black;background:#a5a5a5">DATUM</td>
            <td style="background:lightgray;"></td>
        </tr>





    </tbody>
</table>
