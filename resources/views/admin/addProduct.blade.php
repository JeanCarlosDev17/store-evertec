@can('user.edit')
    @extends('adminlte::page')
    @section('title', 'Crear Producto')

{{-- @section('content_header')
<h1>Editar usuario</h1>
@stop --}}

@section('content')
    <div class="col-10 ml-4">
        <h1>Agregar Producto</h1>
        @if($errors->any)
            @forelse($errors->all() as $error)
                <ul>
                    <li>{{$error}}</li>
                </ul>
            @empty
            @endforelse
        @endif

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
                    <input type="text" class="form-control" id="inputName" name="name" required
                           value="{{ old("name") }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputDescription" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="textAdescription" rows="3" name="description">{{old("description")}}</textarea>
{{--                    <input type="textarea" class="form-control" name="" value="{{ old() }}">--}}
                </div>
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
                    <input type="text" class="form-control"  id="inputMaker"  name="maker"
                           value="{{ old("marker") }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="input" class="col-sm-2 col-form-label">Cantidad en Stock</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" min="1"  required  name="stock"
                           value="{{ old('stock'),'1' }}">
                </div>
            </div>






            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@endcan
