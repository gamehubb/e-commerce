@extends('layouts.app')

@section('content')

<div class="container justify-content-center">
    @foreach($orders as $order)
    <div class="card card-primary m-auto bg-dark text-light">
      <div class="card-title"><span class="border border-secondary bg-secondary text-light" style="">{{$order->voucher_code}}</span>
      </div>
      <div class="card-body" style="padding: 0.9rem !important;"> 
          <div class="row mb-2">
              
              <div class="col-sm-3">
                  <h6><b>Delivery Nmae :</b> {{ $order->del_name }} </h6>
              </div>
              <div class="col-sm-3">
                  <h6><b>PhoneNumber :</b> {{ $order->del_phone_number
                   }} </h6>
              </div>
              <div class="col-sm-3">
                  <h6><b>Email :</b> {{ $order->user->email }} </h6>
              </div>
              <div class="col-sm-3">
                  <h6><b>Total Amount :</b> {{ number_format($order->total_amount + $order->del_fees) }} </h6>
              </div>
          </div><br>

          <div class="row mb-2">
            <div class="col-sm-5">
              <h6><b>Address :</b> {{ $order->del_address }} </h6>
            </div>
            <div class="col-sm-3">
              <h6><b>City :</b> {{ $order->del_city }} </h6>
            </div>
            <div class="col-sm-3">
              <h6><b>Township :</b> {{ $order->del_township }} </h6>
              <span class="text-muted">Deli-fees: {{ $order->del_fees }}</span>
            </div>
          </div><br>

          <div class="row mb-2">
          
              <div class="col-sm-3">
                <p><b>Order Status:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  @switch($order->status)
                      @case('1')
                          <span class="text-light badge badge-primary">Pending</span>
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

      </div>
      <div class="card-footer">

        <table class="table table-responsive text-light">
          <thead>
            <th>Product</th>
            <th>QuantityxPrice</th>
            <th>Discount</th>
            <th>Amount</th>

          </thead>

          <tbody>
          @foreach($order->orderItems as $orderItem) 
            
              <tr>
                <td><img src={{Storage::url($orderItem->product_image)}} style="width:50px;height:40px;">
                    <span  style="color: {{$orderItem->color}};font-size : 25px;">●</span><br>

                    {{$orderItem->product_name}}

                </td>

                <td>{{$orderItem->quantity}} x {{number_format($orderItem->price)}}</td>
                <td>{{$orderItem->discount == 0 ? 'No-discount' : $orderItem->discount.' %'}}</td>
                <td>{{number_format($orderItem->price * $orderItem->quantity)}}</td>
              

              </tr> 
          @endforeach
          </tbody>
        </table>



      </div>
    @endforeach

  </div>


@endsection