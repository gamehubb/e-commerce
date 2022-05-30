@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <section class="text-center">
            <div class="container">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($sliders as $key=>$slider)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                            <img src="{{Storage::url($slider->productDetail->image_1)}}"
                                style="  height:12rem; display: inline-block; !important" alt="...">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <div class="text-center mt-4">
            <span class="h4 text-white" style=" font-family: 'Times New Roman', Times, serif;">EXPLORE</span>
            <hr class="mx-auto" style="width:10%; color: #aa0000; height: 3px; ">
        </div>
        @foreach($categories as $category)
        <img src="{{Storage::url($category->image)}}" class="m-3"
            style=" border: 2px solid #aa0000; border-radius: 17px; height:12rem; display: inline-block; !important"
            alt="...">
        @endforeach
        <div class="row m-3">
            <div class="col-md-4 m-10">
                <div class="row m-4">
                    <div class="col-md-1 mt-2">
                        <i class="fa fa-truck fa-2x " style="color: #aa0000;"></i>
                    </div>
                    <div class="col-md-6 ml-4">
                        <label class="text-white ">Product Import</label> <br />
                        <small class="text-white ">Thai, China</small>
                    </div>
                </div>
                <div class="row  m-4">
                    <div class="col-md-1 mt-2">
                        <i class="fa fa-bicycle fa-2x " style="color: #aa0000;"></i>
                    </div>
                    <div class="col-md-6 ml-4">
                        <label class="text-white ">Delivery</label> <br />
                        <small class="text-white ">Cash on delivery, Prepaid</small>
                    </div>
                </div>
                <div class="row  m-4">
                    <div class="col-md-1 mt-2">
                        <i class="fa  fa-hourglass-half fa-2x " style="color: #aa0000;"></i>
                    </div>
                    <div class="col-md-6 ml-4">
                        <label class="text-white ">Waiting Time</label> <br />
                        <small class="text-white ">2 weeks, 3 weeks</small>
                    </div>
                </div>
            </div>
            <div class="col-md-8 p-2" style="border:1px solid #808080; border-radius: 10px;">
                <P class="h4 text-white text-center" style=" font-family: 'Times New Roman', Times, serif;">RECOMMENDED
                </p>
                <hr class="mx-auto" style="width:75%; color: #aa0000; height: 3px; ">
                <img src="{{Storage::url('public/files/xCCWSBMZi929D5ZL1RH4Tqoc7luuNjcpJtqbqNex.png')}}"
                    class="floar-right m-3 mx-auto" style=" border-radius: 20px; height:12rem; " alt="...">
            </div>
        </div>
        <div class="text-center mt-4">
            <span class="h4 text-white" style=" font-family: 'Times New Roman', Times, serif;">
                Life is all about Ecommerce around you. Shop with us.
            </span>
        </div>

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
                                        style="border-radius : 20px;">Shop Now</button>
                                </a>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- <div class="jumbotron">
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
            </div> -->

    </main>
    <p class="float-end p-3">
        <a href="#"> <i class="fa fa-chevron-circle-up fa-2x " style="color: #aa0000;"></i></a>
    </p>
    <footer class="py-4 mt-5 text-white" style="background-color : #202020; border-radius: 10px">
        <div class="row">
            <div class="col-md-7">
                <div class="container ">
                    <span class="h1" style="color: #aa0000;">GM <label class="h6 text-white">GAMEHUB
                            MYANMAR</label></span> <br />
                    <label>A place where you can shop and download free games in this gaminig community. </label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="container text-white">
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <p><b>Category</b></p>
                            @foreach ($categories as $category )
                               {{$category->name}}
                            @endforeach
                           
                        </div>
                        <div class="col-md-4  mt-2">
                            <p><b>Brand</b></p>
                            @foreach ($brands as $brand )
                               {{$brand->name}}
                            @endforeach
                        </div>
                        <div class="col-md-4  mt-2">
                            <p><b>Company</b></p>
                            <p> Terms & Condition </p>
                            <p> Privacy Policy </p>
                            <p> Supplier Relations </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" container row mt-10">
            <div class="col-md-4">
                <p><i class="fa fa-clock"></i> Office Hour : 9AM to 5PM </p>
            </div>
            <div class="col-md-4 text-center ">
                <p><i class="fa fa-phone"></i> Call Us: 0996332033,0996332033 </p>
            </div>
            <div class="col-md-4 text-right">
                <p><i class="fa fa-envelope"></i> Mail Us: info@gmaihubmyanmar.com </p>
            </div>
        </div>
    </footer>
</div>
@endsection