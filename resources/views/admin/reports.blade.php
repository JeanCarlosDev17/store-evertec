@can('admin.index')



    @extends('adminlte::page')

    @section('title', 'Administrador Home')

@section('content_header')

{{--    <x-admin.modalSuccess ></x-admin.modalSuccess>--}}
    <x-admin.validationSuccess ></x-admin.validationSuccess>
    <x-admin.validationErrors :errors="$errors"></x-admin.validationErrors>

    <h1>Administrador</h1>
@stop

@section('content')


    <div>
        <p>Bienvenido al panel de administración  de productos</p>
        <div class="row">
            <form action="{{route('products.export')}}" class="flex">
                @csrf
                <button type="submit" class="btn btn-outline-info mb-4">EXPORTAR PRODUCTOS</button>
                <span class="mx-2">desde</span>
                <input type="date" name="start" class="mx-2 mb-4"  required>
                <span>hasta</span>
                <input type="date" name="end" class="mx-2 mb-4" required>

            </form>
        </div>

        <div class="row">
            <form action="{{route('products.import')}}" class="flex"  enctype="multipart/form-data" method="post">
                @csrf
                @method('post')
                <button type="submit" class="btn btn-outline-secondary mb-4">IMPORTAR PRODUCTOS</button>
                <input type="file" required name="file" class="mx-2">


            </form>
        </div>
        <div class="row">
            @csrf
            <form action="{{route('products.create')}}" class="flex">
                <button type="submit" class="btn btn-outline-dark mb-4">REPORTE PRODUCTOS</button>
                <span class="mx-2">desde</span>
                <input type="date" name="start" class="mx-2 mb-4" required>
                <span>hasta</span>
                <input type="date" name="end" class="mx-2 mb-4" required>

            </form>
        </div>


    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">


    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->


@stop
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/forms.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script defer>
        $(document).ready(function() {
            $('#products').DataTable( {
                responsive: true
            } );
        } );

    </script>






@stop
@endcan
