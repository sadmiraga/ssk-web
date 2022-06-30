@extends('layouts.home')

@section('content')
    <div class="table-responsive">


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Delo</th>
                    <th scope="col">Začetek</th>
                    <th scope="col">Konec</th>
                    <th scope="col">Trajanje</th>
                    <th scope="col">Zaslužek</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $memory = date('Y-m', strtotime($hours[0]->startDate));
                @endphp

                @foreach ($hours as $hour)
                    @php
                        $new = date('Y-m', strtotime($hour->startDate));
                    @endphp


                    @if ($new != $memory || $loop->iteration == 1)
                        <tr class="downloadable">
                            <td>{{ getMonthName($new) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="/prenesi-ure/{{ $userID }}/{{ $new }}">
                                    <button class="btn btn-secondary">Prenesi Ure</button>
                                </a>
                            </td>
                        </tr>

                        @php
                            $memory = $new;
                        @endphp
                    @endif

                    <tr>
                        <td>{{ $hour->shiftType }}</td>
                        <td>{{ $hour->startDate . ' | ' . $hour->startTime }}</td>
                        <td>{{ $hour->endDate . ' | ' . $hour->endTime }}</td>
                        <td>{{ $hour->duration }}</td>
                        <td>{{ round($hour->duration * $user->hour_rate, 2) . ' €' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endsection
