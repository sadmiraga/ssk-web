@extends('layouts.home')

@section('content')
    {!! Form::open(['url' => '/dodaj-dogodek-exe', 'method' => 'post', 'enctype' => 'multipart/form-data', 'files' => 'true']) !!}
    @csrf

    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <div class="form-row">
                    <label>Naslov dogodka</label>
                    <input class="form-control" name="eventName" required placeholder="Vnesite ime dogodka">
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label>Datum dogodka</label>
                    <input name="eventDate" required class="form-control" type="date">
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label>Čas dogodka</label>
                    <input name="eventTime" required class="form-control" type="time">
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label>Lokacija dogodka</label>
                    <input type="text" name="eventLocation" required class="form-control"
                        placeholder="Vnesite lokacijo dogodka">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label>Opis</label>
                    <textarea class="form-control" rows="5" name="eventDescription"
                        placeholder="Vpišite opis dogodka"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label>Slika</label>
                    <input id="file-upload" required type="file" name="eventPicture" />
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label>Vstopnina</label>
                    <input style="width: fit-content !important;" type="checkbox" checked id="weightableCheckbox"
                        name="ticketCheckbox" class="custom-control-input" onchange="enableWeight();">
                </div>
            </div>


            <div class="form-group" id="drink-packing-weight-div">
                <div class="form-row">
                    <label>Cena</label>
                    <input type="number" name="ticketPrice" id="packingWeight" class="form-control"
                        placeholder="Vnesite ceno vstopnine">
                </div>
            </div>





            <!-- SUBMIT -->
            <div class="form-group d-flex justify-content-center">
                <button class="btn btn-success" type="submit">Dodaj</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
