
    @can('admin.index')
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

                <x-admin.indexUser :users="$users">

                </x-admin.indexUser>
            </div>
            <script src="{{ asset('js/forms.js') }}"></script>
        @stop

        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
        @stop
    @endcan






