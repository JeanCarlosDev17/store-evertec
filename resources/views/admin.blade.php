@if (isset(auth()->user()->role) and auth()->user()->role == 'admin')


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
