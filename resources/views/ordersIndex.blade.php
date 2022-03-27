@extends('nav')
@section('content')
    <!--Start cart-->
    <x-Admin.validationErrors :errors="$errors"></x-Admin.validationErrors>
    <div class="container-fluid pt-5">
        @if(!isset($orders) || $orders->isEmpty())
            <div class="alert">No hay productos en la orden</div>
        @else
            <div class="row px-xl-5">

                <div class="col-lg-12 table-responsive mb-5">


                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                        <tr>
                            <th>fecha</th>
                            <th>Cantidad de Productos</th>
                            <th>Precio total</th>
                            <th>Estado</th>
                            <th>Ver</th>


                        </tr>
                        </thead>
                        <tbody class="align-middle">
                        @foreach($orders as $order)

                            <tr>
                                <td class="align-middle">
{{--                                    {{$order->created_at}}--}}
{{--                                    @dump($order)--}}
                                    {{$order->createdAt}}
                                </td>
                                <td class="align-middle">{{$order->count}}</td>
                                <td class="align-middle">${{$order->total}}</td>
                                <td class="align-middle">{{$order->state}}</td>
<!--                                TODO: cambiar  de  status a state-->
                                <td class="align-middle">
                                    <a href="{{route('orders.show',[$order->id])}}" class="btn btn-success">Ir</a>

                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>




                </div>
                <div class="col- pb-1">
                    <nav aria-label="Page navigation">
                        <div class="d-flex justify-content-center font-semibold ">

                            @if(count($orders)>0)
                                {!! $orders->links() !!}
                            @endif
                        </div>

                    </nav>
                </div>
            </div>
        @endif
    </div>
    <!--End Cart-->
@endsection
