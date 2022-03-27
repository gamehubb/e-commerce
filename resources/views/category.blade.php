@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Products</h2>
        <div class="row">
            <div class="col-md-2">
                @foreach($subcategories as $subcategory)
                <form action="/category/{{$slug}}" method="GET">
                    <p><input type="checkbox" name="subcategory[]" value="{{$subcategory->id}}"
                        @if(isset($filterSubCategories))
                            {{in_array($subcategory->id,$filterSubCategories)?'checked ="checked" ': ''}}
                        @endif
                        >{{$subcategory->name}}</p>
                    @endforeach
                    <input type="submit" value="filter" class="btn btn-success">
                </form>
                <hr>
                <h2>Filter By Price</h2>
                <form action="/category/{{$slug}}" method="GET">
                   <input type="text" name="min" class="form-control" placeholder="Enter Minimum Price" required>
                   <br>
                   <input type="text" name="max" class="form-control" placeholder="Enter Maximum Price" required>
                   <br>
                   <input type="hidden" name="categoryId" value="{{$categoryId}}" class="form-control">
                   
                   <input type="submit" value="filter" class="btn btn-secondary">
                </form>
                <hr>
                <a href="/category/{{$slug}}" class="btn btn-primary">Back</a>
            </div>
            <div class="col-md-10">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shdow-sm">
                            <img src="{{Storage::url($product->image)}}" alt="" width="100%" height="200">
                            <div class="card-body">
                                <p><b>{{$product->name}}</b></p>
                                <p class="card-text">{!!Str::limit($product->description,120)!!}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/product/{{$product->id}}"><button type="button" class="btn btn-sm btn-outline-success">
                                            View</button>
                                        </a>
                                        <a href="{{ route('add.cart',[$product->id]) }}">
                                        <button type="button" class="btn btn-sm btn-outline-primary">Add To Cart</button>
                                    </a>
                                    </div>
                                    <small class="text-muted">{{$product->price}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection