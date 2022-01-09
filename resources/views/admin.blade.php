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
        <script>
            let formsEdit=document.querySelectorAll('form.edit');
            let formsDelete=document.querySelectorAll('form.delete');
            let formsState=document.querySelectorAll('form.state');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-3'
                },
                buttonsStyling: false
            })

            formsEdit.forEach(form => {
               form.addEventListener('submit',(event)=>{


                   swalWithBootstrapButtons.fire({
                       title: 'Esta seguro que desea Editar este Usuario',
                       text: "",
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonText: 'Si, Confirmar',
                       cancelButtonText: 'No, Cancelar!',
                       reverseButtons: true
                   }).then((result) => {
                       if (result.isConfirmed) {
                           console.log("confirmado");
                           form.submit();
                           respuesta= true;
                       } else if (
                           /* Read more about handling dismissals below */
                           result.dismiss === Swal.DismissReason.cancel
                       ) {
                           /*swalWithBootstrapButtons.fire(
                               'Cancelado',
                               '',
                               'error'
                           )*/
                       }
                   })

                  event.preventDefault();
               });
            });
        </script>
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
