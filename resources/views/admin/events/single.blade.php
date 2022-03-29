@extends('layouts.home')

@section('content')
    <div class="row justify-content-around">


        <div class="container-md row justify-content-center">

            <!-- info card -->
            <div class="card w-75 x-auto p-0">
                <div class="card-img-top event-card-image"
                    style="background-image: url('{{ asset('/images/events/' . $event->picture) }}');">
                </div>
                <h2 class="display-6 text-secondary text-center">{{ $event->name }}</h2>
                <div class="row">
                    <span>Datum</span>
                    <span>{{ $event->date }}</span>
                </div>
                <div class="row">
                    <span>Čas</span>
                    <span>{{ $event->time }}</span>
                </div>
                <div class="row">
                    <span>Lokacija</span>
                    <span>{{ $event->location }}</span>
                </div>
                <a href="/uredi-dogodek/{{ $event->id }}">
                    <button class="btn btn-primary">Uredi</button>
                </a>
            </div>

            <!-- form card -->
            <div class="card w-75 x-auto p-0 mt-3">
                <div class="card-header">
                    <div class="card-title" style="display:flex;justify-content:space-between">
                        <span>Obrzaec za prijavo na dogodek</span>
                        <a href="#myCollapse" data-bs-toggle="collapse">
                            <button class="btn btn-primary">Več</button>
                        </a>
                    </div>
                </div>

                <div id="myCollapse" class="card-body collapse show">
                    @foreach ($inputs as $input)
                        <div class="form-group mb-3">

                            <label for="{{ $loop->iteration }}">{{ $input['name'] }}</label>

                            <input type="{{ $input['type'] }}" name="{{ $input['name'] }}"
                                placeholder="{{ $input['description'] }}" class="form-control"
                                id="{{ $loop->iteration }}">
                        </div>
                    @endforeach


                    <button onclick="location.href='/doloci-formo/{{ $event->id }}'" type="button"
                        class="btn btn-outline-secondary">Izberi drugo
                        formo</button>

                    <button href="/doloci-formo/{{ $event->id }}" type="button" class="btn btn-outline-secondary">Naredi
                        novo
                        forma</button>

                </div>
            </div>

            <!-- form card -->
            <div class="card w-75 x-auto p-0 mt-3">
                <div class="card-header">
                    <div class="card-title" style="display:flex;justify-content:space-between">
                        <span>Prijavljeni na dogodek</span>
                        <a href="#attendees" data-bs-toggle="collapse">
                            <button class="btn btn-primary">Več</button>
                        </a>
                    </div>
                </div>

                <div id="attendees" class="card-body collapse show">

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                @foreach ($inputs as $input)
                                    <th> {{ $input['name'] }} </th>
                                @endforeach
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


        </div>






    </div>
@endsection
