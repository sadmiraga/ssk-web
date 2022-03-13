@extends('layouts.home')

@section('content')
    {!! Form::open(['url' => '/uredi-formo', 'method' => 'post', 'enctype' => 'multipart/form-data', 'files' => 'true']) !!}
    @csrf

    <input type="hidden" value="{{ $formID }}" name="formID">

    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <div class="form-row">
                    <label>Ime polja</label>
                    <input class="form-control" name="inputName" required placeholder="Vnesite ime vnosnega polja">
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label>Izberite tip polja</label>
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
                    <label>Dodatni opis</label>
                    <input name="description" required class="form-control" type="text"
                        placeholder="Vnesite besedilo pri vnosu npr. Ime, Priimek, Email...">
                </div>
            </div>


            <!-- SUBMIT -->
            <div class="form-group d-flex justify-content-center">
                <button class="btn btn-success" type="submit">DODAJ</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Ime</th>
                        <th scope="col">Tip</th>
                        <th scope="col">Opis</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($fields as $field)
                        <tr>
                            <td scope="row">{{ $field['name'] }}</td>
                            <td scope="row">{{ $field['type'] }}</td>
                            <td scope="row">{{ $field['description'] }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
