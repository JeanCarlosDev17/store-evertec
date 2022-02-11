@extends('nav')
@section('content')

{{--    <div class="wrapper mt-8 px-8">--}}
{{--        <div class="flex flex-wrap justify-content-start -my-4 -mx-2">--}}
{{--            @forelse ($products as $product)--}}
{{--                <div class="w-full sm:w-1/2 md:w-1/3 mb-4 px-2">--}}
{{--                    <!-- card -->--}}
{{--                    <div class=" relative h-full flex flex-col rounded-lg overflow-hidden bg-white shadow">--}}
{{--                        <!-- card cover -->--}}

{{--                        <img class="h-56 w-full object-cover" src="https://images.unsplash.com/photo-1514897575457-c4db467cf78e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=384" alt="" />--}}

{{--                        <!-- end card cover -->--}}

{{--                        <!-- card content -->--}}

{{--                        <div class="flex-1 px-6 py-4">--}}
{{--                            <div>--}}
{{--                                <div class="font-bold text-lg mb-2">Card Title- {{$product->name}}</div>--}}
{{--                                <p class="text-md text-gray-800 mt-0 font-bold">${{number_format((float)$product->price, 0,".", ",")}}</p>--}}
{{--                                <p class="text-gray-700 text-base">{{$product->description}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- end card content -->--}}

{{--                        <!-- card footer -->--}}

{{--                        <div class="px-6 py-4 bg-gray-100">--}}
{{--                            <button type="button" class="bg-blue-600 hover:bg-blue-700 py-2 px-4 text-sm font-medium text-white border border-transparent rounded-lg focus:outline-none">Action</button>--}}
{{--                        </div>--}}

{{--                        <!-- end card footer -->--}}
{{--                    </div>--}}
{{--                    <!-- end card -->--}}
{{--                </div>--}}

{{--            @empty--}}
{{--                <p>Tienda vacia no hay productos</p>--}}
{{--            @endforelse--}}







{{--            <div class="w-full sm:w-1/2 md:w-1/3 mb-4 px-2">--}}
{{--                <!-- card -->--}}
{{--                <div class="h-full flex flex-col rounded-lg overflow-hidden bg-white shadow">--}}
{{--                    <!-- card cover -->--}}

{{--                    <img class="h-56 w-full object-cover" src="https://images.unsplash.com/photo-1514897575457-c4db467cf78e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=384" alt="" />--}}

{{--                    <!-- end card cover -->--}}

{{--                    <!-- card content -->--}}

{{--                    <div class="flex-1 px-6 py-4">--}}
{{--                        <div class="font-bold text-xl mb-2">Card Title</div>--}}
{{--                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>--}}
{{--                    </div>--}}

{{--                    <!-- end card content -->--}}

{{--                    <!-- card footer -->--}}

{{--                    <div class="px-6 py-4 bg-gray-100">--}}
{{--                        <button type="button" class="bg-blue-600 hover:bg-blue-700 py-2 px-4 text-sm font-medium text-white border border-transparent rounded-lg focus:outline-none">Action</button>--}}
{{--                    </div>--}}

{{--                    <!-- end card footer -->--}}
{{--                </div>--}}
{{--                <!-- end card -->--}}
{{--            </div>--}}
{{--            <div class="w-full sm:w-1/2 md:w-1/3 mb-4 px-2">--}}
{{--                <!-- card -->--}}
{{--                <div class="h-full flex flex-col rounded-lg overflow-hidden bg-white shadow">--}}
{{--                    <!-- card cover -->--}}

{{--                    <img class="h-56 w-full object-cover" src="https://images.unsplash.com/photo-1514897575457-c4db467cf78e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=384" alt="" />--}}

{{--                    <!-- end card cover -->--}}

{{--                    <!-- card content -->--}}

{{--                    <div class="flex-1 px-6 py-4">--}}
{{--                        <div class="font-bold text-xl mb-2">Card Title</div>--}}
{{--                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>--}}
{{--                    </div>--}}

{{--                    <!-- end card content -->--}}

{{--                    <!-- card footer -->--}}

{{--                    <div class="px-6 py-4 bg-gray-100">--}}
{{--                        <button type="button" class="bg-blue-600 hover:bg-blue-700 py-2 px-4 text-sm font-medium text-white border border-transparent rounded-lg focus:outline-none">Action</button>--}}
{{--                    </div>--}}

{{--                    <!-- end card footer -->--}}
{{--                </div>--}}
{{--                <!-- end card -->--}}
{{--            </div>--}}
{{--            <div class="w-full sm:w-1/2 md:w-1/3 mb-4 px-2">--}}
{{--                <!-- card -->--}}
{{--                <div class="h-full flex flex-col rounded-lg overflow-hidden bg-white shadow">--}}
{{--                    <!-- card cover -->--}}

{{--                    <img class="h-56 w-full object-cover" src="https://images.unsplash.com/photo-1514897575457-c4db467cf78e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=384" alt="" />--}}

{{--                    <!-- end card cover -->--}}

{{--                    <!-- card content -->--}}

{{--                    <div class="flex-1 px-6 py-4">--}}
{{--                        <div class="font-bold text-xl mb-2">Card Title</div>--}}
{{--                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>--}}
{{--                    </div>--}}

{{--                    <!-- end card content -->--}}

{{--                    <!-- card footer -->--}}

{{--                    <div class="px-6 py-4 bg-gray-100">--}}
{{--                        <button type="button" class="bg-blue-600 hover:bg-blue-700 py-2 px-4 text-sm font-medium text-white border border-transparent rounded-lg focus:outline-none">Action</button>--}}
{{--                    </div>--}}

{{--                    <!-- end card footer -->--}}
{{--                </div>--}}
{{--                <!-- end card -->--}}

{{--            </div>--}}

{{--        <div class="min-h-screen bg-gray-100 flex flex-col justify-center">--}}
{{--            <div class="relative m-3 flex flex-wrap mx-auto justify-center">--}}

{{--                <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">--}}
{{--                    <div class="overflow-x-hidden rounded-2xl relative">--}}
{{--                        <img class="h-40 rounded-2xl w-full object-cover" src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">--}}
{{--                        <p class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group" style="top:1rem;right: 1rem;cursor: pointer;">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-50 opacity-70" fill="none" viewBox="0 0 24 24" stroke="black">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />--}}
{{--                            </svg>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 pl-2 mb-2 flex justify-between ">--}}
{{--                        <div>--}}
{{--                            <p class="text-lg font-semibold text-gray-900 mb-0">Product Name</p>--}}
{{--                            <p class="text-md text-gray-800 mt-0">$340</p>--}}
{{--                        </div>--}}
{{--                        <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-70" fill="none" viewBox="0 0 24 24" stroke="gray">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                            </div>
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

