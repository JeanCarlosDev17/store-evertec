@extends('nav')
    @section('css')
        <link rel="stylesheet" href="{{asset('css/productDetail.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    @endsection
    @section('content')
            <x-Admin.validationErrors :errors="$errors"></x-Admin.validationErrors>
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <div class = "card-wrapper">
                    <div class = "card">
                        <!-- card left -->
                        <div class = "product-imgs">
{{--                            {{dd($product->images())}}--}}

                            <div class = "img-display">
                                <div class = "img-showcase">
                                    @php
                                        $count=0;
                                    @endphp
                                    @forelse($product->images as $image)
                                                <img src = "{{asset($image->url())}}" alt = "product image">
                                    @empty
                                        <img src = "{{asset('img/productDefault.png')}}" alt = "product image default">
                                        <img src = "{{asset('img/productDefault.png')}}" alt = "product image default">

                                    @endforelse

                                </div>
                            </div>
                            <div class = "img-select" style="max-height: 170px">

                                @php
                                    $count=0;
                                @endphp
                                @forelse($product->images as $image)



                                    @php
                                        $count=$count+1;

                                    @endphp
                                    <div class = "img-item">
                                        <a href = "#" data-id = "{{$count}}">
                                            <img src = "{{asset($image->url())}}" alt = "product image" style="max-height: 100%;width: auto ">
                                        </a>
                                    </div>

                                @empty
                                    <div class = "img-item">
                                        <a href = "#" data-id = "1">
                                            <img src = "{{asset('img/productDefault.png')}}" alt = "default image" style="max-height: 100%; width: auto">
                                        </a>
                                    </div>

{{--                                    <h2>sin imagenes...</h2>--}}

                                @endforelse
{{--                                <div class = "img-item">--}}
{{--                                    <a href = "#" data-id = "1">--}}
{{--                                        <img src = "{{asset('img/shoes_images/shoe_1.jpg')}}" alt = "shoe image">--}}
{{--                                    </a>--}}
{{--                                </div>--}}

                            </div>
                        </div>
                        <!-- card right -->
                        <div class = "product-content">
                            <h2 class = "product-title">{{$product->name}}</h2>
{{--                            <a href = "#" class = "product-link">visit nike store</a>--}}
{{--                            <div class = "product-rating">--}}
{{--                                <i class = "fas fa-star"></i>--}}
{{--                                <i class = "fas fa-star"></i>--}}
{{--                                <i class = "fas fa-star"></i>--}}
{{--                                <i class = "fas fa-star"></i>--}}
{{--                                <i class = "fas fa-star-half-alt"></i>--}}
{{--                                <span>4.7(21)</span>--}}
{{--                            </div>--}}

                            <div class = "product-price">
                                <p class = "last-price">Old Price: <span>${{$product->formatPrice()}}</span></p>
                                <p class = "new-price">New Price: <span>${{$product->formatDiscount()}} (-{{$product->discount}}%)</span></p>
                            </div>

                            <div class = "product-detail">
                                <h2>Sobre el producto: </h2>
                                <p style="opacity: 1">{{$product->description}}</p>
                                <ul>
{{--                                    <li>Color: <span>Black</span></li>--}}
                                    <li style="opacity: 1">
                                        Available: <span>{{$product->quantity}} in stock</span>
                                    </li>
{{--                                    <li>Category: <span>Shoes</span></li>--}}
{{--                                    <li>Shipping Area: <span>All over the world</span></li>--}}
{{--                                    <li>Shipping Fee: <span>Free</span></li>--}}
                                </ul>
                            </div>

                            <div class="purchase-info row">
                                <form method="post" action="{{route('products.cart.store',$product->id)}}">
                                    @csrf
{{--                                    <input type="number" min="1" max="{{$product->quantity}}" value="1" name="quantity">--}}
                                    <button type="submit" class="btn bg-primary">
                                        Añadir al Carrito <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>

                                {{--                                <button type = "button" class = "btn">Compare</button>--}}
                            </div>

{{--                            <div class = "social-links">--}}
{{--                                <p>Share At: </p>--}}
{{--                                <a href = "#">--}}
{{--                                    <i class = "fab fa-facebook-f"></i>--}}
{{--                                </a>--}}
{{--                                <a href = "#">--}}
{{--                                    <i class = "fab fa-twitter"></i>--}}
{{--                                </a>--}}
{{--                                <a href = "#">--}}
{{--                                    <i class = "fab fa-instagram"></i>--}}
{{--                                </a>--}}
{{--                                <a href = "#">--}}
{{--                                    <i class = "fab fa-whatsapp"></i>--}}
{{--                                </a>--}}
{{--                                <a href = "#">--}}
{{--                                    <i class = "fab fa-pinterest"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endsection

    @section('js')
        <script src="{{asset('js/productDetail.js')}}"></script>
    @endsection
