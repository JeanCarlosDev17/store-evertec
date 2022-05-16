@props(['roles'])
<div class="card">

    <div class="card-body">


        <div class="table-responsive-md">
            <table class="table table-striped table-bordered dt-responsive display " id="roles" cellspacing="0" width="100%" style="width: 100% !important;">
                @csrf
                <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>

                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <form action="{{route('roles.edit',$role->id)}}" class="editProduct d-flex" method="get">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-info text-center  mx-auto">
                                    <i class="fas fa-edit" style="max-width:min-content"></i>
                                </button>
                            </form>
                        </td>

                        <td>
                            <form action="{{route('roles.destroy',$role->id)}}" class="deleteProduct d-flex" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit"  class="btn btn-danger text-center  mx-auto ">
                                    <i class="fas fa-minus-circle " style="max-width:min-content"></i>
                                </button>
                            </form>
                        </td>



                    </tr>
                @empty
                    <h2>No hay Roles registrados</h2>
                @endforelse

                </tbody>

            </table>
        </div>
    </div>
</div>

{{--@if($products)--}}
{{--    <div class="container-fluid">--}}
{{--        {{ $products->links() }}--}}
{{--    </div>--}}
{{--@endif--}}


