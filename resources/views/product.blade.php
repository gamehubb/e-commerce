@extends('layouts.app')

@section('content')
    <div class="container">
        <main>
            <section class="py-5 text-center container">
                <div class="container">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        @foreach($sliders as $key=>$slider)
                          <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                            <img src="{{Storage::url($slider->image)}}" class="d-block w-100" alt="...">
                          </div>
                        @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div> 
                </div>
            </section>
            <h2>Category</h2>
            @foreach($categories as $category)
                <a href="/category/{{$category->slug}}"><button class="btn btn-secondary">{{$category->name}}</button></a>
            @endforeach
            <div class="album py-5 bg-light">
                <div class="container">
                    <h2>Products</h2>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach($products as $product)
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
                <center class="mt-5">
                    <a href="{{route('more.product')}}">
                        <button class="btn btn-success">More Products</button></center>
                    </a>
            </div>
            <div class="jumbotron">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                              @foreach($randomActiveProducts as $product)
                              <div class="col-4">
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
                        <div class="carousel-item">
                            <div class="row">
                              @foreach($randomItemProducts as $product)
                              <div class="col-4">
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
                                              <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button>
                                          </div>
                                          <small class="text-muted">{{$product->price}} MMK</small>
                                      </div>
                                  </div>
                              </div>
                              </div>
                              @endforeach
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </main>
        <footer class="text-muted py-5">
            <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
            <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.1/getting-started/introduction/">getting started guide</a>.</p>
            </div>
        </footer>
    </div>
@endsection
