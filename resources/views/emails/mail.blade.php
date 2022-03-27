<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $i = 1;
        @endphp
        @foreach($cart->items as $product)
            <tr>
                <th scope="row">{{$i++}}</th>
                <th>{{$product['name']}}</th>
                <th>{{$product['price']}}</th>
                <th>{{$product['qty']}}</th>
            </tr>
        @endforeach
        <br>
        <span>Total Price:: {{$cart->totalPrice}}</span>
        <span>Please Click the link to view yours order. <a href="{{url('/orders')}}">Click Here</a></span>
    </tbody>
</table>