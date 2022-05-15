@can('admin.index')



    @extends('adminlte::page')

    @section('title', 'Administrador Home')

@section('content_header')

{{--    <x-admin.modalSuccess ></x-admin.modalSuccess>--}}
    <x-admin.validationSuccess ></x-admin.validationSuccess>
    <h1>Administrador</h1>
@stop

@section('content')


    <div>
        <p>Bienvenido al panel de administración  de productos</p>
        <a href="{{route('products.create')}}" class="btn btn-outline-success mb-4">AGREGAR PRODUCTO</a>
        <div class="row">
            <form action="{{route('products.export')}}" class="flex">
                <button type="submit" class="btn btn-outline-info mb-4">EXPORTAR PRODUCTOS</button>
                <span>desde</span>
                <input type="date" name="start" class="mx-2 mb-4"  required>
                <span>hasta</span>
                <input type="date" name="end" class="mx-2 mb-4" required>

            </form>
        </div>
        <a href="{{route('products.create')}}" class="btn  mb-4">IMPORTAR PRODUCTOS</a>
        <div class="row">
            <form action="{{route('products.create')}}" class="flex">
                <button type="submit" class="btn btn-outline-dark mb-4">REPORTE PRODUCTOS</button>
                <span>desde</span>
                <input type="date" name="start" class="mx-2 mb-4" required>
                <span>hasta</span>
                <input type="date" name="end" class="mx-2 mb-4" required>

            </form>
        </div>
        <x-admin.indexProducts :products="$products">

        </x-admin.indexProducts>

    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">


    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">


    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

    <!--  extension responsive  -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">


    <style>
        .paginate_button{
            margin-left: 0.2rem ;
            margin-right: 0.2rem ;
        }
    </style>
@stop
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/forms.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"> </script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script  src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>



    <!--   Datatables-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

    <!-- extension responsive -->
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>



    <script defer>
        $(document).ready(function() {
            $('#products').DataTable( {
                responsive: true
            } );
        } );

    </script>






@stop
@endcan
