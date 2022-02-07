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
        <x-admin.validationSuccess ></x-admin.validationSuccess>
        <form action="{{ route('products.store')}}" method="post">
            @csrf
            @method('POST')
{{--            <div class="row mb-3">--}}
{{--                <label for="inputCode" class="col-sm-2 col-form-label">Codigo del producto</label>--}}
{{--                <div class="col-sm-10">--}}
{{--                    <input type="text" class="form-control"    id="inputCode"    name="code"--}}
{{--                           value="{{ old("productCode") }}">--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row mb-3">
                <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text"  @class(['form-control','is-invalid'=>$errors->has('name')]) id="inputName" name="name" required value="{{ old("name") }}">
                </div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

            </div>
            <div class="row mb-3">
                <label for="inputDescription" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="textAdescription" rows="3" name="description">{{old("description")}}</textarea>
{{--                    <input type="textarea" class="form-control" name="" value="{{ old() }}">--}}
                </div>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row mb-3">
                <label for="inputPrice" class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPrice"  min="1" required  name="price" step="1"
{{--                    <input type="number" class="form-control" id="inputPrice"  min=".01" required  name="price" step=".01"--}}
                           value="{{ old("price") }}">
                </div>

            </div>
            <div class="row mb-3">
                <label for="inputMaker" class="col-sm-2 col-form-label">Marca</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="inputMaker"  name="maker" value="{{ old("marker") }}">
                </div>
                @if ($errors->has('maker'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('maker') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row mb-3">
                <label for="input" class="col-sm-2 col-form-label">Cantidad en Stock</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" min="1"  required  name="quantity"
                           value="{{ old('quantity'),'1' }}">
                </div>
                @if ($errors->has('quantity'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                @endif
                @error('quantity')
                     <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@stop
@endcan
