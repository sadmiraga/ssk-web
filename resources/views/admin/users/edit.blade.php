@extends('layouts.home')


@section('content')
    <div class="card w-50 custom-user-card">

        <!-- head -->
        <div class="card-header">
            {{ $user->firstName . ' ' . $user->lastName }}
        </div>

        {!! Form::open(['url' => '/uredi-zaposlenega', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        <!-- body -->
        <div class="card-body">

            <div class="form-group mb-4 row">
                <label for="hour_rate" class="col-sm-4 col-form-label">Tip uporabnika</label>
                <div class="col-sm-8">
                    <select class="form-control" name="type_id" id="typeID" aria-label="Default select example">
                        @foreach ($userTypes as $userType)
                            <option @if ($userType->id == $user->type_id) selected @endif value="{{ $userType->id }}">
                                {{ $userType->userType }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-4 row">
                <label for="hour_rate" class="col-sm-4 col-form-label">Urna Postavka</label>
                <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" required id="hour_rate" name="hour_rate"
                        value="{{ $user->hour_rate }}">
                </div>
            </div>

            <input type="hidden" value="{{ $user->id }}" name="userID">

            <!-- submit -->
            <div class="form-group">
                <button class="btn btn-success w-100" type="submit">
                    SHRANI
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
