@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-body" style="background:#000;color:#fff;">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{Storage::url($order->orderItems[0]->product_image)}}" alt="no-img">

                            </div>
                            <div class="col-md-6">
                                <p>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->orderItems[0]->product_name}}</p>
                                <p>Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->orderItems[0]->price}}</p>
                                <p>Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->orderItems[0]->product_type == 1 ? 'In-stock':'Pre-order'}}</p>
                                <p>Quantity:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order->orderItems[0]->quantity}}</p>
                                <br>
                                <br>
                                <p><b>Order Status</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @switch($order->status)
                                        @case('1')
                                            <span class="btn btn-info">Pending</span>
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
                            <span style="float:right">
                                {{-- <img src="{{Storage::url($item['image'])}}" width="150" alt=""> --}}
                            </span>
                            <p>Voucher:{{$order->orderItems[0]->image}}</p>
                            {{-- <p>Price:{{$item['price']}}</p>
                            <p>Quantity:{{$item['qty']}}</p> --}}
                        {{-- @endforeach --}}
                    </div>
                </div>
                <p class="mb-3">
                    <button type="button" class="btn btn-warning">
                        <span class="badge badge-light">
                            {{-- {{$cart->totalPrice}} --}}
                        </span>
                    </button>
                </p>
                @endforeach
            </div>
        </div>
    </div>
@endsection