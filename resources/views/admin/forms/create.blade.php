@extends('layouts.home')

@section('content')
    <div class="card w-50 mx-auto">
        {!! Form::open(['url' => '/dodaj-formo-exe', 'method' => 'post', 'enctype' => 'multipart/form-data', 'files' => 'true']) !!}
        @csrf
        <div class="card-header">
            <div class="card-title">
                Ustvari formo
            </div>
        </div>
        <div class="card-body">
            <div class="form-group mt-3">
                <input class="form-control" name="formName" required placeholder="Vnesite ime forme">
            </div>
        </div>

        <!-- SUBMIT -->
        <div class="form-group d-flex justify-content-end mx-3 mb-4">
            <button class="btn btn-success" type="submit">Ustvari formo</button>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@endsection
