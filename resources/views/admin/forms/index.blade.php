@extends('layouts.home')

@section('content')
    <div class="events-header mb-3">

        <button onclick="location.href='/dodaj-formo'" class="btn add-button"><span>Dodaj Formo</span><i
                class="fas fa-plus"></i></button>

    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
        @foreach ($forms as $form)
            @php
                $inputs = convertToArray($form->inputs);
            @endphp

            <div class="col mb-4">
                <div class="card">

                    <div class="card-header">
                        <div class="card-title">
                            {{ $form->name }}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            @foreach ($inputs as $input)
                                <div class="form-group w-100 mb-4">
                                    <label>{{ $input['name'] . ' (' . translateInputType($input['type']) . ')' }}</label>
                                    <input class="form-control" type="{{ $input['type'] }}"
                                        placeholder="{{ $input['description'] }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="row form-button-row">

                            <a class="w-50" href="/uredi-formo/{{ $form->id }}">
                                <button class="btn btn-sm btn-primary w-100">Uredi</button>
                            </a>

                            <a class="w-50" href="/izbrisi-formo/{{ $form->id }}">
                                <button class="btn btn-sm btn-danger w-100">Izbriši</button>
                            </a>

                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
