@extends('layouts.home')

@section('content')
    <div class="events-header mb-3">
        <button type="submit" class="btn btn-success" onclick="save();">
            <span>Shrani izbiro</span>
            <i class="fa fa-check"></i>
        </button>
    </div>


    <form action="/setFormExe" method="post" id="setForm">
        @csrf
        <input type="hidden" value="0" id="formID" name="formID">
        <input type="hidden" value="{{ $eventID }}" name="eventID">
    </form>

    <div class="container w-100 x-auto" style="justify-content: space-evenly;">

        @foreach ($forms as $form)
            <div class="card form-card" id="form-{{ $form->id }}-card" style="width: 30%;">
                <div class="card-header">
                    <div class="card-title">
                        {{ $form->name }}
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="display:flex;">
                        <div class="btn btn-warning btn-sm w-50" onclick="showForm();">POGLEJ</div>
                        <div class="btn btn-success btn-sm w-50" onclick="chooseForm({{ $form->id }});">IZBERI</div>
                    </li>
                </ul>
            </div>
        @endforeach





    </div>
@endsection

@push('js')
    <script>
        function save() {

            formID = document.getElementById("formID").value;

            if (formID != 0) {
                document.getElementById("setForm").submit();
            } else {
                alert('Izberite formo');
            }




        }

        function chooseForm(formID) {
            var cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.border = "1px solid rgba(0, 0, 0, 0.125)";
            });
            var selectedName = "form-" + formID + "-card";
            var selected = document.getElementById(selectedName);
            selected.style.border = "1px solid black";
            document.getElementById("formID").value = formID;
        }

        function showForm() {
            alert('show form');
        }
    </script>
@endpush
