@extends('layouts.app')

@section('content')
<style>
        /* The Modal (background) */
    .modal {
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
    .modal-content {
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
    
    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
      .modal-content {
        width: 100%;
      }
    }
    </style>
<div class="container  bg-dark">
    <div class="row text-white p-4">
        <div class="col-md-3 text-center p-2" style="border-width: 1px; border-color: rgb(27, 27, 27); border-radius : 25px;">             
            @foreach ($products->productDetail as $key=> $item)
            <div class="imgdiv"  id = "imgdiv{{$key}}"  style=" {{$key ==0 ? '' : 'display:none'}}">
               <div id="carouselExampleControls{{$key}}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" >        
                    @for ($i = 1; $i <= 3; $i++)
                    @if($products->productDetail[$key]['image_'.$i] != "no-img")
                    <div class="carousel-item {{$i ==1 ? 'active' : ''}}" >
                        <img src="{{Storage::url($products->productDetail[$key]['image_'.$i])}}" class="m-auto" alt="" id="productImg{{($products->productDetail[$key]['id']).$i}}"
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
               <span class="m-1 mt-3 imgclass" id = "img{{$item->id}}" style="background-color: {{$item->color}}; {{$key == 0 ? 'border: 2px solid skyblue;' : ""}} display: inline-block;border-radius: 50%;width: 20px;height:20px;text-align: center;cursor:pointer;"  
                onclick="changeImage({{$key}}, {{$item->id}})"></span>
               @endforeach  
               </div>                 
               <div id="myModal1" class="modal">
                <span class="close" id="close">&times;</span>
                <img class="modal-content" id="img01">
               
              </div>
        </div>
        <div class="col-md-3 m-3"  >     
            <p class="h3"> <b>{{$products->name}} </b> </p>
            <p class="text-red-600 h4"><b>MMKs {{$products->productDetail[0]['price']}} </b> </p>  
            <p class="card-text">Status: {{$products->productDetail[0]['status'] == '1' ? 'In-stock' : 'Pre-Order'}}</p>
            <p class="card-text">Waiting Time: @if ($products->productDetail[0]['status'] == '1') 3 - 4 days @else 10 - 12 days @endif</p>
            <a href="{{ route('add.cart',[$products->id]) }}">
                <button type="button" class="btn btn-sm mx-auto mt-3 text-white"
                    style="border-radius : 20px;   background-color : #aa0000;">Add to cart</button>
            </a>
        </div>
        <div class="col-md-5 mt-3">      
            <p  class="h5"> <b>Information</b></p>   
            <table  class="ml-3">
                <tr>
                    <td style="width:70%;"><p class="m-1"><b>Brand</b></p></td>
                    <td>{{$products->brand->name}}</td>
                </tr>
                <tr>
                    <td><p class="m-1"><b>Model Name</b></p></td>
                    <td>{{$products->model_name}}</td>
                </tr>
                <tr>
                    <td><p class="m-1"><b>Connectivity</b></p></td>
                    <td>Wireless</td>
                </tr>
                <tr>
                    <td><p class="m-1"><b>Warranty</b></p></td>
                    <td>1 year</td>
                </tr>
                 
            </table>
            <div class="col-md-6 mt-3">     
                <p  class="h5"> <b>Description </b></p> 
                <p class="mt-1"><?php echo $products->description; ?></p> 
            </div>     
        </div>
    </div>
</div>
<div class="container mt-3 text-white">
    <div class="text-center mt-4">
        <span class="h4 text-white" style=" font-family: 'Times New Roman', Times, serif;">
           CATEGORY BASED ON YOUR TREND
        </span>
        <hr class="mx-auto" style="width:360px; color: #aa0000; height: 3px; ">
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-3">
        @foreach($cat_products as $product)
            <div class="col-md-2">
                <a href="{{ route('productDetail',[$product->id]) }}" class="m-auto">
                    <div class="card shadow-sm" style="background-color : #aa0000;border-radius : 25px; ">
                        <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" alt=""
                            style=" object-fit: contain;border-radius : 25px;">
                        <div class="card-body text-white">
                            <p><b> {{$product->name}}</b></p>
                            <span> Colors- 
                                @foreach ($product->productDetail as $item)
                                <span  style="color: {{$item->color}};font-size : 35px" >●</span>
                                @endforeach
                            </span>
                            <p><b>MMKs {{$product->productDetail[0]['price']}} </b> </p>  
                            <small class="card-text"><p>{!!Str::limit($product->description,120)!!}</p></small>
                            <a href="{{ route('add.cart',[$product->id]) }}">
                                <button type="button" class="btn btn-sm mx-auto  btn-outline-light mt-3"
                                    style="border-radius : 20px;">Add to cart</button>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
      
        @endforeach

    </div>
</div>
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
    function changeImage(key , id) {
        $('.imgclass').css({'border': ''});
        $("#img" + id).css({'border': '2px solid skyblue'});
        $('.imgdiv').css({'display': 'none'});
        $("#imgdiv" + key).css({'display': ''});
     }
  
     function clickImage(id) {
     
        var modal = document.getElementById("myModal1");
     var img = document.getElementById("productImg"+id);
     var modalImg = document.getElementById("img01");
     modal.style.display = "block";
     modalImg.src = img.src;
      
 }
 var span = document.getElementById('close');
span.onclick = function() { 
    $('#myModal1').css({'display': 'none'});

 };
</script>
 
    
@endsection