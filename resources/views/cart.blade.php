@extends('layouts.app')

@section('content')
    <div class="container">
      @if($errors->any())
        @foreach($errors->all() as $error)
          <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      @endif
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Remove</th>
              </tr>
            </thead>
            <tbody>
                @if($cart)
                @php 
                    $i=1
                @endphp
            @foreach($cart->items as $product)
              <tr>
                <th scope="row">{{$i++}}</th>
                <td><img src="{{Storage::url($product['image'])}}" alt="" width="100"></td>
                <td>{{$product['name']}}</td>
                <td>{{$product['price']}}</td>
                <td>
                    <form action="{{route('cart.update',$product['id'])}}" method="post">@csrf
                      <input type="text" name="qty" value="{{$product['qty']}}">
                        <button class="btn btn-secondary btn-sm">
                          <i class="fas fa-sync"></i> Update
                        </button>
                    </form>
                </td>
                <td>
                  <form action="{{route('cart.remove',$product['id'])}}" method="post">@csrf
                    <button class="btn btn-danger btn-sm">x</button>
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <hr>
          <div class="cart-footer">
              <button class="btn btn-primary mt-3 btn-sm">Continue Shopping</button>
              <span class="mt-3" style="margin-left: 300px;">Total Price: {{$cart->totalPrice}} </span>
              <a href="{{ route('cart.checkout',[$cart->totalPrice]) }}"><button class="btn btn-info mt-3 btn-sm" style="float:right">Checkout</button></a>
          </div>
          @else
          <td>Your Cart is Empty</td>
          @endif
    </div>
@endsection