@extends('layouts.app')

@section('content')
<style>
/* Parent Container */
.content_img{
 position: relative;

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

.main-container:hover .cat-img{
 opacity: 0.3;
 transform: scale(1.2);
}

.owl-dot span{
    background-color: red !important
}
.owl-dot.active span{
    background-color: rgb(119, 16, 16) !important
}
.owl-next,
.owl-prev{
    color : #fff !important;
    font-size: 80px !important;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
}

.owl-next {
    right: -21px;
    top: 29%;
}
.owl-prev{
    left: -21px;
    top: 29%;
}
.owl-theme .owl-nav [class*=owl-]:hover {
    background: #869791;
    color: #FFF;
    height: 0px;
    text-decoration: none;
}

.accordion-item {
    background-color: #202020;
    border: 1px solid rgba(0, 0, 0, 0.125);
}
.accordion-button {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    padding: 1rem 1.25rem;
    font-size: 0.9rem;
    color: #ffffff;
    text-align: left;
    background-color: #202020;
    border: 0;
    border-radius: 0;
    overflow-anchor: none;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, border-radius 0.15s ease;
}

.accordion-button:not(.collapsed) {
    color: #ff0000;
    background-color: #202020;
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.125);
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
  /* width: 50px; */
  margin: 29px -23px 0px 0px;
}
.fixed-button{
    position : fixed;
    bottom: 0;
    right: 30px;
    z-index: 100;
}

.image-zoom {
        overflow: hidden;
    }

.image-zoom {
    transition: transform 0.3s ease-in-out;
}

.image-zoom:hover {
    transform: scale(1.2);
}
.card {
    overflow: hidden;
}

.card {
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    border: 2px solid rgb(255, 102, 102)
}
.border-order{
    border : 2px solid rgb(255, 102, 102)
}
.border-order:hover{
    background-color: rgb(255, 102, 102)
}
.carousel-control-next {
        right: 0px;

}
.carousel-control-prev {
        left: 0;
}
@media screen and (max-width: 684px) {
    .carousel-control-next {
            right: 0px;
            top : -86px;
    }
    .carousel-control-prev {
            left: 0;
            top : -86px;
    }
}
.main-container{
    margin: 6% 0 0 36%;
    position: relative;
    width: 90%;
    overflow: hidden;
}
.overlay{
    position: absolute;
    bottom:0;
    left: 0;
    right: 0;

    background-color:  rgba(188, 5, 5, 0.384);
    overflow: hidden;
    width: 100%;
    height: 0;
    transition : .5s ease ;
    border-radius: 20px;
}

.main-container:hover .overlay{
    height: 100%;
}

