@extends('layouts.home')

@section('content')
    <div class="row justify-content-around">

        <div class="card w-75" style="display:flex;justify-content:space-evenly">
            {!! Form::open(['url' => '/uredi-dogodek', 'method' => 'post', 'enctype' => 'multipart/form-data', 'files' => 'true']) !!}
            @csrf
            <input type="hidden" name="eventID" value="{{ $event->id }}">
            <div class="card-body">

                <div class="form-group mb-4 mt-4">
                    <input class="form-control" name="eventName" required placeholder="Vnesite ime dogodka"
                        value="{{ $event->name }}">
                    <small id="emailHelp" class="form-text text-muted">Ime dogodka</small>
                </div>

                <div class="form-group mb-4">
                    <input name="eventDate" required class="form-control" type="date" value="{{ $event->date }}">
                    <small id="emailHelp" class="form-text text-muted">Datum dogodka</small>
                </div>

                <div class="form-group mb-4">
                    <input name="eventTime" required class="form-control" type="time" value="{{ $event->time }}">
                    <small id="emailHelp" class="form-text text-muted">Čas dogodka</small>
                </div>

                <div class="form-group mb-4">
                    <input type="text" name="eventLocation" required class="form-control"
                        placeholder="Vnesite lokacijo dogodka" value="{{ $event->location }}">
                    <small id="emailHelp" class="form-text text-muted">Lokacija</small>
                </div>

                <div class="form-group mb-4">
                    <textarea class="form-control" rows="5" name="eventDescription"
                        placeholder="Vpišite opis dogodka">{{ $event->description }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Opis dogodka</small>
                </div>

                <div class="form-group mb-4 x-auto md-25">
                    <img src="{{ asset('images/events/' . $event->picture) }}" class="img-fluid w-50 x-auto"
                        id="eventImage">

                </div>

                <div class="form-group mb-4">
                    <input id="file-upload" type="file" name="eventPicture" onchange="loadFile(event)" />
                </div>


                <div class="form-group mb-4">
                    <div class="form-row">
                        <label>Vstopnina</label>
                        <input style="width: fit-content !important;margin-left:1rem;" type="checkbox"
                            id="weightableCheckbox" name="ticketCheckbox" class="custom-control-input"
                            onchange="enableWeight();" @if ($event->ticket !== 0) checked @endif>
                    </div>
                </div>

                <div class="form-group mb-4" id="drink-packing-weight-div">
                    <input type="number" name="ticketPrice" id="packingWeight" value="{{ $event->ticket }}"
                        class="form-control" placeholder="Vnesite ceno vstopnine">
                    <small id="emailHelp" class="form-text text-muted">Cena vstopnine</small>
                </div>


                <!-- SUBMIT -->
                <div class="form-group d-flex justify-content-center">
                    <button class="btn btn-success w-100" type="submit">Shrani</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>


    </div>
@endsection

@push('js')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('eventImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        window.addEventListener('load', (event) => {


            var ticketCheckbox = document.getElementById("packingWeight");

            enableWeight();

        });

        function enableWeight() {
            weightableCheckbox = document.getElementById("weightableCheckbox");
            packingWeight = document.getElementById("packingWeight");

            if (weightableCheckbox.checked == true) {
                weightableCheckboxContainer = document.getElementById("drink-packing-weight-div").style.display = "block";
                packingWeight.required = true;
            } else {
                weightableCheckboxContainer = document.getElementById("drink-packing-weight-div").style.display = "none";
                packingWeight.required = false;
            }
        }
    </script>
@endpush
