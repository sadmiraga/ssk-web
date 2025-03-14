@extends('layouts.home')
@section('content')
    <div class="login-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-login-container" style="width:100%;margin-right:0px;margin-left:0px;">
                    <div class="card-header">{{ __('Prijava') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Elektronski naslov') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Geslo') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Zapomni si') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" id="login-button" class="btn btn-primary">
                                        {{ __('Prijava') }}
                                    </button>


                                </div>
                            </div>
                            <div class="form-group" id="register-redirect">
                                <a href="/register">Nimate Racuna? Registrirajte se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
