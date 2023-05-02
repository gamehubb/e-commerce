@extends('layouts.app')

@section('content')
<style>
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
    .image-zoom {
            overflow: hidden;
        }

    .image-zoom {
        transition: transform 0.3s ease-in-out;
    }

    .image-zoom:hover {
        transform: scale(1.2);
    }
</style>
<div class="container">
    <main>
        <div class="album mb-3">
            <div class="container">
                @if(Request::path() == 'search')
                    <p class="h2 text-center text-white">You search result for keyword "{{$name}}" </p><br><br>
                @else
                    <h3 class="h3 text-uppercase mt-3">{{$name}}</h3><br><br>
                @endif
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">

                    @if(count($products) != 0)
                    @foreach($products as $product)
                    <div class="col-md-4">
                        <a href="{{ route('productDetail',[$product->id]) }}" class="m-auto link-light">
                        <div class="card shadow-sm " style="background-color : #aa0000;border-radius : 25px; ">
                            <div class="card-header">
                                <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" alt="" class="image-zoom"
                                style="object-fit: contain;height:120px;width:100%; border-radius : 25px; filter: drop-shadow(12px 12px 7px rgba(0, 0, 0, 0.7))">
                            </div>
                            <div class="card-body text-white" style="height:150px;">
                                <p><b> {{$product->name}}</b></p>
                                <span class="hidden" id="logged-in">{{ auth()->check() ? '1' : '0'}}</span>
                                <p><b>MMKs {{number_format($product->productDetail[0]['price'])}} </b> </p>

                            </div>
                            <div class=" card-footer">
                                <a data-id = {{$product->id}} id="add_cart_{{$product->id}}"
                                    class="btn btn-sm mx-auto border-order"
                                    data-image="{{$product->productDetail[0]['image_1']}}"
                                    data-color="{{$product->productDetail[0]['color']}}"
                                     onclick="addCart({{$product->id}})"
                                        style="border-radius : 20px;color:white">Add to cart</a>
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
