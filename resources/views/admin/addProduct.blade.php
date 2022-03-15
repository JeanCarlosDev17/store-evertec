@can('user.edit')
    @extends('adminlte::page')
    @section('title', 'Crear Producto')

{{-- @section('content_header')
<h1>Editar usuario</h1>
@stop --}}

@section('content')
    <div class="col-10 ml-4">
        <h1>Agregar Producto</h1>
{{--        @if($errors->any)--}}
{{--            @forelse($errors->all() as $error)--}}
{{--                <ul>--}}
{{--                    <li>{{$error}}</li>--}}
{{--                </ul>--}}
{{--            @empty--}}
{{--            @endforelse--}}
{{--        @endif--}}
        <x-admin.validationErrors :errors="$errors"></x-admin.validationErrors>

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
        <x-admin.validationSuccess ></x-admin.validationSuccess>


        <form action="{{ route('products.store')}}" id="formProduct" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
{{--            <div class="row mb-3">--}}
{{--                <label for="inputCode" class="col-sm-2 col-form-label">Codigo del producto</label>--}}
{{--                <div class="col-sm-10">--}}
{{--                    <input type="text" @class(['form-control','is-invalid'=>$errors->has('code')])    id="inputCode"    name="code"--}}
{{--                           value="{{ old("productCode") }}">--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row mb-3">
                <label for="inputName" class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-9">
                    <input type="text"  @class(['form-control','is-invalid'=>$errors->has('name')]) id="inputName" name="name" required value="{{ old("name") }}">
{{--                    @error('name')--}}
{{--                    <p class="text-red-500 text-xs italic" style="color: #dc3545">{{ $errors->first('name') }}</p>--}}
{{--                    @enderror--}}
                </div>



            </div>
            <div class="row mb-3">
                <label for="inputDescription" class="col-sm-3 col-form-label">Descripción</label>
                <div class="col-sm-9">
                    <textarea @class(['form-control','is-invalid'=>$errors->has('description')]) id="textAdescription" rows="3" name="description">{{old("description")}}</textarea>
{{--                    <input type="textarea" class="form-control" name="" value="{{ old() }}">--}}
{{--                    @error('description')--}}
{{--                    <p class="text-red-500 text-xs italic" style="color: #dc3545">{{ $errors->first('description') }}</p>--}}
{{--                    @enderror--}}
                </div>

            </div>

            <div class="row mb-3">
                <label for="inputPrice" class="col-sm-3 col-form-label">Precio</label>
                <div class="col-sm-9">
                    <input type="number" @class(['form-control','is-invalid'=>$errors->has('price')]) id="inputPrice"  min="1" required  name="price" step="1"
{{--                    <input type="number" class="form-control" id="inputPrice"  min=".01" required  name="price" step=".01"--}}
                           value="{{ old("price") }}">
{{--                    @error('price')--}}
{{--                    <p class="text-red-500 text-xs italic" style="color: #dc3545">{{ $errors->first('price') }}</p>--}}
{{--                    @enderror--}}
                </div>

            </div>
            <div class="row mb-3">
                <label for="inputMaker" class="col-sm-3 col-form-label">Marca</label>
                <div class="col-sm-9">
                    <input type="text" @class(['form-control','is-invalid'=>$errors->has('maker')])  id="inputMaker"  name="maker" value="{{ old("maker") }}">
{{--                    @error('maker')--}}
{{--                    <p class="text-red-500 text-xs italic" style="color: #dc3545">{{ $errors->first('maker') }}</p>--}}
{{--                    @enderror--}}
                </div>

            </div>

            <div class="row mb-3">
                <label for="input" class="col-sm-3 col-form-label">Cantidad en Stock</label>
                <div class="col-sm-9">
                    <input type="number" @class(['form-control','is-invalid'=>$errors->has('quantity')]) min="0" max="16770200" required  name="quantity"
                           value="{{ old('quantity'),'1' }}">
{{--                    @error('quantity')--}}
{{--                    <p class="text-red-500 text-xs italic" style="color: #dc3545">{{ $errors->first('quantity') }}</p>--}}
{{--                    @enderror--}}
                </div>
            </div>
{{--            <div class="row mb-3">--}}
{{--                <label for="input" class="col-sm-2 col-form-label">Cantidad en Stock</label>--}}
{{--                <div class="col-sm-10">--}}

{{--                    <input  accept="image/jpg,image/jpeg,image/png,image/bmp" type="file" multiple @class(['form-control','form-control-lg','is-invalid'=>$errors->has('images')])  --}}{{--required--}}{{--  name="images[]">--}}

{{--                </div>--}}
{{--            </div>--}}
            <div class="row mb-3">
                <label for="input" class="col-sm-3 col-form-label">IMAGENES</label>
                <div class="col-sm-9 border border-dark">

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

            <button type="submit" class="btn btn-primary">Registrar</button>
{{--            <button type="submit" id ='test'>3232</button>--}}
        </form>
    </div>

@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="{{asset('css/app.css')}}>--}}
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
    <script defer src="{{asset('js/app.js')}}">


    </script>


@stop
@endcan
