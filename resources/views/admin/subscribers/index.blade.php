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
                    <td class="d-flex justify-content-end"><button class="btn btn-outline-secondary">Zgodovina prijav</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
