@if(isset(auth()->user()->role_id)and(auth()->user()->role_id ==1))


    @extends('adminlte::page')

    @section('title', 'Editar')

{{--@section('content_header')
    <h1>Editar usuario</h1>
@stop--}}

@section('content')
    <div class="col-10 ml-4">
        <h1>Editar Usuario</h1>
        <form action="/admin/users/{{$user->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="row mb-3">
{{--                {{dd($user)}}--}}
                <label for="inputEmail3" class="col-sm-2 col-form-label" >Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" required value="{{$user->name}}">
                </div>
            </div>
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label" >Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" name="email" required value="{{$user->email}}">
            </div>
        </div>
{{--        <div class="row mb-3">--}}
{{--            <label for="inputPassword3" class="col-sm-2 col-form-label">Nueva Password</label>--}}
{{--            <div class="col-sm-10">--}}
{{--                <input type="password" class="form-control" id="inputPassword"  value="">--}}
{{--            </div>--}}
{{--        </div>--}}

        <button type="submit"  class="btn btn-primary">Actualizar</button>
    </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@else
    <h2>ACCESO NO AUTORIZADO... </h2>
    {{--    TODO despues implementar policies--}}
    <a href="/" class="btn btn-blue">Regresar</a>
@endif
