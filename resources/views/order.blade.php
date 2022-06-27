@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($order_data as $o_d)

                    <span class="text-light">{{$o_d->voucher_code}}</span>
                    
                @endforeach
                @foreach($orders as $key => $order)

                        <div class="card mb-3">
                            <div class="card-body" style="background:#000;color:#fff;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{Storage::url($order->product_image)}}" alt="no-img">

                                    </div>
                                    <div class="col-md-6">
                                        <p>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->product_name}}</p>
                                        <p>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($order->price)}}</p>
                                        <p>Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->product_type == 1 ? 'In-stock':'Pre-order'}}</p>
                                        <p>Quantity:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->quantity}}</p>
                                        <br>
                                        <br>
                                        <p><b>Order Status</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                </div>
                                    <span style="float:left">
                                        {{$order->created_at}}
                                    </span>
                                    <span style="float:right">
                                        <p>Voucher:  {{$order->voucher_code}}</p>
                                    </span> 
                                
                            </div>
                            
                            <div class="card-footer bg-dark">
                            <h4 class="text-light">
                                Total:          {{number_format($order->price * $order->quantity)}}
                            </h4>
                            </div>
                        </div>
                   
                    
                    @endforeach
                </div>
        </div>
    </div>
@endsection