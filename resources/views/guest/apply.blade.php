@extends('layouts.guest')
@section('content')
    <div class="jumbotron" style="margin-top:-20%;">
        <div class="w-100 apply-cover-image"
            style="background-image: url('{{ asset('/images/events/' . $event->picture) }}');">
        </div>
    </div>

    <form action="/prijava" method="post" >
    @csrf
    <div class="apply-container">
        @foreach ($inputs as $input)
            <div class="form-group mb-3">
                <input required class="event-apply-input form-control" type="{{ $input['type'] }}" name="{{ $input['name'] }}"
                    placeholder="{{ $input['description'] }}">
            </div>
        @endforeach

        <input type="hidden" value="{{$event->id}}" name="eventID">
        <input type="hidden" value="{{$form->id}}" name="formID">
        <input type="submit" value="PRIJAVA" class="btn btn-warning w-100">PRIJAVA</button>

    </div>
    </form>


@endsection
