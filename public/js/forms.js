let formsEdit=document.querySelectorAll('form.edit');
let formsDelete=document.querySelectorAll('form.delete');
let formsState=document.querySelectorAll('form.state');

let formsProductEdit=document.querySelectorAll('form.editProduct');
let formsProductDelete=document.querySelectorAll('form.deleteProduct');
let formsProductState=document.querySelectorAll('form.stateProduct');

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

formsDelete.forEach(form => {
    form.addEventListener('submit',(event)=>{


        swalWithBootstrapButtons.fire({
            title: 'Esta seguro que desea Eliminar este Usuario',
            text: "",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Si, Confirmar',
            cancelButtonText: 'Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                form.submit();
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

formsState.forEach(form => {
    let buttonWarning=form.querySelectorAll('button.btn-warning');
    let action=buttonWarning.length>0 ? 'Desactivar':'Activar';

    form.addEventListener('submit',(event)=>{

        swalWithBootstrapButtons.fire({
            title: 'Quiere '+action+' este Usuario',
            text: "",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Si, Confirmar',
            cancelButtonText: 'Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                form.submit();
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

formsProductEdit.forEach(form => {
    form.addEventListener('submit',(event)=>{
        swalWithBootstrapButtons.fire({
            title: 'Esta seguro que desea Editar este Producto',
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

formsProductDelete.forEach(form => {
    form.addEventListener('submit',(event)=>{


        swalWithBootstrapButtons.fire({
            title: 'Esta seguro que desea Eliminar este Producto',
            text: "",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Si, Confirmar',
            cancelButtonText: 'Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
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

formsProductState.forEach(form => {
    let buttonWarning=form.querySelectorAll('button.btn-warning');
    let action=buttonWarning.length>0 ? 'Desactivar':'Activar';

    form.addEventListener('submit',(event)=>{

        swalWithBootstrapButtons.fire({
            title: 'Quiere '+action+' este Producto',
            text: "",
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Si, Confirmar',
            cancelButtonText: 'Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                form.submit();
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
