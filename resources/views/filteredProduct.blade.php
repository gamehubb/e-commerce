@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <div class="album py-2 ">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                    <div class="col-md-2">
                        <a href="{{ route('productDetail',[$product->id]) }}" class="m-auto">
                        <div class="card shadow-sm " style="background-color : #aa0000;border-radius : 25px; ">
                            <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" alt=""
                                style=" object-fit: contain;border-radius : 25px;">
                            <div class="card-body text-white">
                                <p><b> {{$product->name}}</b></p>
                                <p><b>MMKs {{$product->productDetail[0]['price']}} </b> </p>                         
                                <a href="{{ route('add.cart',[$product->id]) }}">
                                    <button type="button" class="btn btn-sm mx-auto  btn-outline-light mt-3"
                                        style="border-radius : 20px;">Add to cart</button>
                                </a>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </main>
</div>
@endsection