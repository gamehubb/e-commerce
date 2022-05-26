@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 col-md-5  text-white">
            <i class="nav-item fa fa-user m-2 mb-4"> Hi {{Auth::getUser()->name}}</i>
            <div class="row mb-3" style="border:1px solid #808080; border-radius: 10px;">
                @if($carts != null)

                        <div class="col-md-4">
                            <img src="{{Storage::url($carts['image'])}}"
                                class="floar-right m-3 mx-auto" style=" border-radius: 20px; " alt="...">
                        </div>
                        <div class="col-md-4 mt-2 ">
                            <p><u><b>{{$carts['name']}} </b></u></p>
                            <p class="m-2"> Product Code:{{$carts['code']}} </p>
                            <p class="m-2"> Category: {{$carts['category']}} </p>
                            <p class="m-2"> Quantity: {{$carts['qty']}} </p>
                            @if($carts['product_type'] == 2) 
                                <p class="m-2"> Waiting Time: 3weeks </p>
                            @endif
                            
                        </div>
                        <div class="col-md-4 mt-2 ">
                            <p></p>
                            <p class="mt-4 ml-2"> Color: {{$carts['color']}} </p>
                            <p class="m-2"> Brand: {{$carts['brand']}} </p>
                            <p class="m-2"> Status: {{$carts['product_type'] ==1 ? 'Instock' : 'Preorder'}} </p>
                        </div>
                        <hr class="mx-auto" style="width:90%;  ">
                        <div class="text-right">
                            <p class="m-2"><b>{{$carts['price'] * $carts['qty']}}</b></p>
                        </div>

                @endif
            </div>
           <hr class="mx-auto" style="width:100%;  ">
           <div class="row mb-3">
            <div class="col-md-8 mt-2 ">
                <p class="m-2  h6"> Subtotal : </p>
                <p class="m-2  h6">Delivery :</p>
            </div>
            <div class="col-md-4 mt-2 ">
                <p class="m-2 h6">MMKs  {{ session()->get('cart')->totalPrice }}</p>
                <p class="m-2 h6">MMKs 0</p>
            </div>
           </div>
           <hr class="mx-auto" style="width:100%;  ">
           <div class="row mb-3">
            <div class="col-md-8 mt-2 ">
                <p class="m-2 h5"><b>TOTAL :</b></p>      
            </div>
            <div class="col-md-4 mt-2 ">
                <p class="m-2 h5"><b>MMKs  {{session()->get('cart')->totalPrice}} </b></p>
               
            </div>
           </div>
        </div>
        <div class="col-md-4 text-white  mt-4"  >
            <a href="{{route('deliveryInfo.create')}}"  style="width: 18rem; float: right;" > 
             <u><i class="fa fa-plus"></i>Add New Address </i></u>
            </a>
            @if(count($delivery_info)>0)
            @foreach($delivery_info as $delInfo)     
            <div class="card bg-dark m-2 border-secondary card-pf-view-single-select"  style="width: 18rem;  float: right;" >         
                <div class="card-body">
                <h4 class="card-title"> <b>{{$delInfo->name}}</b></h4>
                <p class="card-text"> {{$delInfo->phoneNumber}}</p>
                <p class="card-text">{{$delInfo->address}} ,{{$delInfo->township}},{{$delInfo->city}},{{$delInfo->state_region}}</p>
                <input type="radio" name ="delInfo" value ={{$delInfo->id}} style ="position: absolute;right: 5px;top: 5px;">
                </div>
          </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="row mt-10">
        <div class="col-md-6 text-white bg-dark">
            <label class="h5 p-3"><b>CHOOSE PAYMENT METHOD</b></label><br />
            <div class="m-1 mb-5">
                <input type="radio" id="kbzpay" name="payment" class="form-check-input m-3" value="1" checked>
                <label class="h5 mt-2" for="kbzpay">KBZ Pay</label><br />
                <input type="radio" id="wavepay" name="payment" class=" form-check-input m-3" value="2">
                <label class="h5 mt-2" for="wavepay">Wave Pay</label><br />
                <input type="radio" id="cod" name="payment" class=" form-check-input m-3" value="3">
                <label class="h5 mt-2" for="cod">Cash On Delivery</label><br />
            </div>
           
            <div id="showoption"></div>
        </div>
        <div class="col-md-5 text-white" style="border:1px solid #808080;">
            <label class="h5 p-1"><b>Account Name - Gamehub</b></label><br />
            <label class="h5 p-1"><b>Phone Number - 09986715035</b></label><br />
            <img src="{{asset('images/kpay.jpg')}}" width="50px" height="50px" id="kpay" style="display:none;" alt="Kpay"/>
            <img src="{{asset('images/wave-money.jpg')}}" width="50px" height="50px" id="wpay" style="display:none;" alt="WavePay">         
        </div>
    </div>
    <div class="mt-3">
        <i class="fa fa-warning fa-xl m-2 mb-4" style="color: red"> </i>
        <label class="text-white">Don't forget to save your payment vocher.</label>
    </div>
    <div class="mt-3 text-white text-center">
        <label for="upload-photo">Upload you voucher</label>
        <input class="m-auto" type="file" name="photo" id="upload-photo" style="width: 95px;" /><br />
        <a href=" ">
            <button type="button" class="btn btn-sm  mt-3 text-white bg-dark "
                style="border-radius:20px; background-color:#aa0000; width:10%">Checkout</button>
        </a>
    </div>
    <hr style="margin-top: 20px;color:white;" />
    <div class="mt-3 text-white text-center">
        <p>Questions about this payment? Contact <a href=" "><u> GameHub Myanmar</u></a></p>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    // Card Single Select
    $('.card-pf-view-single-select').click(function() {
        if ($(this).hasClass('border-secondary'))
        {
            $('.card-pf-view-single-select').removeClass('border-success');
            $('.card-pf-view-single-select').addClass('border-secondary');
           $(this).removeClass('border-secondary'); 
           $(this).addClass('border-success'); 
           $(this).find('input').prop('checked', true)  ;  
        } 
    });
  });
