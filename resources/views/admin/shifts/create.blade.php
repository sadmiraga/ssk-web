@extends('layouts.home')

@section('content')
    <div class="card new-event-container">


        <?php
        $today = date('Y-m-d');

        $currentTime = date('H:i');

        if (intval($currentTime) < 19) {
            $startTime = date('12:00');
            $endTime = date('17:30');
        } else {
            $startTime = date('17:00');
            $endTime = date('23:00');
        }

        ?>


        {!! Form::open(['url' => '/dodaj-ure-store', 'method' => 'post']) !!}
        @csrf
        <div class="card-body">


            <!-- SHIFT TYPE -->
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Vrst dela</label>
                <div class="col">
                    <select class="form-control" name="shift-type">
                        <option value="strezba" selected>Strežba</option>
                        <option value="dezurstvo">Dežurstvo</option>
                    </select>
                </div>
            </div>

            <!-- START DATE -->
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Začetek</label>
                <div class="col">
                    <input type="date" name="start-date" value="{{ $today }}" class="form-control">
                </div>
            </div>

            <!-- START TIME -->
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Začetek</label>
                <div class="col">
                    <input type="time" name="start-time" value="{{ $startTime }}" class="form-control">
                </div>
            </div>

            <!-- END TIME -->
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Konec</label>
                <div class="col">
                    <input type="date" name="end-date" value="{{ $today }}" class="form-control">
                </div>
            </div>

            <!-- END TIME -->
            <div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Konec</label>
                <div class="col">
                    <input type="time" name="end-time" value="{{ $endTime }}" class="form-control">
                </div>
            </div>

            <!-- SUBMIT -->
            <div class="form-group d-flex justify-content-center">
                <button class="btn btn-success" type="submit" style="width:100%;">Dodaj</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
