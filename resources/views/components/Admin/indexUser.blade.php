@props(['users'])
<table class="table">
    @csrf
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

    @forelse($users as $user)

        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->hasRole('admin')? "Administrador":"Usuario"}}</td>
            <td>{{$user->user_state==1 ? "Activo":"Inactivo"}}</td>
            <td>
                <form action="{{route('users.edit',$user->id)}}" class="edit" method="get">

                        @csrf
                        @method('GET')
                    <button type="submit" class="btn btn-info "><i class="fas fa-edit" style="max-width:min-content"></i>  </button>
                </form>

            </td>


            <td><form action="{{route('users.destroy',$user->id)}}" class="delete" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit"  class="btn btn-danger "><i class="fas fa-user-times" style="max-width:min-content"></i></button>
                </form>
            </td>


            <td class="d-flex justify-content-center ">

                <form action="{{route('users.state',$user->id)}}" class="state" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit"  href="" class="btn btn-{{$user->user_state==1 ? "warning":"success"}} text-center  " style="max-width:min-content ">
                        <i class="fas fa-toggle-on font-weight-bold  " style="color: black"> </i>
                    </button>
                </form>
            </td>

        </tr>
    @empty
        <h2>No hay usuarios registrados</h2>
    @endforelse
    </tbody>
</table>
