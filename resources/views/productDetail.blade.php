@extends('layouts.app')

@section('content')
<style>
        /* The Modal (background) */
    #myModal1 {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    #modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
    }

    @-webkit-keyframes zoom {
      from {-webkit-transform:scale(0)}
      to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
      from {transform:scale(0)}
      to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }

    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
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

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
      .modal-content {
        width: 100%;
      }
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
        .border-order{
            border : 2px solid rgb(255, 102, 102)
        }
        .border-order:hover{
            background-color: rgb(255, 102, 102)
        }
    </style>
<div class=" container">
    <div class=" row g-3 text-white p-4 bg-dark" style="border-radius:4px;">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center p-2" style="border-width: 1px; border-color: rgb(27, 27, 27); border-radius : 25px;">
            @foreach ($products->productDetail as $key=> $item)
            <div class="imgdiv"  id = "imgdiv{{$key}}"  style=" {{$key ==0 ? '' : 'display:none'}}">
               <div id="carouselExampleControls{{$key}}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" >
                    @for ($i = 1; $i <= 3; $i++)
                    @if($products->productDetail[$key]['image_'.$i] != "no-img")
                    <div class="carousel-item {{$i ==1 ? 'active' : ''}}" >
                        <img src="{{Storage::url($products->productDetail[$key]['image_'.$i])}}" class="m-auto p-image" alt="" data-image = "{{$products->productDetail[$key]['image_1']}}" id="productImg{{($products->productDetail[$key]['id']).$i}}"
                        onclick="clickImage({{($products->productDetail[$key]['id']).$i}})"  style=" height: 200px;border-radius : 25px;">
                    </div>
                    @endif
                  @endfor
                </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{$key}}"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{$key}}"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
            @endforeach
               <div>
               @foreach ($products->productDetail as $key=> $item)
               <span class="m-1 mt-3 imgclass" id ="img{{$item->id}}" data-color = {{$item->color}} style="background-color: {{$item->color}}; {{$key == 0 ? 'border: 2px solid skyblue;' : ""}} display: inline-block;border-radius: 50%;width: 20px;height:20px;text-align: center;cursor:pointer;"
                onclick="changeImage({{$key}}, {{$item->id}})"></span>
               @endforeach
               </div>
               <div id="myModal1" class="modal">
                <span class="close" id="close">&times;</span>
                <img class="modal-content" id="modal-content">

              </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-3"  >
            <p class="h3"> <b>{{$products->name}} </b> </p>


            @if(number_format($products->productDetail[0]['discount']) > 0)       
            <p class="text-red-600 h4"><b  > MMK 
            {{number_format($products->productDetail[0]['price'] - ($products->productDetail[0]['price'] *  ( number_format($products->productDetail[0]['discount']) /100 ) )  )}}</b></p>  
            <p class="h6" ><b style=" text-decoration: line-through;">MMK  {{number_format($products->productDetail[0]['price'])}} </b> &nbsp;<small>({{$products->productDetail[0]['discount']}} % off)</small></p>  
            @else
            <p class="text-red-600 h4"><b>MMKs {{number_format($products->productDetail[0]['price'])}} </b> </p>  
            @endif 
            <p class="card-text">Status: {{$products->product_type == 1 ? 'In-stock' : 'Pre-Order'}}</p>
            <p class="card-text">Waiting Time: @if ($products->product_type == '1') 3 - 4 days @else 3 - 4 weeks @endif</p>
            <input type="hidden" id="product_image" value="{{$products->productDetail[0]['image_1']}}" class="text-black">
            <input type="hidden" id="product_color" value="{{$products->productDetail[0]['color']}}" class="text-black">
            <a data-id = {{$products->id}} id="add_cart_{{$products->id}}"
                class="btn btn-sm mx-auto btn-outline-light mt-3" onclick="addCart({{$products->id}})"
                    style="border-radius : 20px;">Add to cart</a>
            <span class="hidden" id="logged-in">{{ auth()->check() ? '1' : '0'}}</span>

        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-4 mt-3">
            <p  class="h5"> <b>Information</b></p>
            <table  class="ml-3">
                <tr>
                    <td style="width:70%;"><p class="m-1"><b>Brand</b></p></td>
                    <td>{{$products->brand->name}}</td>
                </tr>
                @if($products->model_name != null)
                <tr>
                    <td><p class="m-1"><b>Model Name</b></p></td>
                    <td>{{$products->model_name}}</td>
                </tr>
                @endif
                @if($products->wireless == 1 || $products->wireless == 2)
                    <tr>
                        <td><p class="m-1"><b>Connectivity</b></p></td>
                        <td>{{$products->wireless == 1 ? 'Wired' : 'Wireless'}}</td>
                    </tr>

                @endif
                @if($products->warranty != null)
                <tr>
                    <td><p class="m-1"><b>Warranty</b></p></td>
                    <td>{{$products->warranty}} {{$products->warranty == 1 ? 'year' : 'years' }}</td>
                </tr>
                @endif

            </table>
            <div class="col-md-6 mt-3">
                <p  class="h5"> <b>Description </b></p>
                <div class="ml-4">
                    <p class=""><?php echo $products->description; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 text-white">
        <div class="text-center mt-4">
            <h3 class="h4 text-white" style=" font-family: 'Times New Roman', Times, serif;">
            CATEGORY BASED ON YOUR TREND
            </h3>
        </div>
        <div class="row  mt-3">
            <div class="slide-2 owl-carousel owl-theme">
            @foreach($cat_products as $product)
                <div class="col-md-3 product_card p-3">
                    <a href={{ route('productDetail',Crypt::encrypt([$product->id])) }} class="m-auto link-light">
                        <div class="card shadow-sm" style="background-color : #aa0000;border-radius : 25px; ">
                            <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" alt=""
                                style=" object-fit: contain;border-radius : 25px;height:120px; !important;margin:auto;">
                            <div class="card-body text-white" style="height:120px;">
                                <p><b> {{$product->name}}</b></p>
                                    {{-- @foreach ($product->productDetail as $item)
                                    <span  style="color: {{$item->color}};font-size : 35px" class="mt-2" title="Available in colors">●</span>
                                    @endforeach --}}
                                    @if(number_format($product->productDetail[0]['discount']) > 0)       
                                    <p><b style="font-size : 18px;"> MMK {{ number_format($product->productDetail[0]['price'] - ($product->productDetail[0]['price'] *  ( number_format($product->productDetail[0]['discount']) /100 ) ))  }}</b></p>  

                                    </b></p>  
                                    <p ><b style=" text-decoration: line-through;">MMK  {{number_format($product->productDetail[0]['price'])}} </b> &nbsp;<small>({{$product->productDetail[0]['discount']}} % off)</small></p>  
                                    @else
                                    <p><b>MMK {{number_format($product->productDetail[0]['price'])}}</b></p>  
                                    @endif  
                                {{-- <small class="card-text"><p>{!!Str::limit($product->description,120)!!}</p></small> --}}
                                
                            </div>
                            <div class="card-footer">
                                <a href="{{route('productDetail',Crypt::encrypt($product->id))}}"
                                    class="btn btn-sm mx-auto btn-outline-light mt-3" 
                                        style="border-radius : 20px;">See Detail</a>
                            </div>
                        </div>
                    </a>
                </div>

            @endforeach
        </div>
        </div>
    </div>

</div>
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
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
        });
    });
    function changeImage(key , id) {
        $('.imgclass').css({'border': ''});
        $("#img" + id).css({'border': '2px solid skyblue'});
        $('.imgdiv').css({'display': 'none'});
        $("#imgdiv" + key).css({'display': ''});

        var color = document.getElementById("img"+id).getAttribute('data-color');
        var image = document.getElementById('imgdiv'+key).querySelector('.p-image').getAttribute('data-image');

        $("#product_color").val(color);
        $("#product_image").val(image);

     }
     
    function clickImage(id) {
     
        var modal = document.getElementById("myModal1");
        var img = document.getElementById("productImg"+id);
        var modalImg = document.getElementById("modal-content");
        modal.style.display = "block";
        modalImg.src = img.src;
        modalImg.setAttribute('data-magnify-src',img.src);
        $('#modal-content').magnify();
      
    }
    
    var span = document.getElementById('close');
    span.onclick = function() {
        $('#myModal1').css({'display': 'none'});

    };

 function addCart(id){

    var product_id = document.getElementById('add_cart_'+id).getAttribute('data-id');
    var logged_in = $("#logged-in").text();
    var color = $("#product_color").val();

    var image = $('#product_image').val();

    if(logged_in != 0)
    {
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
