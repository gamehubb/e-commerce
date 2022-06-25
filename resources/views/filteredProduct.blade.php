@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <div class="album">
            <div class="container">
                @if(Request::path() == 'search')
                    <p class="h2 text-center text-white">You search result for keyword "{{$name}}" </p><br><br>
                @else
                    <h3 class="h3 text-uppercase">{{$name}}</h3><br><br>
                @endif
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    
                    @if(count($products) != 0)
                    @foreach($products as $product)
                    <div class="col-md-2">
                        <a href="{{ route('productDetail',[$product->id]) }}" class="m-auto">
                        <div class="card shadow-sm " style="background-color : #aa0000;border-radius : 25px; ">
                            <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" alt=""
                                style=" object-fit: contain;border-radius : 25px;filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7))">
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
                    @else
                    <p class="h2 text-center text-white m-auto">No search results found</p>
                    @endif
                </div>
            </div>

        </div>

    </main>
</div>
@endsection