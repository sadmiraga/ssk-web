@extends('layouts.home')
@section('content')
    <x-alert-component />

    <div class="events-header" style="justify-content:center;">
        <a href="{{ route('hours.add') }}">
            <div class="custom-action-button">
                <i class="fas fa-plus"></i>
            </div>
        </a>
    </div>

    <div class="excel-wrapper month-info">
        <h4>{{ $currentMonth }}</h4>
        <div class="row salary-info">
            <div class="col salary-cell">Narejene ure: {{ $hoursCount }}</div>
            <div class="col salary-cell">Urna postava: {{ $user->hour_rate }}</div>
            <div class="col salary-cell">Zaslužek: {{ $salary . '€' }}</div>
        </div>

    </div>

    <div class="row excel-wrapper">
        @foreach ($months as $month)
            <div class="col excel-container" onclick="location.href='/prenesi-moje-ure/{{ $month }}'">
                <img src="/images/icons/excel.png" class="excel-icon">
                <p class="excel-month-name">{{ getMonthName($month) }}</p>
            </div>
        @endforeach
    </div>

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
                @foreach ($hours as $hour)
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
    </div>
@endsection
