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
        <x-admin.indexProducts :products="$products">

        </x-admin.indexProducts>

    </div>

{{--    <!-- Modal -->--}}
{{--    <div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="modalAlertLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="modalAlertLabel">Modal title</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    BORRADO CORRECTAMENTE--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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



{{--    <script >--}}

{{--        $(document).ready(function() {--}}
{{--            $("#success-alert").fadeTo(4500, 500).slideUp(500, function(){--}}
{{--                $("#success-alert").slideUp(500);--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}


@stop
@endcan
