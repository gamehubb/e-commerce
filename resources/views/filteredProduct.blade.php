@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <div class="album py-2 ">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="card shadow-sm " style="background-color : #aa0000;border-radius : 25px; ">
                            <img src="{{Storage::url($product->productDetail->image_1)}}" alt=""
                                style=" object-fit: contain;border-radius : 25px;">
                            <div class="card-body text-white">
                                <p><b> {{$product->name}}</b></p>
                                <small> Colors- <input type="color" value={{$product->productDetail->color}} readonly></small>
                                <p><b>MMKs {{$product->price}} </b> </p>
                                <small class="card-text">{!!Str::limit($product->description,120)!!}</small>
                                <a href="{{ route('add.cart',[$product->id]) }}">
                                    <button type="button" class="btn btn-sm mx-auto  btn-outline-light mt-3"
                                        style="border-radius : 20px;">Add to Cart</button>
                                </a>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </main>
</div>
@endsection