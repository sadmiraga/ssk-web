@extends('layouts.home')


@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ime</th>
                    <th scope="col">Priimek</th>
                    <th scope="col">Tip zaposlenega</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->firstName }}</td>
                        <td>{{ $user->lastName }}</td>
                        <td>{{ $user->userType }}</td>


                        <td style="display:flex;flex-direction:row;">

                            <a href="{{ route('employees.edit', $user->id) }}">
                                <div class="custom-action-button">
                                    <i class="fas fa-cog"></i>
                                </div>
                            </a>

                            <div style="margin-left:2rem;" onclick="location.href='/poglej-ure/{{ $user->id }}'"
                                class="custom-action-button">
                                <i class="far fa-clock"></i>
                            </div>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
