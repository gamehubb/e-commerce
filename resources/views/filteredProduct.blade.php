@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <div class="album">
            <div class="container">
                @if(Request::path() == 'search')
                    <p class="h2 text-center text-white">You search result for keyword "{{$name}}" </p><br><br>
                @else
                    <h3 class="h3 text-uppercase">{{$name}}</h3><br><br>
                @endif
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    
                    @if(count($products) != 0)
                    @foreach($products as $product)
                    <div class="col-md-3 product_card p-3">
                        <a href="{{ route('productDetail',Crypt::encrypt([$product->id])) }}" class="m-auto link-light">
                        <div class="card shadow-sm " style="background-color : #aa0000;border-radius : 25px;margin:auto;">
                            <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" alt=""
                                style=" object-fit: contain;border-radius : 25px;filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7));height:120px; !important;margin:auto;">
                            <div class="card-body text-white" style="height:120px;">
                                <p><b> {{$product->name}}</b></p>
                                <span class="hidden" id="logged-in">{{ auth()->check() ? '1' : '0'}}</span>
                                @if(number_format($product->productDetail[0]['discount']) > 0)       
                                <p><b style="font-size : 18px;"> MMK {{ number_format($product->productDetail[0]['price'] - ($product->productDetail[0]['price'] *  ( number_format($product->productDetail[0]['discount']) /100 ) ))  }}</b></p>  
                                    </b></p>  
                                <p ><b style=" text-decoration: line-through;">MMK  {{number_format($product->productDetail[0]['price'])}} </b> &nbsp;<small>({{$product->productDetail[0]['discount']}} % off)</small></p>  
                                @else
                                <p><b>MMK {{number_format($product->productDetail[0]['price'])}}</b></p>  
                                @endif  
                                
                            </div>

                            <div class="card-footer">
                                <a data-id = {{$product->id}} id="add_cart_{{$product->id}}"
                                    class="btn btn-sm mx-auto btn-outline-light mt-3"
                                    data-image="{{$product->productDetail[0]['image_1']}}"
                                    data-color="{{$product->productDetail[0]['color']}}"
                                     onclick="addCart({{$product->id}})"
                                        style="border-radius : 20px;">Add to cart</a>
                            </div>

                        </div>

                        </a>
                    </div>
                    @endforeach
                    @else
                    <p class="h2 text-center text-white m-auto">No search results found</p>
                    @endif
                </div>
            </div>

        </div>

    </main>
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