@can('user.edit')
    @extends('adminlte::page')

    @section('title', 'Editar')

    {{-- @section('content_header')
    <h1>Editar usuario</h1>
    @stop --}}

    @section('content')
        <div class="col-10 ml-4">
            <h1>Crear Usuario</h1>

            <x-admin.validationErrors :errors="$errors"></x-admin.validationErrors>
            <x-admin.validationSuccess ></x-admin.validationSuccess>

            <form action="/admin/users" method="post">
                @csrf
                @method('POST')
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control"  name="email" value="{{old('email')}}" >
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- {{dd($user)}} --}}

                    <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="{{old('name')}}" >
                    </div>
                </div>

                 <div class="row mb-3">
                     <label for="inputNewPassword" class="col-sm-2 col-form-label">Nueva contraseña</label>
                     <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputNewPassword" name="password"  value="">
                     </div>
                 </div>
                <div class="row mb-3">
                    <label for="inputConfirmationNewPassword" class="col-sm-2 col-form-label">Confirmar nueva contraseña</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password_confirmation"  value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 col-form-label">Rol de usuario</label>
                    <div class="col-sm-9">
                        <select  class="form-control" name="role">
                            @foreach($roles as $rol)
                            <option value="{{$rol->name}}">{{$rol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>

    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
@endcan
