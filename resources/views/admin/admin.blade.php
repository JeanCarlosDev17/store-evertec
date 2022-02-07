
    @can('admin.index')


        @extends('adminlte::page')

        @section('title', 'Administrador Home')

        @section('content_header')
            <h1>Administrador</h1>
        @stop

        @section('content')
            <div>
                <p>Bienvenido al panel de administración </p>
                <x-admin.validationSuccess ></x-admin.validationSuccess>
                <x-admin.indexUser :users="$users">

                </x-admin.indexUser>
            </div>

        @stop

        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">

        @stop
        @section('js')
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="{{ asset('js/forms.js') }}"></script>

        @stop
    @endcan






