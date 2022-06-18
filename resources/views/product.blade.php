@extends('layouts.app')

@section('content')
<style>
/* Parent Container */
.content_img{
 position: relative;
 width: 15rem;
 }

/* Child Text Container */
.content_img div{
 position: absolute;
 bottom: 6px;
 right: 27px;
 background: black;
 color: white;
 margin-bottom: 5px;
 font-family: sans-serif;
 opacity: 0;
 visibility: hidden;
 -webkit-transition: visibility 0s, opacity 0.5s linear; 
 transition: visibility 0s, opacity 0.5s linear;
}

/* Hover on Parent Container */
.content_img:hover{
 cursor: pointer;
}

.content_img:hover div{
 width: 150px;
 padding: 8px 15px;
 visibility: visible;
 opacity: 0.7; 
 background:#aa0000;
 color:#fff;
}
</style>
<div class="container">
    <main>
        <section class="text-center">
            <div class="container">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($sliders as $key=>$slider)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                            <img src="{{Storage::url($slider->image)}}"
                                style="height:12rem; display: inline-block; !important" alt="...">
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
        {{-- {{-- @foreach($categories as $category)
        <div class="img-container">
            <a href="{{ route('productCategory',[$category->slug]) }}">
            <img src="{{Storage::url($category->image)}}" class="m-3"
                style=" border: 2px solid #aa0000; border-radius: 17px; height:12rem; display: inline-block; !important"
                alt="..." class="image">
            </a>    
            <div class="middle">
                <div class="text">{{$category->name}}</div>
            </div>
        </div>
         -- }} --}}
        <div class="row text-center">
        @foreach($categories as $category)

            <div class="content_img">
                <img src={{Storage::url($category->image)}} style="border: 2px solid #aa0000; border-radius: 17px; height:12rem; display: inline-block; !important">
                <div>{{$category->name}}</div>
            </div>
        @endforeach
        </div>

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
            @foreach ($randomItemProducts as $product )
                
                <div class="col-md-8 p-2" style="border:1px solid #808080; border-radius: 10px;">
                    <p class="h4 text-white text-center" style=" font-family: 'Times New Roman', Times, serif;">RECOMMENDED
                    </p>
                    <hr class="mx-auto" style="width:75%; color: #aa0000; height: 3px; ">
                    <a href="{{route('productDetail',[$product->id])}}">
                        <img src="{{Storage::url($product->productDetail[0]->image_1)}}"
                            class="floar-right m-3 mx-auto" style=" border-radius: 20px; height:12rem; " alt="...">
                    </a>
                </div>

            @endforeach

           
        <div class="text-center mt-4">
            <span class="h4 text-white" style=" font-family: 'Times New Roman', Times, serif;">
                Life is all about Ecommerce around you. Shop with us.
            </span>
        </div><br>

        <div class="album py-2 ">
            <div class="container">
                @foreach($product_list as $key => $product)
                {{-- @for ($x = 0; $x <= count($product); $x++) --}}

                    
                <h1 class="text-white m-4">{{$product[0]->category->name}}
                    <hr class="mx-auto" style="color: #aa0000; height: 3px; padding:2;margin:10px; ">
                </h1>
                    
                <br>

                    
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($product as  $key => $p_count)
                        <div class="col-md-2">
                            <a href="{{ route('productDetail',[$product[$key]->id]) }}" class="m-auto">
                                <div class="card shadow-sm" style="background-color : #aa0000;border-radius : 25px; ">
                                    <img src="{{Storage::url($product[$key]->productDetail[0]['image_1'])}}" alt=""
                                        style=" object-fit: contain;border-radius : 25px;">
                                    <div class="card-body text-white">
                                        <p><b> {{$product[$key]->name}}</b></p>
                                        <p><b>MMKs {{number_format($product[$key]->productDetail[0]['price'])}}</b></p>                   
                                        <a href="{{ route('add.cart',[$product[$key]->id]) }}">
                                            <button type="button" class="btn btn-sm mx-auto  btn-outline-light mt-3"
                                                style="border-radius : 20px;">Add to cart</button>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach

                </div>



                {{-- @endfor --}}
                @endforeach

            </div>
        </div>
    </main>
    <p class="float-end">
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
                            @foreach ($allCategory as $category )
                            <a href="{{ route('productCategory',[$category->slug]) }}">
                              <p>{{$category->name}}</p> 
                            </a>
                            @endforeach
                           
                        </div>
                        <div class="col-md-4  mt-2">
                            <p><b>Brand</b></p>
                            @foreach ($allBrand as $brand )
                            <a href="{{ route('productBrand',[$brand->slug]) }}">
                                <p> {{$brand->name}}  </p> 
                            </a>
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