
    @can('admin.index')


        @extends('adminlte::page')

        @section('title', 'Administrador Home')

        @section('content_header')
            <h1>Administrador</h1>
        @stop

        @section('content')
            <div>
                <p>Bienvenido al panel de administración </p>
                <a href="{{route('users.create')}}" class="btn btn-outline-success mb-4">Crear Usuario</a>
                <x-admin.validationSuccess ></x-admin.validationSuccess>
                <x-admin.indexUser :users="$users">

                </x-admin.indexUser>
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
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

        @stop
        @section('js')
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="{{ asset('js/forms.js') }}"></script>


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
                    $('#users').DataTable( {
                        responsive: true
                    } );
                } );

            </script>




        @stop
    @endcan






