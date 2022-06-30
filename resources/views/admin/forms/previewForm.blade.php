@extends('layouts.home')

@section('content')
    <h5 class="display-7 text-center text-muted">{{ $form->name }}</h5>

    <div class="card-body w-50 x-auto" style="margin-left:25%;margin-right:25%;border:1px solid lightgray;">
        @foreach ($inputs as $input)
            <div class="form-group w-100 mb-4">
                <label>{{ $input['name'] . ' (' . translateInputType($input['type']) . ')' }}</label>
                <input class="form-control" type="{{ $input['type'] }}" placeholder="{{ $input['description'] }}">
            </div>
        @endforeach

        <button class="btn btn-success w-50" style="margin-left:25%;margin-right:25%;">PRIJAVA</button>
    </div>
@endsection
