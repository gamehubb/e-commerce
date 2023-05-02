@extends('layouts.app')

@section('content')
    <div class="container">
            <form action="{{route('more.product')}}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" placeholder="Search....">
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-secondary">Search</button>
                    </div>
                </div>
            </form>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($products as $product)
              <div class="col">
                <div class="card shadow-sm">
                    <img src="{{Storage::url($product->image)}}" alt="" style="object-fit: contain;height:120px;width:100%; border-radius : 25px; filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7))">
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
        <div class="paginate mt-3">
            {{$products->links()}}
        </div>
    </div>
@endsection
