
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col">rol</th>
        <th scope="col">Estado</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>
        <th scope="col">Activar/Desactivar</th>

    </tr>
    </thead>
    <tbody>

    @foreach ($users as $user)

        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role_id==1 ? "Administrador":"Usuario"}}</td>
            <td>{{$user->user_state==1 ? "Activo":"Inactivo"}}</td>
            <td><a type="button" class="btn btn-info "><i class="fas fa-edit" style="max-width:min-content"></i>  </a></td>
            <td><a type="button " class="btn btn-danger "><i class="fas fa-user-times" style="max-width:min-content"></i>  </a></td>
            <td class="d-flex justify-content-center "><a type="button" class="btn btn-warning text-center  " style="max-width:min-content "><i class="fas fa-toggle-on font-weight-bold  " style="color: black"> </i></a></td>

        </tr>
    @endforeach
    </tbody>
</table>
