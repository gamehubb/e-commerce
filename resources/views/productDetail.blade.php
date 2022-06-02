@extends('layouts.app')

@section('content')
<div class="container  bg-dark">
    <div class="row text-white p-5">
        <div class="col-md-3 ">       
            <div>
               <img src="{{Storage::url($products->productDetail[0]['image_1'])}}" alt=""
               style=" width: 200px ; height: 200px;border-radius : 25px;">                   
            </div>
          
        </div>
        <div class="col-md-9"  >     
            <p class="h3"> <b>{{$products->name}} </b> </p>  
            @foreach ($products->productDetail as $item)
            <span  style="color: {{$item->color}};font-size : 35px" >●</span>
            @endforeach
            <p class="text-red-600 h4"><b>MMKs {{$products->productDetail[0]['price']}} </b> </p>  
            <p class="card-text">Status: {{$products->productDetail[0]['status']}}</p>
            <p class="card-text">Waiting Time: 3weeks - 4 weeks</p>
            <a href="{{ route('add.cart',[$products->id]) }}">
                <button type="button" class="btn btn-sm mx-auto  btn-outline-light mt-3"
                    style="border-radius : 20px;">Add to cart</button>
            </a>
        </div>
    </div>
    <div class="row text-white p-5">
        <div class="col-md-6 ">      
            <p  class="h5"> <b>Information </b></p> 
            <div class="row m-3">
                <div class="col-md-3">   
                    <p> <b>Brand </b></p> 
                    <p class="mt-1"> <b>Model Name </b></p> 
                    <p class=" mt-1"> <b>Connectivity </b></p> 
                    <p class=" mt-1"> <b>Warranty </b></p> 
                    <p class=" mt-1"> <b>Compatible </b></p> 
                    <p class=" mt-1"> <b>Import </b></p> 
                </div>
                <div class="col-md-3 ">   
                    <p class=" mt-1">Beat Studio</p> 
                    <p class=" mt-1">ST 005</p> 
                    <p class=" mt-1">Wireless</p> 
                    <p class=" mt-1">1 year</p> 
                    <p class=" mt-1">Android, IOS</p> 
                    <p class=" mt-1">Thailand</p> 
                </div>
            </div>
        </div>
        <div class="col-md-6"  >     
            <p  class="h5"> <b>Description </b></p> 
            <p class="mt-1">{{$products->description}}</p> 
        </div>
    </div>


</div>
@endsection