@props(['products'])
<div class="table-responsive-md">
    <table class="table">
        @csrf
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descipción</th>
            <th scope="col">Fabricante</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Estado</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Activar/Desactivar</th>

        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)


            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->maker}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->state}}</td>

                <td>
                    <form action="{{route('products.edit',$product->id)}}" class="edit">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info "><i class="fas fa-edit" style="max-width:min-content"></i>  </button>
                    </form>

                </td>


                <td><form action="{{route('products.destroy',$product->id)}}" class="delete" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit"  class="btn btn-danger "><i class="fas fa-minus-circle" style="max-width:min-content"></i></button>
                    </form>
                </td>


                <td class="d-flex justify-content-center ">

                    <form action="{{route('users.state',$product->id)}}" class="state" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit"  href="" class="btn btn-{{$product->state=='active' ? "warning":"success"}} text-center  " style="max-width:min-content ">
                            <i class="fas fa-toggle-on font-weight-bold  " style="color: black"> </i>
                        </button>
                    </form>
                </td>

            </tr>
        @empty
            <h2>No hay Productos registrados</h2>
        @endforelse

        </tbody>

    </table>
</div>
@if($products)
    <div class="container-fluid">
        {{ $products->links() }}
    </div>
@endif