// Create a Stripe client.
window.onload = function() {
    // var stripe = Stripe(
    //     'pk_test_51Kd9j5EADO6FT0UAYme7Vttx1eyBRvbKiJbVY5TKXPMIO2OBXtmkPmXem6BS89zJqAHa8fIkTLMjloP1gYM8KjvT00yQ6XCHPU'
    // );

    // var elements = stripe.elements();

    // var style = {
    //     base: {
    //         color: '#32325d',
    //         fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    //         fontSmoothing: 'antialiased',
    //         fontSize: '16px',
    //         '::placeholder': {
    //             color: '#aab7c4'
    //         }
    //     },
    //     invalid: {
    //         color: '#fa755a',
    //         iconColor: '#fa755a'
    //     }
    // };

    // // Create an instance of the card Element.
    // var card = elements.create('card', {
    //     style: style
    // });

    // Add an instance of the card Element into the `card-element` <div>.
    // card.mount('#card-element');

    // // Handle real-time validation errors from the card Element.
    // card.addEventListener('change', function(event) {
    //     var displayError = document.getElementById('card-errors');
    //     if (event.error) {
    //         displayError.textContent = event.error.message;
    //     } else {
    //         displayError.textContent = '';
    //     }
    // });

    // Handle form submission.
    // var form = document.getElementById('payment-form');
    // form.addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     var options = {
    //         name: document.getElementById('name').value,
    //         address_line1: document.getElementById('address').value,
    //         address_city: document.getElementById('city').value,
    //         address_state: document.getElementById('state').value,
    //         address_zip: document.getElementById('postalcode').value
    //     }

    //     stripe.createToken(card, options).then(function(result) {
    //         if (result.error) {
    //             // Inform the user if there was an error.
    //             var errorElement = document.getElementById('card-errors');
    //             errorElement.textContent = result.error.message;
    //         } else {
    //             // Send the token to your server.
    //             stripeTokenHandler(result.token);
    //         }
    //     });
    // });

    // // Submit the form with the token ID.
    // function stripeTokenHandler(token) {
    //     // Insert the token ID into the form so it gets submitted to the server
    //     var form = document.getElementById('payment-form');
    //     var hiddenInput = document.createElement('input');
    //     hiddenInput.setAttribute('type', 'hidden');
    //     hiddenInput.setAttribute('name', 'stripeToken');
    //     hiddenInput.setAttribute('value', token.id);
    //     form.appendChild(hiddenInput);

    //     // Submit the form
    //     form.submit();
    // }

    $("input:radio[type=radio]").click(function() {
        var value = $(this).val();
        if(value == 1)
            {
            $('#kpay').show();
            $('#wpay').hide();
            }
        else if(value == 2)
            {
            alert(value);
            $('#kpay').hide();
            $('#wpay').show();
            }
        else if(value == '3')
            {
            $('#kpay').hide();
            $('#wpay').hide();
            }
        
        $('#showoption').html(value);
        });
}
</script>
@endsection