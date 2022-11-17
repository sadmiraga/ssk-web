@extends('layouts.home')

@section('content')
    <div class="events-header mb-3">
        <button onclick="location.href='/dodaj-formo'" class="btn add-button"><span>Dodaj Obrazec</span><i
                class="fas fa-plus"></i></button>
    </div>



    <div class="container w-100 x-auto form-cards-container">
        @foreach ($forms as $form)
            <div class="card form-card mb-4 forms-card-index" id="form-{{ $form->id }}-card">
                <div class="card-header">
                    <div class="card-title">
                        {{ $form->name }}
                    </div>
                </div>
                <ul class="list-group list-group-flush">

                    <li class="list-group-item even">

                        <a target="_blank" class="w-25" href="{{ route('forms.preview', $form->id) }}">
                            <div class="btn btn-warning btn-sm w-100">POGLEJ</div>
                        </a>

                        <a class="w-25" href="/uredi-formo/{{ $form->id }}">
                            <button class="btn btn-sm btn-primary w-100">Uredi</button>
                        </a>

                        <a class="w-25" href="/izbrisi-formo/{{ $form->id }}">
                            <button class="btn btn-sm btn-danger w-100">Izbriši</button>
                        </a>


                    </li>
                </ul>
            </div>
        @endforeach
    </div>
@endsection


@push('js')
    <style>
        .tester {
            color: red;
        }
    </style>
@endpush
