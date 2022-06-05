@extends('layouts.home')

@section('content')
    <div class="row justify-content-around">


        <div class="container-md row justify-content-center">

            <!-- info card -->
            <div class="card x-auto p-0 mt-3 admin-event-card">

                <img src="{{ asset('images/events/' . $event->picture) }}" class="img-fluid w-100">

                <h2 class="display-6 text-secondary text-center">{{ $event->name }}</h2>

                <hr>

                <div class="row event-info-row">
                    <span class="w-50 right-text">Datum</span>
                    <span class="w-50">{{ $event->date }}</span>
                </div>
                <div class="row event-info-row">
                    <span class="w-50 right-text">Čas</span>
                    <span class="w-50">{{ $event->time }}</span>
                </div>

                <div class="row event-info-row">
                    <span class="w-50 right-text">Lokacija</span>
                    <span class="w-50">{{ $event->location }}</span>
                </div>

                <div class="row event-info-row">
                    <span class="w-50 right-text">Cena karte</span>
                    <span class="w-50">{{ $event->ticketPrice }}€</span>
                </div>

                <div class="row event-info-row">
                    <span class="w-50 right-text">Cena karte za ŠŠK člane</span>
                    <span class="w-50"> {{ $event->specialTicketPrice }}€</span>
                </div>

                <hr>

                <div class="row event-info-row">
                    <span class="w-75 text-center">{{ cutDescription($event->description) }} <a
                            href="{{ route('event.apply', $event->id) }}">več</a></span>
                </div>

                <hr>


                <a href="/uredi-dogodek/{{ $event->id }}" class="mt-4 mb-4">
                    <button class="btn btn-outline-secondary w-50 mt-6"
                        style="margin-left:25%;margin-right:25%;">Uredi</button>
                </a>
            </div>

            <!-- form card -->
            <div class="card x-auto p-0 mt-3 form-event-card" style="margin-left:1rem;margin-right:1rem;">
                <div class="card-header" style="background:white;">
                    <div class="card-title custom-card-title w-100 mb-0">
                        <span class="card-title-text">Obrazec za prijavo na dogodek</span>

                    </div>
                </div>

                <div id="myCollapse" class="card-body collapse show">
                    <!-- display form if assigned -->
                    @if ($inputs != null)
                        @foreach ($inputs as $input)
                            <div class="form-group mb-3">
                                <label for="{{ $loop->iteration }}">{{ $input['name'] }}</label>
                                <input autocomplete="off" disabled type="{{ $input['type'] }}"
                                    name="{{ $input['name'] }}" placeholder="{{ $input['description'] }}"
                                    class="form-control" id="{{ $loop->iteration }}">
                            </div>
                        @endforeach
                    @endif


                    <div class="row row justify-content-center">
                        <a class="w-auto" href="{{ route('events.setForm', $event->id) }}">
                            <button onclick="location.href='/doloci-formo/{{ $event->id }}'" type="button"
                                class="btn btn-outline-secondary">Izberi drugo
                                formo</button>
                        </a>
                        <a class="w-auto" href="{{ route('forms.create') }}">
                            <button href="{{ route('forms.create') }}" type="button" class="btn btn-outline-secondary">
                                Naredi novo formo
                            </button>
                        </a>
                    </div>
                </div>
            </div>



            <div class="card x-auto w-100 p-0 mt-3 admin-event-card">
                <h4 class="display-7 text-center mt-5 mb-3">Prijavljeni na dogodek</h4>


                <table class="table table-hover">
                    <thead>
                        <tr>
                            @if ($inputs != null)
                                @foreach ($inputs as $input)
                                    <th> {{ $input['name'] }} </th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <?php
                            $data = explode(',', $application->inputs);
                            ?>
                            <tr>
                                @foreach ($data as $d)
                                    <td>{{ $d }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a class="w-50" style="margin-right:25%;margin-left:25%;"
                    href="{{ route('events.invite-subscriber', $event->id) }}">
                    <button class="btn btn-outline-secondary w-100 mt-6">Povabi naročnike</button>
                </a>
            </div>

        </div>




    </div>
@endsection
