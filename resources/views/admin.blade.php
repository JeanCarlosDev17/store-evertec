@if (isset(auth()->user()->role) and auth()->user()->role == 'admin')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">

    @extends('adminlte::page')

    @section('title', 'Administrador Home')

    @section('content_header')
        <h1>Administrador</h1>
    @stop

    @section('content')
        <div>
            <p>Bienvenido al panel de administración </p>

            <x-indexUser :users="$users">

            </x-indexUser>
        </div>
        <script src="{{ asset('js/forms.js') }}"></script>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop



@else
    <h2>ACCESO NO AUTORIZADO... </h2>
    {{-- TODO despues implementar policies --}}
    <a href="/" class="btn btn-blue">Regresar</a>
    {{ redirect('/') }}
@endif
