@extends('layouts.home')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Prijavljen/a na dogodek</th>
                <th scope="col"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscribers as $subscriber)
                <tr>
                    <td>{{ $subscriber }}</td>
                    <td>{{ getEventName($subscriber) }}</td>
                    <td class="d-flex justify-content-end">
                        <a href="{{ route('subscribers.applicationHistory', $subscriber) }}">
                            <button class="btn btn-outline-secondary">Zgodovina prijav</button>
                        </a>

                        <a href="{{ route('subscribers.delete', $subscriber) }}">
                            <button class="btn btn-outline-secondary">Izbrisi</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
