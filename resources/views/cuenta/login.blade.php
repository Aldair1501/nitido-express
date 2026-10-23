
@extends('layouts.tienda')

@section('title', 'Ingresar')

@section('content')

<div class="panel mx-auto" style="max-width:470px">

    <h2 class="fw-bold mb-4">
        Ingresar a mi cuenta
    </h2>

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">
                Correo electrónico
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                autocomplete="email"
                required
                autofocus
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">
                Contraseña
            </label>

            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                autocomplete="current-password"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Ingresar
        </button>

    </form>

    <p class="mt-3 text-center">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}">
            Regístrate
        </a>
    </p>

</div>

@endsection
