@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if($order_data->count())
                    @foreach($order_data as $order)

                        <div class="card mb-3">
                            <div class="card-body" style="background:#000;color:#fff;">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <img src="{{Storage::url($order->product_image)}}" alt="no-img">

                                    </div> --}}
                                    <div class="col-md-12">
                                        {{-- <p>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->product_name}}</p>
                                        <p>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($order->price)}}</p>
                                        <p>Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->product_type == 1 ? 'In-stock':'Pre-order'}}</p>
                                        <p>Quantity:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->quantity}}</p>
                                        <br>
                                        <br> --}}
                                        <p class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @switch($order->status)
                                                @case('1')
                                                    <span class="text-light">Pending</span>
                                                    @break
                                                @case('2')
                                                    <span class="text-info">Approved</span>
                                                    @break
                                                @case('3')
                                                    <span class="text-success">Completed</span>
                                                    @break
                                                @case('4')
                                                    <span class="text-warning">Declined</span>
                                                    @break
                                                @case('5')
                                                    <span class="text-danger">Cancelled</span>
                                                    @break
                                            
                                                @default
                                                    
                                            @endswitch</p>
                                    </div>
                                </div><br/>
                                    <?php
                                        $string_data = new DateTime($order->created_at);
                                        $date = $string_data->format('d-m-Y');

                                    ?>
                                    <span style="float:left">
                                       <i class="fas fa-calendar"></i> {{$date}}
                                    </span>
                                    <span style="float:right">
                                        <p>Voucher:  {{$order->voucher_code}}</p>
                                    </span> 
                                
                            </div>
                            
                            <div class="card-footer bg-dark">
                                
                                <div class="row">
                                <span class="col-md-6 text-light">
                                    Total:          {{number_format($order->total_amount)}}
                                    
                                </span>
                                <i class="col-md-6 text-right">
                                    <a href="{{route('order.detail',Crypt::encrypt($order->id))}}" class="link-light btn btn-primary" id="s_detail">See Detail</a>
                                </i>
                                </div>                                
                                
                            </div>
                               
                           
                        </div>
                   
                    
                    @endforeach
                @else
                    <h3>You have not made any orders yet</h3> 
                    <div class="text-center">
                        <a href="{{route('home')}}" class="m-auto">
                            <button type="button" class="btn btn-sm mx-auto mt-3 text-white" id="checkout-btn"
                                style="border-radius : 20px; background-color : #aa0000;">Find Your need</button>
                        </a>
                    </div>
                @endif
                </div>
        </div>
    </div>

    {{-- <script type="text/javascript">
        (function(e,a){
            var t,r=e.getElementsByTagName("head")[0],c=e.location.protocol;
            t=e.createElement("script");t.type="text/javascript";
            t.charset="utf-8";t.async=!0;t.defer=!0;
            t.src=c+"//front.optimonk.com/public/"+a+"/js/preload.js";r.appendChild(t);
        })(document,"182675");
    </script> --}}

@endsection