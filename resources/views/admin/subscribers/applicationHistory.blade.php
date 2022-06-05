@extends('layouts.home')

@section('content')
    <h1>Zgodovina prijav za: {{ $email }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th scope="col">Ime dogodka</th>
                <th scope="col">Datum dogodka</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>
                        <img width="50" src="{{ asset('/images/events/' . $event->picture) }}">
                    </td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
