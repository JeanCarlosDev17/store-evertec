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

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>

    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
@endcan
