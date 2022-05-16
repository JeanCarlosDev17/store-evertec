@props(['products'])
<div class="card">

    <div class="card-body">


        <div class="table-responsive-md">
            <table class="table table-striped table-bordered dt-responsive display " id="products" cellspacing="0" width="100%" style="width: 100% !important;">
                @csrf
                <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fabricante</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">In/Activar</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>

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
                        <td class=" justify-content-center ">
                            <form action="{{route('products.state',$product->id)}}" class="stateProduct d-flex" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit"  href="" class="btn btn-{{$product->state=='active' ? "warning":"success"}} text-center   mx-auto " style="max-width:min-content ">
                                    <i class="fas fa-toggle-on font-weight-bold  " style="color: black"> </i>
                                </button>
                            </form>
                        </td>

                        <td>
                            <form action="{{route('products.edit',$product->id)}}" class="editProduct d-flex" method="get">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-info text-center  mx-auto">
                                    <i class="fas fa-edit" style="max-width:min-content"></i>
                                </button>
                            </form>
                        </td>

                        <td>
                            <form action="{{route('products.destroy',$product->id)}}" class="deleteProduct d-flex" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit"  class="btn btn-danger text-center  mx-auto ">
                                    <i class="fas fa-minus-circle " style="max-width:min-content"></i>
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
    </div>
</div>

{{--@if($products)--}}
{{--    <div class="container-fluid">--}}
{{--        {{ $products->links() }}--}}
{{--    </div>--}}
{{--@endif--}}