</style>
<div class=" relative">
   
    <main>
        <section class="text-center " >
            <div class="">
                <div id="carouselExampleControls" class=
                "carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner text-white" style="overflow: hidden">

                        @foreach($sliders as $key=>$slider)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}" style="background: #381818">
                            <img src="{{Storage::url($slider->image)}}"
                                style="height:14rem; display: inline-block; !important" class=" " alt="...">
                                <div style="display: inline-flex;">
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <p  style=" font-size: 16px;" class="me-2 py-2 px-2">  {{$slider->products->moto}}</p>
                                          <a href="{{ route('productDetail',Crypt::encrypt($slider->products->id))}}" class=" py-2">
                                            <button type="button" class="btn btn-sm mx-auto text-white mt-10"
                                            style="border-radius : 20px 0px 0px 20px;background-color : #aa0000;">ViewDetail</button>

                                        </a>
                                      </div>
                                </div>
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
        <div class=" container">
            <div class="text-center mt-4">
                <h3 class="h4">EXPLORE</h3><br/>
            </div>

            <div class="slide-1 owl-carousel owl-theme px-3">

                        @foreach($categories as $category)
                        <div class="item">

                            <div class=" main-container m-auto">
                                <a href="{{ route('productCategory',[$category->slug]) }}" style="text-decoration: none">
                                    <img src={{Storage::url($category->image)}} style="border: 2px solid #aa0000; border-radius: 17px; height:7rem; width:7rem%; display: inline-block; !important;padding:10px 10px" class=" cat-img">
                                    <div class=" overlay text-white text-center" >
                                        <p class=" py-5">{{$category->name}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach

            </div><br>


            {{-- <div class="row ">
                    @foreach($categories as $category)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 my-2">

                        <div class="content_img m-auto">
                            <a href="{{ route('productCategory',[$category->slug]) }}">
                                <img src={{Storage::url($category->image)}} style="border: 2px solid #aa0000; border-radius: 17px; height:12rem; width:100%; display: inline-block; !important" class=" cat-img">
                                <div>{{$category->name}}</div>
                            </a>
                        </div>
                    </div>
                    @endforeach
            </div><br/> --}}

            <div class="row m-3">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 ">
                    <div class=" d-flex d-sm-flex d-md-none justify-content-center align-items-center">
                        <div class="row me-2 mb-5">
                            <div class="col-md-1 mt-2 text-center">
                                <i class="fa fa-truck fa-2x " style="color: #aa0000;"></i>
                            </div>
                            <div class="col-md-6 ml-4 text-center">
                                <label class="text-white text-sm">Product Import</label> <br />
                                <small class="text-white ">Thai, China</small>
                            </div>
                        </div>
                        <div class="row me-2 mb-5">
                            <div class="col-md-1 mt-2 text-center">
                                <i class="fa fa-bicycle fa-2x " style="color: #aa0000;"></i>
                            </div>
                            <div class="col-md-6 ml-4 text-center">
                                <label class="text-white ">Delivery</label> <br />
                                <small class="text-white ">Cash on delivery, Prepaid</small>
                            </div>
                        </div>
                        <div class="row me-2 mb-5">
                            <div class="col-md-1 mt-2 text-center">
                                <i class="fa  fa-hourglass-half fa-2x " style="color: #aa0000;"></i>
                            </div>
                            <div class="col-md-6 ml-4 text-center">
                                <label class="text-white ">Waiting Time</label> <br />
                                <small class="text-white ">3 weeks</small>
                            </div>
                        </div>
                    </div>
                    <div class=" row d-none d-sm-none d-md-block ">
                        <div class="row col-4 col-sm-4 col-md-12 mt-4 mb-4">
                            <div class="col-md-1 mt-2 me-4">
                                <i class="fa fa-truck fa-2x " style="color: #aa0000;"></i>
                            </div>
                            <div class="col-md-6 ml-4">
                                <label class="text-white ">Product Import</label> <br />
                                <small class="text-white ">Thai, China</small>
                            </div>
                        </div>
                        <div class="row col-4 col-sm-4 col-md-12 mt-4 mb-4">
                            <div class="col-md-1 mt-2 me-4">
                                <i class="fa fa-bicycle fa-2x " style="color: #aa0000;"></i>
                            </div>
                            <div class="col-md-6 ml-4">
                                <label class="text-white ">Delivery</label> <br />
                                <small class="text-white ">Cash on delivery, Prepaid</small>
                            </div>
                        </div>
                        <div class="row col-4 col-sm-4 col-md-12 mt-4 mb-4">
                            <div class="col-md-1 mt-2 me-4">
                                <i class="fa  fa-hourglass-half fa-2x " style="color: #aa0000;"></i>
                            </div>
                            <div class="col-md-6 ml-4">
                                <label class="text-white ">Waiting Time</label> <br />
                                <small class="text-white ">2 to 4 days</small>
                            </div>
                        </div>
                    </div>
                </div>

                    {{-- <div class="col-md-8 p-2" style="border:1px solid #808080; border-radius: 10px;">
                        <h3 class="h4 text-white text-center">Recommended product
                        </h3>
                        <a href="{{route('productDetail',[$product->id])}}">
                            <img src="{{Storage::url($product->productDetail[0]->image_1)}}"
                                class="floar-right m-3 mx-auto object-cover" style=" border-radius: 20px; height:12rem;" alt="...">
                        </a>
                        <div class="text-white text-left"><?php echo $product->description; ?></div>
                    </div> --}}
                
                    <div class="col-md-8 p-2" style="border:1px solid #808080; border-radius: 10px;">
                        <h3 class="h4 text-white text-center">Recommended Product
                        </h3>
    
                        <div id="carouselSliderControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner text-white">  
                                @foreach ($randomItemProducts as $key => $product )

                                        @if($product->productDetail[0]['image_1'] != "no-img")
                                        <div class="carousel-item {{$key ==1 ? 'active' : ''}}" >
                                            <a href="{{route('productDetail',Crypt::encrypt([$product->id]))}}">
                                                <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" class="m-auto p-image" alt="" style=" height: 200px;border-radius : 25px;display:block;">
                                            </a> 
                                            <div class="text-white text-left"><?php echo $product->name; ?></div>

                                        </div>
                                        @endif
                                @endforeach                    
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSliderControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselSliderControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
    


            <div class="text-center mt-4 mb-4">
                <span class="h4 text-white" style=" font-family: 'Times New Roman', Times, serif;">
                    Life is all about Ecommerce around you. Shop with us.
                </span>
            </div><br>

            <div class="w-full py-2 ">

                <div class="">
                    @if(!empty($product_list))

                        @foreach($product_list as $key => $product)

                             <p class="h4 text-white m-2 text-uppercase product-list">{{$product[0]->category->name}}
                        </p><br>
                            <div class=" row">
                                <div class=" slide-2 owl-carousel owl-theme">
                                    @foreach ($product as $key => $p_count)
                                        <div class="item" id="{{$product[$key]->id}}">
                                            <a href="{{ route('productDetail',Crypt::encrypt($product[$key]->id)) }}" class="m-auto link-light">

                                                <div class="card shadow-sm" style="background-color:#aa0000;border-radius : 25px;">

                                                    <div class="card-title">
                                                        <img src="{{Storage::url($product[$key]->productDetail[0]['image_1'])}}" alt=""
                                                        style="object-fit: contain;height:120px;width:100%; border-radius : 25px; filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7))" class=" image-zoom"


                                                         id="product_image" >
                                                    </div>
                                                    <div class="card-body text-white" style="height:150px;">
                                                        <p><b>{{$product[$key]->name}}</b></p>
                                                        <span class="hidden" style="display: none!important" id="logged-in">{{ auth()->check() ? '1' : '0'}}</span>
                                                                <p><b>{{number_format($product[$key]->productDetail[0]['price'])}} Ks</b></p>


                                                    </div>
                                                    <div class="card-footer"><a data-id = {{$product[$key]->id}} id="add_cart_{{$product[$key]->id}}"
                                                        class="btn btn-sm mx-auto border-order"
                                                        data-image="{{$product[$key]->productDetail[0]['image_1']}}"
                                                        data-color="{{$product[$key]->productDetail[0]['color']}}"
                                                        onclick="addCart({{$product[$key]->id}})"
                                                            style="border-radius : 20px;color:white">Add to cart</a>
                                                        <span class="fa-solid fa-check text-info" id="done" hidden=""></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    @endforeach

                                </div>
                            </div><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
    <p class="float-end">
        <a href="#"> </a>
    </p>
   
</div>


{{-- owl carousel --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="{{asset('js/jquery/jquery.min.js')}}"></script> --}}

<script type="text/javascript">

    $(document).ready(function() {
        $('.slide-1').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:false,

            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 6
                }
            }
        });
        $('.slide-2').owlCarousel({
            loop: false,
            margin: 20,
            nav: true,
            dots : false,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:false,

            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 2
                },
                766: {
                    items : 3
                },
                1000: {
                    items: 5
                }
            }
        })
    });

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
