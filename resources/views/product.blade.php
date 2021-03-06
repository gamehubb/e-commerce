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

.content_img:hover .cat-img{
 opacity: 0.3;
}

.product-list{
  display: flex;
  text-align: left;
  color: #fff;
}

.product-list::before {
  content: "";
  display: inline-block;
  border-bottom: 4px solid #aa0000;
  width: 50px;
  margin: 29px -23px 0px 0px;
}

</style>
<div class="container">
    <main>
        <section class="text-center">
            <div class="container">
                <div id="carouselExampleControls" class=
                "carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner text-white">
                  
                        @foreach($sliders as $key=>$slider)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}" style="border-radius: 20px; background: #381818">
                            <div style="display: inline-flex;">
                          <p  style=" font-size: 20px;  ">  {{$slider->products->moto}}</p>
                          <a href="{{ route('productDetail',[$slider->products->id])}}">
                            <button type="button" class="btn btn-sm mx-auto  text-white mt-10"
                            style="border-radius : 20px;background-color : #aa0000;">View detail</button>
                           
                        </a>
                            </div>
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
        </section><br><br>
        <div class="text-center mt-4">
            <h3 class="h4">EXPLORE</h3><br/>
        </div>
        
        <div class="row text-center">
                @foreach($categories as $category)
                <div class="col-md-2 m-2">

                    <div class="content_img m-auto">
                        <a href="{{ route('productCategory',[$category->slug]) }}">
                            <img src={{Storage::url($category->image)}} style="border: 2px solid #aa0000; border-radius: 17px; height:12rem; display: inline-block; !important" class="cat-img">
                            <div>{{$category->name}}</div>
                        </a>
                    </div>
                </div>
                @endforeach
        </div><br/>

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
                    <h3 class="h4 text-white text-center">Recommended product
                    </h3>
                    <a href="{{route('productDetail',[$product->id])}}">
                        <img src="{{Storage::url($product->productDetail[0]->image_1)}}"
                            class="floar-right m-3 mx-auto" style=" border-radius: 20px; height:12rem; " alt="...">
                    </a>
                    <div class="text-white text-left"><?php echo $product->description; ?></div>
                </div>

            @endforeach

           
        <div class="text-center mt-4">
            <span class="h4 text-white" style=" font-family: 'Times New Roman', Times, serif;">
                Life is all about Ecommerce around you. Shop with us.
            </span>
        </div><br>

        <div class="album py-2 ">

            <div class="container">
                @if(!empty($product_list))
                   
                    @foreach($product_list as $key => $product)
                    {{-- @for ($x = 0; $x <= count($product); $x++) --}}
                         <p class="h4 text-white m-2 text-uppercase product-list">{{$product[0]->category->name}}
                    </p><br>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach ($product as $key => $p_count)
                                <div class="col-md-3" id="{{$product[$key]->id}}">
                                    <a href="{{ route('productDetail',[$product[$key]->id]) }}" class="m-auto link-light">
                                        <div class="card shadow-sm" style="background-color : #aa0000;border-radius : 25px; ">
                                            <img src="{{Storage::url($product[$key]->productDetail[0]['image_1'])}}" alt=""
                                                style="object-fit: cover;border-radius : 25px; filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7))"
                                               

                                                 id="product_image" >
                                            <div class="card-body text-white">
                                                <p><b> {{$product[$key]->name}}</b></p>
                                                <span class="hidden" id="logged-in">{{ auth()->check() ? '1' : '0'}}</span>
                                                <p><b>MMKs {{number_format($product[$key]->productDetail[0]['price'])}}</b></p>                   
                                                <a data-id = {{$product[$key]->id}} id="add_cart_{{$product[$key]->id}}"
                                                    class="btn btn-sm mx-auto btn-outline-light mt-3" 
                                                    data-image="{{$product[$key]->productDetail[0]['image_1']}}"
                                                    data-color="{{$product[$key]->productDetail[0]['color']}}"
                                                    onclick="addCart({{$product[$key]->id}})"
                                                        style="border-radius : 20px;">Add to cart</a>
                                                <span class="fa-solid fa-check text-info" id="done" hidden></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            @endforeach

                        </div><br>



                    {{-- @endfor --}}
                    @endforeach
                @endif

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
                    <label>A place where you can shop and download free games in this gaming community. </label>
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
                <p><i class="fa fa-phone"></i> Call Us: 09963325033,09403113003 </p>
            </div>
            <div class="col-md-4 text-right">
                <p><i class="fa fa-envelope"></i> Mail Us: info@gamehubmyanmar.shop </p>
            </div>
        </div>
    </footer>
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">

function addCart(id){

    var product_id = document.getElementById('add_cart_'+id).getAttribute('data-id');
    var logged_in = $("#logged-in").text();

    var color = document.getElementById('add_cart_'+id).getAttribute('data-color');
    var image = document.getElementById('add_cart_'+id).getAttribute('data-image');


    if(product_id != '' && logged_in != 0){

        $.ajax({
            type: "POST",
            url: '/addToCart',
            data: {'product_id': product_id,'image' :image, 'color': color},

        beforeSend: function(){
            $("#cart-loader").css("display",'grid');
        },
        success: function( response ) {
            if(response == 'ok'){
                $("#cart-loader").css("display",'none');
                location.reload();
            }
        },
        });
    }else{
        location.href = '/login';
    }

}
    

</script>
@endsection