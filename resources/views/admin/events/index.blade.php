@extends('layouts.home')

@section('content')
    <div class="events-header">
        <div onclick="location.href='/dodaj-dogodek'" class="add-new-event">
            <p>Dodaj dogodek</p>
            <i class="fas fa-plus"></i>
        </div>
    </div>



    @foreach ($events as $event)
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <img src="/images/events/{{ $event->picture }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text">{{ $event->description }}</p>

                    <div class="row">
                        <button class="btn btn-primary card-action-button">Već</button>
                        <button class="btn btn-primary card-action-button">Uredi</button>
                        <button class="btn btn-primary card-action-button">Povezava</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




    @foreach ($events as $event)
        <div class="row">
            <div class="card-columns">
                <div class="card">
                    <img class="card-img-top" src="/images/events/{{ $event->picture }}">
                    <div class="card-block">
                        <h4 class="card-title">člsdfkčlsdkčflk</h4>
                        <p class="card-text">sdčofksdčlfksf</p>
                    </div>
                    <div class="card-footer text-muted">
                        <ul class="list-inline">
                            <li><i class="fa fa-user"></i></li>
                            <li>14</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
