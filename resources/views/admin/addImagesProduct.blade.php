@can('user.edit')
    @extends('adminlte::page')

    @section('title', 'Editar Producto')



@section('content')

    <div class="col-10 ml-4">
        <h1>Modificar Producto</h1>

        <x-admin.validationErrors :errors="$errors"></x-admin.validationErrors>
        <x-admin.validationSuccess ></x-admin.validationSuccess>

        <form action="{{ route('products.update',$product->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" hidden  @class(['form-control','is-invalid'=>$errors->has('name')]) id="inputName" name="product_id" required value="{{ $product->id }}">
                    <input type="text"  @class(['form-control','is-invalid'=>$errors->has('name')]) id="inputName" name="name" required value="{{ $product->name }}">

                </div>
            </div>
            <div class="row mb-3">
                <label for="inputDescription" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea @class(['form-control','is-invalid'=>$errors->has('description')]) id="textAdescription" rows="3" name="description">{{$product->description}}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPrice" class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10">
                    <input type="number" @class(['form-control','is-invalid'=>$errors->has('price')]) id="inputPrice"  min="1" required  name="price" step="1" value="{{ $product->price }}">
                    {{--                    <input type="number" class="form-control" id="inputPrice"  min=".01" required  name="price" step=".01"--}}
                </div>

            </div>
            <div class="row mb-3">
                <label for="inputMaker" class="col-sm-2 col-form-label">Marca</label>
                <div class="col-sm-10">
                    <input type="text" @class(['form-control','is-invalid'=>$errors->has('maker')])  id="inputMaker"  name="maker" value="{{ $product->maker }}">

                </div>

            </div>

            <div class="row mb-3">
                <label for="input" class="col-sm-2 col-form-label">Cantidad en Stock</label>
                <div class="col-sm-10">
                    <input type="number" @class(['form-control','is-invalid'=>$errors->has('quantity')]) min="0" max="16770200" required  name="quantity" value="{{ $product->quantity }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input" class="col-sm-2 col-form-label">IMAGENES</label>
                <div class="col-sm-10 border border-dark">

                    <input  id="files"
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

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
    <link
        href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css"
        rel="stylesheet"
    />
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script defer src="{{asset('js/app.js')}}"></script>
@stop


@endcan
