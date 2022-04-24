@extends('layouts.home')

@section('content')
    <div class="row justify-content-around">


        <div class="container-md row justify-content-center">

            <!-- info card -->
            <div class="card w-50 x-auto p-0 mt-3">

                <img src="{{ asset('images/events/' . $event->picture) }}" class="img-fluid w-100">

                <h2 class="display-6 text-secondary text-center">{{ $event->name }}</h2>
                <div class="row event-info-row">
                    <span>Datum</span>
                    <span>{{ $event->date }}</span>
                </div>
                <div class="row event-info-row">
                    <span>Čas</span>
                    <span>{{ $event->time }}</span>
                </div>
                <div class="row event-info-row">
                    <span>Lokacija</span>
                    <span>{{ $event->location }}</span>
                </div>
                <a href="/uredi-dogodek/{{ $event->id }}" class="mt-4 mb-4">
                    <button class="btn btn-outline-secondary w-50 mt-6"
                        style="margin-left:25%;margin-right:25%;">Uredi</button>
                </a>
            </div>

            <!-- form card -->
            <div class="card w-50 x-auto p-0 mt-3" style="margin-left:1rem;margin-right:1rem;">
                <div class="card-header" style="background:white;">
                    <div class="card-title custom-card-title">
                        <span class="card-title-text">Obrzaec za prijavo na dogodek</span>
                        <a href="#myCollapse" data-bs-toggle="collapse">
                            <button class="btn btn-outline-light">
                                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd">
                                    <path
                                        d="M23.245 4l-11.245 14.374-11.219-14.374-.781.619 12 15.381 12-15.391-.755-.609z" />
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>

                <div id="myCollapse" class="card-body collapse">

                    @if ($inputs != null)
                        @foreach ($inputs as $input)
                            <div class="form-group mb-3">
                                <label for="{{ $loop->iteration }}">{{ $input['name'] }}</label>
                                <input type="{{ $input['type'] }}" name="{{ $input['name'] }}"
                                    placeholder="{{ $input['description'] }}" class="form-control"
                                    id="{{ $loop->iteration }}">
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

            <h4 class="display-7 text-center mt-5 mb-3">Prijavljeni na dogodek</h4>
            <button class="btn btn-outline-secondary w-25 mt-6">Povabi naročnike</button>

            <table class="table table-striped table-hover">
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



        </div>






    </div>
@endsection
