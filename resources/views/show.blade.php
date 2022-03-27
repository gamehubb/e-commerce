@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="row">
                <aside class="col-sm-5 border-right">
                    <section class="gallery-wrap">
                        <div class="img-big-wrap">
                            <a href="#">
                                <img src="{{Storage::url($product->image)}}" alt="" width="100%">
                            </a>
                        </div>
                    </section>
                </aside>
                <aside class="col-sm-7">
                    <section class="card-body p-5">
                        <h4 class="title mb-3">
                            {{$product->name}}
                        </h4>
                        <p class="price-detail-wrap">
                            <span class="price h3 text-danger">
                                <span class="currency">{{$product->price}} MMK</span>
                            </span>
                        </p>
                        <h4>Description</h4>
                        <p>{!!$product->description!!}</p>
                        <h4>Additional Information</h4>
                        <p>{!!$product->additional_info!!}</p>
                        <hr>
                        <a href="{{ route('add.cart',[$product->id]) }}" class="btn btn-outline-success">Add to cart</a>
                    </section>
                </aside>
            </div>
        </div>
        @if(count($productFromSameCategories) > 0)
        <div class="jumbotron mt-3">
            <h3>You May Like This</h3>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($productFromSameCategories as $product)
                  <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{Storage::url($product->image)}}" alt="" style="height: 300px;
                        object-fit: contain;">
                        <div class="card-body">
                            <p><b>{{$product->name}}</b></p>
                            <p class="card-text">{!!Str::limit($product->description,120)!!}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/product/{{$product->id}}">
                                    <button type="button" class="btn btn-sm btn-outline-success">View</button>
                                    </a>
                                    <a href="{{ route('add.cart',[$product->id]) }}">
                                        <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button>
                                    </a>
                                </div>
                                <small class="text-muted">{{$product->price}} MMK</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
@endsection
