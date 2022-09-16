  @extends ('admin.layouts.main')

  @section ('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Detail</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Orders Tables</li>
        </ol>
      </div>
  </div>
  <div class="container justify-content-center">
        @foreach($orders as $order)
        <div class="card card-primary m-auto">
          <div class="card-title"><span class="border border-primary bg-dark text-light" style="">{{$order->voucher_code}}</span>
          </div>
          <div class="card-body" style="padding: 0.9rem !important;"> 
              <div class="row mb-2">
                  
                  <div class="col-sm-3">
                      <h6><b>Username :</b> {{ $order->user->name }} </h6>
                      <small class="text-light badge badge-primary"> {{ $order->del_name }} </small>

                      {{-- <h6><b>Name :</b> {{ $order->del_name }} </h6> --}}
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
                    <p><b>Order Status</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
            <table class="table table-bordered">
              <thead>
                <th>Name</th>
                <th>Image</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Product type</th>
                <th>Vendor</th>
                <th>Amount</th>

              </thead>

              <tbody>
              @foreach($order->orderItems as $orderItem) 
                
                  <tr>
                    <td>{{$orderItem->product_name}}</td>
                    <td><img src={{Storage::url($orderItem->product_image)}} style="width:50px;height:40px;"></td>
                    <td><span  style="color: {{$orderItem->color}};font-size : 35px" title="Available in colors">●</span></td>

                    <td>{{$orderItem->quantity}}</td>
                    <td>{{number_format($orderItem->price)}}</td>
                    <td>{{$orderItem->discount == 0 ? 'No-discount' : $orderItem->discount}}</td>
                    <td>{{$orderItem->product_type == 1 ? 'In-stock' : 'Pre-order'}}</td>
                    <td>{{$orderItem->vendor->name}}
                    <?php
                      $price = $orderItem->quantity * $orderItem->price;
                      $total = number_format($price - ($price *  $orderItem->discount) /100 );
                    ?>
                    <td><?php echo $total;?></td>
                
                  

                  </tr> 
              @endforeach
              </tbody>
            </table>
          </div>
        @endforeach

      </div>


        
    </div>
        
    
  @endsection