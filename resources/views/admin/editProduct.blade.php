@can('user.edit')
    @extends('adminlte::page')

    @section('title', 'Editar Producto')



    @section('content')

        <div class="col-10 ml-4">
            <h1>Modificar Producto</h1>

            <x-admin.validationErrors :errors="$errors"></x-admin.validationErrors>
            <x-admin.validationSuccess ></x-admin.validationSuccess>

            <div id="errors" class="alert alert-danger ml-4 " style="display: none">
                <div class="alert-title font-semibold text-lg text-red-800">
               <span class="text-red-500 bg-red-500">
                <i class="fas fa-exclamation-triangle"></i>
            </span> {{ __('Whoops, something went wrong') }}
                </div>
                <div id="listErrors" class="alert-description text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            </div>
            <div id="success-alerts" style="display: none">

            </div>


            <form id="formProductUpdate" action="{{ route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label">Nombre</label>
                    <div class="col-sm-9">
                        <input type="text"  @class(['form-control','is-invalid'=>$errors->has('name')]) id="inputName" name="name" required value="{{ $product->name }}">

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputDescription" class="col-sm-3 col-form-label">Descripción</label>
                    <div class="col-sm-9">
                        <textarea @class(['form-control','is-invalid'=>$errors->has('description')]) id="textAdescription" rows="3" name="description">{{$product->description}}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPrice" class="col-sm-3 col-form-label">Precio</label>
                    <div class="col-sm-9">
                        <input type="number" @class(['form-control','is-invalid'=>$errors->has('price')]) id="inputPrice"  min="1" required  name="price" step="1" value="{{ $product->price }}">
                               {{--                    <input type="number" class="form-control" id="inputPrice"  min=".01" required  name="price" step=".01"--}}
                    </div>

                </div>
                <div class="row mb-3">
                    <label for="inputMaker" class="col-sm-3 col-form-label">Marca</label>
                    <div class="col-sm-9">
                        <input type="text" @class(['form-control','is-invalid'=>$errors->has('maker')])  id="inputMaker"  name="maker" value="{{ $product->maker }}">

                    </div>

                </div>

                <div class="row mb-3">
                    <label for="input" class="col-sm-3 col-form-label">Cantidad en Stock</label>
                    <div class="col-sm-9">
                        <input type="number" @class(['form-control','is-invalid'=>$errors->has('quantity')]) min="0" max="16770200" required  name="quantity" value="{{ $product->quantity }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="input" class="col-sm-3 col-form-label">IMAGENES</label>
                    <div class="col-sm-9 border border-dark">

                        <input  id="filesUpdate"
                                type="file"
                                multiple
                                data-allow-reorder="true"
                                data-max-file-size="3MB"
                                data-max-files="5"
                                accept="image/jpg,image/jpeg,image/png,image/bmp"
                                @class(['is-invalid'=>$errors->has('images')])
                                required  name="images[]">
                        {{--                    <input id="files" type="file" />--}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Actualizar</button>
            </form>
        </div>

    @stop

    @section('css')

        {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        {{--    <link rel="stylesheet" href="{{asset('css/app.css')}}>--}}
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet"
        />
        <link
            href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css"
            rel="stylesheet"
        />

    @stop

    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js"></script>


        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script defer>

            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize,
                // corrects mobile image orientation
                FilePondPluginImageExifOrientation,
                // previews the image
                FilePondPluginImagePreview,
                // crops the image to a certain aspect ratio
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageValidateSize
            );

            const inputElement = document.querySelector('input[type="file"]')

            let pond = FilePond.create( inputElement ,{


                files: [
                ],
                credits:false,
                required:true,
                allowMultiple:true,
                allowReorder:true,
                // storeAsFile:true,
//     allowReorder:true,
                maxFiles:5,
                dropValidation:true,
                allowFileSizeValidation:true,
                maxFileSize:'2MB',
                allowFileTypeValidation:true,
                acceptedFileTypes: ['image/jpg,image/jpeg,image/png,image/bmp'],
                name:'images[]',
                allowImageExifOrientation:true,
                allowImagePreview:true,
                allowImageEdit:true,
                allowImageCrop:true,
                allowImageTransform:true,
                allowImageValidateSize:true,
                // imageValidateSizeMaxWidth:600,
                // imageValidateSizeMaxHeight:600,
                imageValidateSizeLabelImageSizeTooSmall:'Image is too small',
                imageValidateSizeLabelImageSizeTooBig:'Image is too big',
                imageValidateSizeLabelExpectedMaxSize:'Maximum size is {maxWidth} × {maxHeight}',

                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 170,
                // imageCropAspectRatio: '1:1',
                // imageResizeTargetWidth: 200,
                // imageResizeTargetHeight: 200,
                // stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleButtonRemoveItemPosition: 'center bottom'
            });




            $(document).ready(function() {

                @forelse($product->images as $image)

                {{--pond.addFile({!!json_encode($image->url())!!})--}}
                pond.addFile( @json($image->url()) )
{{--                @dump($image->getExtensionImage())--}}
{{--                @dump($image->getFileName())--}}
{{--                @dump($image->getFileSize())--}}
{{--                @dump($image->getFileMime())--}}
                {{--console.log(--}}
                {{--    {!!json_encode($image->url())!!}--}}
                {{--)--}}
                @empty
                @endforelse



                $("#formProductUpdate").submit(function(e) {
                    //---------------^---------------
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    const files = pond.getFiles()
                    console.log("Archivos en el filepond ",files)

                    let myForm = document.getElementById('formProductUpdate');
                    var params = new FormData(myForm);
                    console.log("hay images en el formulario? :  "+params.has("images[]", params.getAll("images[]")))
                    params.delete("images[]")
                    console.log("limpiado formulario ahora hay images? :  "+params.has("images[]"))
                    for ( var i in files) {
                        params.append('images[]', files[i].file);
                    }
                    console.log("imagenes del pond añadidas al param hay images en el param? :  "+params.has("images[]"))
                    console.log("images en param  es  ",params.getAll('images[]'))
                    console.log("valores del params")

                    for (var pair of params.entries()) {
                        console.log(pair[0]+ ',' + pair[1]);
                    }
                    $.ajax({
                        url: "/admin/products/"+{{$product->id}},
                        type: "POST",
                        data: params,
                        error:function ( jqXHR, textStatus, errorThrown ) {
                            // console.log('funtion Error ajax');
                            // console.log(jqXHR);
                            let responseText = jQuery.parseJSON(jqXHR.responseText);

                            if (jqXHR.status === 400) {

                                printErrorMsg(responseText.errors);

                            } else if (jqXHR.status == 500) {

                                printErrorMsgText("Error en el servidor al procesar la solictud");

                            }

                        },
                        success: function (data) {
                            console.log(data);
                            if($.isEmptyObject(data.errors)){
                                console.log(data.success);

                                // console.log("files en pond ", pond.getFiles())
                                // console.log(document.querySelector('#files'))
                                // let myForm = document.getElementById('formProduct');
                                // var params = new FormData(myForm);
                                //
                                // for (var pair of params.entries()) {
                                //     console.log(pair[0]+ ',' + pair[1]);
                                // }
                                printSuccessMsg(data.success);
                            }else{

                                printErrorMsg(data.errors);
                            }
                        },
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                    });

                });


            });

            function printErrorMsgText (msg) {
                console.log("entre al mensaje error  ");
                $("#listErrors").html('');
                $("#errors").css('display','block');

                $("#listErrors").append('<li>'+msg+'</li>');
            }

            function printErrorMsg (msg) {
                console.log("entre al mensaje error  ");
                $("#listErrors").html('');
                $("#errors").css('display','block');
                $.each( msg, function( key, value ) {
                    $("#listErrors").append('<li>'+value+'</li>');
                });
            }
            function printSuccessMsg (msg) {
                $("#errors").css('display','none');


                $("#success-alerts").html('');

                $("#success-alerts").append(
                    '<div class="alert alert-success h3" role="alert">\n' +
                    '  <span><i class="fas fa-check-circle text-white font"></i></span>  ' +msg+
                    ' </div> '
                );
                $("#success-alerts").css('display','block');
                $("#success-alerts").fadeTo(6000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });

            }
        </script>

    @stop

@endcan
