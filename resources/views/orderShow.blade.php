@extends('nav')
@section('content')
    <!--Start cart-->
    <x-Admin.validationErrors :errors="$errors"></x-Admin.validationErrors>
    <div class="container-fluid pt-5">
        @if(!isset($order) || $order->products->isEmpty())
            <div class="alert">No hay productos en la orden</div>
        @else
            <div class="row px-xl-5">

                <div class="col-lg-8 table-responsive mb-5">


                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>


                        </tr>
                        </thead>
                        <tbody class="align-middle">
                        @foreach($order->products as $product)

                            <tr>
                                <td class="align-middle">
                                    <img src="{{$product->getImageUrl()}}" alt="" style="width: 50px;">
                                </td>
                                <td class="align-middle">{{$product->name}}</td>
                                <td class="align-middle">${{$product->formatPrice()}}</td>
                                <td class="align-middle">
                                    <input type="number"
                                           name="quantity"
                                           class="form-control form-control-sm bg-secondary text-center"
                                           value="{{$product->pivot->quantity}}"
                                    >
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>




                </div>
                <div class="col-lg-4">

                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                        </div>

                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold">${{$order->total}}</h5>
                            </div>
{{--                            <form action="{{route('orders.store')}}" method="post">--}}
{{--                                @csrf--}}
{{--                                @auth()--}}
{{--                                    @role('admin')--}}
{{--                                    <a href="{{route('admin.index')}}" class="btn btn-block btn-primary my-3 py-3">--}}
{{--                                        Ir a pagar--}}
{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    <button type="submit" class="btn btn-block btn-primary my-3 py-3">--}}
{{--                                        Ir a pagar--}}
{{--                                    </button>--}}
{{--                                    @endrole--}}
{{--                                @endauth--}}
{{--                                @guest()--}}
{{--                                    <a href="{{route('login')}}" class="btn btn-block btn-primary my-3 py-3">--}}
{{--                                        Ir a pagar--}}
{{--                                    </a>--}}
{{--                                @endguest--}}


{{--                                --}}{{--                                <button type="submit" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!--End Cart-->
@endsection
