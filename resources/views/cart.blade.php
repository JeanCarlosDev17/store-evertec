@extends('nav')
@section('content')
    <!--Start cart-->
    <x-Admin.validationErrors :errors="$errors"></x-Admin.validationErrors>
    <div class="container-fluid pt-5">
        @if(!isset($cart) || $cart->products->isEmpty())
            <div class="alert">No hay productos en el carrito</div>
        @else
            <div class="row px-xl-5">

                <div class="col-lg-8 table-responsive mb-5">


                        <table class="table table-bordered text-center mb-0">
                            <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Quitar</th>
                            </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach($cart->products as $product)

                                    <tr>
                                        <td class="align-middle"><img src="{{$product->getImageUrl()}}" alt="" style="width: 50px;">
                                            {{$product->name}}</td>
                                        <td class="align-middle">${{$product->formatPrice()}}</td>
                                        <td class="align-middle">
                                            <form action="{{route('products.cart.update',['product'=>$product->id,'cart'=>$cart->id])}}" id="product-quantity" method="post">
                                                @csrf
                                                @method('PUT')

                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button type="input" class="btn btn-sm btn-primary btn-minus" name="action" value="decrease">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="number"
                                                           name="quantity"
                                                           class="form-control form-control-sm bg-secondary text-center"
                                                           value="{{$product->pivot->quantity}}"

                                                    >
                                                    <div class="input-group-btn">
                                                        <button type="input" class="btn btn-sm btn-primary btn-plus" name="action" value="add">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>

                                        </td>
                                        <td class="align-middle">{{$product->total}}</td>
                                        <td class="align-middle">
                                            <form action="{{route('products.cart.destroy',['product'=>$product->id,'cart'=>$cart->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>




                </div>
                <div class="col-lg-4">
    {{--                APPLY COUPON--}}
    {{--                <form class="mb-5" action="">--}}
    {{--                    <div class="input-group">--}}
    {{--                        <input type="text" class="form-control p-4" placeholder="Coupon Code">--}}
    {{--                        <div class="input-group-append">--}}
    {{--                            <button class="btn btn-primary">Apply Coupon</button>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                        </div>
                        <div class="card-body">
{{--                            <div class="d-flex justify-content-between mb-3 pt-1">--}}
{{--                                <h6 class="font-weight-medium">Subtotal</h6>--}}
{{--                                <h6 class="font-weight-medium">$cart->total</h6>--}}
{{--                            </div>--}}
    {{--                        <div class="d-flex justify-content-between">--}}
    {{--                            <h6 class="font-weight-medium">Shipping</h6>--}}
    {{--                            <h6 class="font-weight-medium">$10</h6>--}}
    {{--                        </div>--}}
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold">${{$cart->total}}</h5>
                            </div>
                            <form action="{{route('orders.store')}}" method="post">
                                @csrf
                                @auth()
                                    @role('admin')
                                        <a href="{{route('admin.index')}}" class="btn btn-block btn-primary my-3 py-3 font-semibold">
                                            Comprar
                                        </a>
                                    @else
                                        <button type="submit" class="btn btn-block btn-primary my-3 py-3 font-semibold">
                                            Comprar
                                        </button>
                                    @endrole
                                @endauth
                                @guest()
                                    <a href="{{route('login')}}" class="btn btn-block btn-primary my-3 py-3 font-semibold">
                                        Comprar
                                    </a>
                                @endguest


{{--                                <button type="submit" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!--End Cart-->
    @endsection
