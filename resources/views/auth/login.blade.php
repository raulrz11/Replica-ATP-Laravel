@extends('layouts.app')

@section('logo')
    <div style="display: flex; justify-content: center; align-items: center; margin-top: 40px">
        <a href="{{ route('tenistas.index') }}" style="display: flex; justify-content: center; align-items: center; border: 3px solid blue; border-radius: 1000px; height: 200px; width: 200px; padding: 20px; background-color: white; box-shadow: 0px 0px 20px 5px blue inset">
            <img src="/images/logo.png" alt="Logo" height="100px" width="200px">
        </a>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6" style="margin-right: 10px">
            <div class="card" style="background-color: transparent; border: 1px solid blue">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="color: white">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" style="color: white">{{ __('Contrasena') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="color: white">
                                        {{ __('Recuerdame') }}
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Olvidaste tu contrasena?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary" style="margin-right: 20px">
                                    {{ __('Iniciar sesion') }}
                                </button>
                                <span style="color: white">No tienes cuenta?</span><a href="{{ route('register') }}">{{ __(' Registrate aqui') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
