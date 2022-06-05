@extends('layouts.home')

@section('content')
    <!-- Modal -->
    <div class="modal fade show" id="confirmModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalTitle">Ali ste prepričani?</h4>
                </div>
                <div class="modal-body">
                    <span id="delete-modal-text"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Prekliči</button>
                    <a href="" id="modal-delete-button">
                        <button type="button" class="btn btn-danger">Potrdi</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="alert-container" style="display:none;text-align:center;" class="alert alert-success">
        Uspesno ste kopirali povezavo za prijavo na dogodek
    </div>

    <div class="events-header mb-3">

        @if ($status == 'prihajajoce')
            <a href="/dogodki/prejsnji">
            @else
                <a href="/dogodki/prihajajoce">
        @endif

        <button class="btn btn-secondary">
            @if ($status == 'prihajajoce')
                Prejsnji dogodki
            @else
                Prihajajoci dogodki
            @endif
        </button>
        </a>

        <button onclick="location.href='/dodaj-dogodek'" class="btn add-button"><span>Dodaj dogodek</span><i
                class="fas fa-plus"></i></button>


    </div>




    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
        @foreach ($events as $event)
            <div class="col mb-4">
                <div class="card event-card">

                    <a href="{{ route('events.single', $event->id) }}">
                        <div class="card-img-top event-card-image"
                            style="background-image: url('{{ asset('/images/events/' . $event->picture) }}');">
                        </div>
                    </a>

                    <div class="card-body">
                        <h5 class="card-title admin-event-title">{{ $event->name }}</h5>

                        <p class="card-text admin-event-description mb-0">
                            {{ $event->date . ' | ' . date('H:i', strtotime($event->time)) }}</p>
                        <p class="card-text admin-event-description"> {{ numberOfApplications($event->id) }}</p>


                        <div class="row button-row">
                            <button class="btn custom-button" onclick="location.href='/dogodek/{{ $event->id }}'">
                                Več
                            </button>
                            <button class="btn custom-button" onclick="location.href='/uredi-dogodek/{{ $event->id }}'">
                                Uredi
                            </button>

                        </div>

                        <div class="row button-row">
                            <button class="btn custom-button" onclick="copyLink({{ $event->id }});">
                                Povezava
                            </button>

                            <button data-toggle="modal" data-target="#confirmModal"
                                onclick="deleteEvent('{{ route('events.delete', $event->id) }}', '{{ $event->name }}' );"
                                class="btn custom-button">Izbriši</button>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('js')
    <script>
        function copyLink(eventID) {
            var base = window.location.origin;
            var link = base + '/' + 'prijava/' + eventID;
            navigator.clipboard.writeText(link);
            document.getElementById("alert-container").style.display = "block";
            window.setTimeout(function() {
                $(".alert").slideUp();
            }, 3000);
        }

        function deleteEvent(link, eventName) {

            var confirm_message = "Ali ste prepričani da želite izbrisati '" + eventName +
                "'? \n Brisanjem dogodka boste tudi izbrisali vse prijave na ta dogodek. \n Po potrditvi brisanja dogodka podatke o istem ni mozno povrnati.";

            document.getElementById("modal-delete-button").href = link;
            document.getElementById("delete-modal-text").innerHTML = confirm_message;

        }
    </script>
@endpush
