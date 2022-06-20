@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($orders as $key => $order)

                        <div class="card mb-3">
                            <div class="card-body" style="background:#000;color:#fff;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{Storage::url($order->product_image)}}" alt="no-img">

                                    </div>
                                    <div class="col-md-6">
                                        <p>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->product_name}}</p>
                                        <p>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->price}}</p>
                                        <p>Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->product_type == 1 ? 'In-stock':'Pre-order'}}</p>
                                        <p>Quantity:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->quantity}}</p>
                                        <br>
                                        <br>
                                        <p><b>Order Status</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @switch($order->status)
                                                @case('1')
                                                    <span class="badge badge-light">Pending</span>
                                                    <span class="badge badge-pill badge-primary">Primary</span>

                                                    @break
                                                @case('2')
                                                    <span class="btn btn-success">Approved</span>
                                                    @break
                                                @case('3')
                                                    <span class="btn btn-warning">Declined</span>
                                                    @break
                                                @case('4')
                                                    <span class="btn btn-danger">Cancelled</span>
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
                        </div>
                    <p class="mb-3">
                        <button type="button" class="btn btn-success">
                            <h4>
                                Total               :{{$order->price * $order->quantity}}
                            </h4>
                        </button>
                    </p>
                    
                    @endforeach
                </div>
        </div>
    </div>
@endsection