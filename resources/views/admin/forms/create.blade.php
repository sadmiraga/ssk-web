@extends('layouts.home')

@section('content')
    {!! Form::open(['url' => '/dodaj-formo-exe', 'method' => 'post', 'enctype' => 'multipart/form-data', 'files' => 'true']) !!}
    @csrf

    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <input class="form-control" name="formName" required placeholder="Vnesite ime forme">
            </div>
        </div>

        <!-- SUBMIT -->
        <div class="form-group d-flex justify-content-center">
            <button class="btn btn-success" type="submit">Ustvari formo</button>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@endsection
