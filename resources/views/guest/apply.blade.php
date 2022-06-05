@extends('layouts.guest')

@section('content')
    <div class="jumbotron">
        <div class="w-100 apply-cover-image"
            style="background-image: url('{{ asset('/images/events/' . $event->picture) }}');">
        </div>
    </div>

    <div class="w-100 event-info">
        <h1 class="text-white text-center">{{ $event->name }}</h4>

            <p class="row d-flex justify-content-between event-row-info">
                <span class="text-white w-auto ">Lokacija</span>
                <span class="text-white w-auto ">{{ $event->location }}</span>
            </p>

            <p class="row d-flex justify-content-between event-row-info">
                <span class="text-white w-auto ">Čas</span>
                <span class="text-white w-auto ">{{ date('H:i', strtotime($event->time)) }}</span>
            </p>


            @if (!is_null($event->ticketPrice))
                <p class="row d-flex justify-content-between event-row-info">
                    <span class="text-white w-auto ">Vstopnina</span>
                    <span class="text-white w-auto ">{{ $event->ticketPrice . '€' }}</span>
                </p>
            @endif

            @if (!is_null($event->specialTicketPrice))
                <p class="row d-flex justify-content-between event-row-info">
                    <span class="text-white w-auto ">Vstopnina za ŠŠK člane</span>
                    <span class="text-white w-auto ">{{ $event->specialTicketPrice . '€' }}</span>
                </p>
            @endif

            <p class="row d-flex justify-content-center">
            <p class="text-white w-auto text-center">{{ $event->description }}</p>
            </p>
    </div>



    @if (!is_null($event->form_id))
        <div class="mt-4 apply-form-container">
            <h1 class="text-white text-center">PRIJAVA</h4>
                <form action="/prijava" method="post">
                    @csrf
                    <div class="apply-container">
                        @foreach ($inputs as $input)
                            <div class="form-group mb-3">
                                <input required class="event-apply-input form-control" type="{{ $input['type'] }}"
                                    name="{{ $input['name'] }}" placeholder="{{ $input['description'] }}">
                            </div>
                        @endforeach

                        <input type="hidden" value="{{ $event->id }}" name="eventID">
                        <input type="hidden" value="{{ $form->id }}" name="formID">
                        <input type="submit" value="PRIJAVA" class="btn btn-warning w-100">PRIJAVA</button>

                    </div>
                </form>
        </div>
    @endif


@endsection
