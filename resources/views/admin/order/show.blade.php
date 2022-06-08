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
<div class="row justify-content-center">
    <div class="col-md-8">
        @foreach($orders as $order)
        @foreach($order->orderitem as $orderitem) 
        <div class="card mb-3">
            <div class="card-body">
              <p> {{$order->del_name}}</p> 
              <p>{{$orderitem->price}}</p> 
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
</div>
@endsection