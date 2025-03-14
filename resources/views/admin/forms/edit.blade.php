@extends('layouts.home')

@section('content')
    {!! Form::open(['url' => '/uredi-formo', 'method' => 'post', 'enctype' => 'multipart/form-data', 'files' => 'true']) !!}
    @csrf

    <input type="hidden" value="{{ $formID }}" name="formID">

    <h6 class="display-5 text-center text-muted">{{ $form->name }}</h6>

    <div class="card w-50 mx-auto mt-4">
        <div class="card-header">
            <div class="card-title">
                DODAJ VNOSNO POLJE
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-row">
                    <input class="form-control" name="inputName" required placeholder="Vnesite ime vnosnega polja">
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <select name="inputType" class="form-select" required>
                        <option value="0" selected disabled>Izberite tip vnosa</option>
                        <option value="password">geslo</option>
                        <option value="email">Elektronski naslov</option>
                        <option value="text">Besedilo</option>
                        <option value="number">Številka</option>
                        <option value="file">Slika/datoteka</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <input name="description" required class="form-control" type="text"
                        placeholder="Vnesite besedilo pri vnosu npr. Ime, Priimek, Email...">
                </div>
            </div>


            <!-- SUBMIT -->
            <div class="form-group d-flex justify-content-end">
                <button class="btn btn-success" type="submit">DODAJ</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>



    <div class="card w-50 mx-auto mt-4">

        <div class="card-header">
            <div class="card-title">
                Izgled obrazca za prijavo
            </div>
        </div>

        <div class="card-body" style="padding:20px;">
            @if ($fields != null)
                @foreach ($fields as $input)
                    <div class="form-group mb-3">

                        <label for="{{ $loop->iteration }}">{{ $input['name'] }}</label>

                        <div class="row">
                            <input style="width:95%;" autocomplete="off" type="{{ $input['type'] }}"
                                name="{{ $input['name'] }}" placeholder="{{ $input['description'] }}"
                                class="form-control" id="{{ $loop->iteration }}">

                            <a style="width:5%;" class="btn btn-danger btn-sm"
                                href="{{ route('forms.removeInput', ['form_id' => $form->id, 'field_name' => $input['name']]) }}">
                                x
                            </a>
                        </div>

                    </div>
                @endforeach
                <!-- SUBMIT -->
                <div class="form-group d-flex justify-content-end">
                    <button class="btn btn-success">PRIJAVA </button>
                </div>
            @endif
        </div>
    </div>


    <!--
                                        <div class="table-responsive mt-4">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Ime</th>
                                                        <th scope="col">Tip</th>
                                                        <th scope="col">Opis</th>
                                                        <th scope="col">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($fields as $field)
    <tr>
                                                            <td scope="row">{{ $field['name'] }}</td>
                                                            <td scope="row">{{ $field['type'] }}</td>
                                                            <td scope="row">{{ $field['description'] }}</td>
                                                            <td><button class="btn btn-danger btn-sm">Odstrani</button></td>
                                                        </tr>
    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    -->
@endsection
