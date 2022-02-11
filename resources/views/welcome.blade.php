@extends('nav')
@section('content')



<!-- Page Header Start -->
{{--<div class="container-fluid bg-secondary mb-5">--}}
{{--    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">--}}
{{--        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>--}}
{{--        <div class="d-inline-flex">--}}
{{--            <p class="m-0"><a href="">Home</a></p>--}}
{{--            <p class="m-0 px-2">-</p>--}}
{{--            <p class="m-0">Shop</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <!-- Shop Product Start -->
        <div class="col-lg-12 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar por nombre">
                                <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <a href=""><i class="fa fa-search"></i></a>
                                        </span>
                                </div>
                            </div>
                        </form>
{{--                        <div class="dropdown ml-4">--}}
{{--                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"--}}
{{--                                    aria-expanded="false">--}}
{{--                                Ordenar por--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">--}}
{{--                                <a class="dropdown-item" href="#">Latest</a>--}}
{{--                                <a class="dropdown-item" href="#">Popularity</a>--}}
{{--                                <a class="dropdown-item" href="#">Best Rating</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
{{--                @forelse($products->where('code','COD414931') as $product)--}}
                @forelse($products->where('state','!=','inactive') as $product)

                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{isset($product->image) ? asset($product->image->url()) : asset('img/productDefault.png')}}" alt="Producto ">
                            </div>
                            <!--Card Body-->
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>$123.00</h6><h6 class="text-muted ml-2"><del>{{number_format((float)$product->price,0,'.',',')}}</del></h6>
                                </div>


                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Ver Detalles</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Añadir al Carrito</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Tienda vacia, Actualizaciones Pronto...</h2>
                @endforelse


                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <div class="d-flex justify-content-center">
                            {!! $products->links() !!}
                        </div>

                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->


@stop

