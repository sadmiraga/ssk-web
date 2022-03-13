@extends('layouts.home')

@section('content')
    <div class="events-header mb-3">

        <button onclick="location.href='/dodaj-dogodek'" class="btn add-button"><span>Dodaj dogodek</span><i
                class="fas fa-plus"></i></button>

    </div>




    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
        @foreach ($events as $event)
            <div class="col mb-4">
                <div class="card event-card">

                    <div class="card-img-top event-card-image"
                        style="background-image: url('{{ asset('/images/events/' . $event->picture) }}');">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title admin-event-title">{{ $event->name }}</h5>
                        <p class="card-text admin-event-description">{{ $event->description }}</p>


                        <div class="row button-row">
                            <button class="btn custom-button">Već</button>
                            <button class="btn custom-button">Uredi</button>

                        </div>

                        <div class="row button-row">
                            <button class="btn custom-button">Povezava</button>
                            <button class="btn custom-button">Izbriši</button>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
