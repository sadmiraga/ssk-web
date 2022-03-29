@extends('layouts.guest')
@section('content')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
        @foreach ($events as $event)
            <div class="col mb-4">
                <div class="event-container">
                    <h2 class="event-heading">{{ $event->name }}</h2>
                    <div class="event-image img-fluid"
                        style="background-image: url('{{ asset('/images/events/' . $event->picture) }}');"></div>

                    <button onclick="location.href='/prijava/{{ $event->id }}'"
                        class="btn prijava-button">PRIJAVA</button>
                </div>

            </div>
        @endforeach
    </div>
@endsection
