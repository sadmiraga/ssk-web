@extends('layouts.home')

@section('content')
    {!! Form::open(['url' => '/dodaj-dogodek-exe', 'method' => 'post', 'enctype' => 'multipart/form-data', 'files' => 'true']) !!}
    @csrf

    <div class="card w-75 mx-auto mt-4">

        <div class="card-header">
            <div class="card-title">
                DODAJ DOGODEK
            </div>
        </div>
        <div class="card-body">

            <div class="form-group mb-4">
                <input class="form-control" name="eventName" required placeholder="Vnesite ime dogodka">
                <small id="emailHelp" class="form-text text-muted">Ime dogodka</small>
            </div>

            <div class="form-group mb-4">
                <input name="eventDate" required class="form-control" type="date">
                <small id="emailHelp" class="form-text text-muted">Datum dogodka</small>
            </div>

            <div class="form-group mb-4">
                <input name="eventTime" required class="form-control" type="time">
                <small id="emailHelp" class="form-text text-muted">Čas dogodka</small>
            </div>

            <div class="form-group mb-4">
                <input type="text" name="eventLocation" required class="form-control"
                    placeholder="Vnesite lokacijo dogodka">
                <small id="emailHelp" class="form-text text-muted">Lokacija</small>
            </div>

            <div class="form-group mb-4">
                <textarea class="form-control" rows="5" name="eventDescription" placeholder="Vpišite opis dogodka"></textarea>
                <small id="emailHelp" class="form-text text-muted">Opis dogodka</small>
            </div>

            <div class="form-group mb-4">
                <label>Slika</label>
                <input id="file-upload" required type="file" name="eventPicture" />
            </div>

            <div class="form-group mb-4">
                <div class="form-row">
                    <label style="margin-right:10px;">Vstopnina</label>
                    <input style="width: fit-content !important;" type="checkbox" checked id="weightableCheckbox"
                        name="ticketCheckbox" class="custom-control-input" onchange="enableWeight();">
                </div>
            </div>

            <div class="form-group mb-4" id="drink-packing-weight-div">
                <input type="number" name="ticketPrice" id="packingWeight" class="form-control"
                    placeholder="Vnesite ceno vstopnine">
                <small id="emailHelp" class="form-text text-muted">Cena vstopnine</small>
            </div>

            <div class="form-group mb-4" id="drink-packing-weight-special-div">
                <input type="number" name="specialTicketPrice" id="packingWeight" class="form-control"
                    placeholder="Vnesite ceno vstopnine za ŠŠK člane">
                <small id="emailHelp" class="form-text text-muted">Cena vstopnine za ŠŠK člane</small>
            </div>

            <!-- SUBMIT -->
            <div class="form-group d-flex justify-content-center">
                <button class="btn btn-success" type="submit">Dodaj</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection


@push('js')
    <script>
        function enableWeight() {
            weightableCheckbox = document.getElementById("weightableCheckbox");
            packingWeight = document.getElementById("packingWeight");

            if (weightableCheckbox.checked == true) {
                document.getElementById("drink-packing-weight-div").style.display = "block";
                document.getElementById("drink-packing-weight-special-div").style.display = "block";
                packingWeight.required = true;
            } else {
                document.getElementById("drink-packing-weight-div").style.display = "none";
                document.getElementById("drink-packing-weight-special-div").style.display = "none";
                packingWeight.required = false;
            }
        }
    </script>
@endpush
