@extends('layouts.app')

@section('content')
<style>
.StripeElement {
    box-sizing: border-box;

    height: 40px;

    padding: 10px 12px;

    border: 1px solid transparent;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
}

.StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
    border-color: #fa755a;
}

.StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-6 col-md-5  text-white">
            <i class="nav-item fa fa-user m-2 mb-4"> Hi {{Auth::getUser()->name}}</i>
            <div class="row mb-3" style="border:1px solid #808080; border-radius: 10px;">
                @if($carts != null)

                    @foreach(session()->get('cart')->items as $key => $value)
                        <div class="col-md-4">
                            <img src="{{Storage::url($value['image'])}}"
                                class="floar-right m-3 mx-auto" style=" border-radius: 20px; " alt="...">
                        </div>
                        <div class="col-md-4 mt-2 ">
                            <p><u><b>{{$value['name']}} </b></u></p>
                            <p class="m-2"> Product Code:{{$value['code']}} </p>
                            <p class="m-2"> Category: {{$value['category']}} </p>
                            <p class="m-2"> Quantity:1 </p>
                            @if($value['product_type'] == 2) 
                                <p class="m-2"> Waiting Time: 3weeks </p>
                            @endif
                            
                        </div>
                        <div class="col-md-4 mt-2 ">
                            <p></p>
                            <p class="mt-4 ml-2"> Color: Pink </p>
                            <p class="m-2"> Brand: Anti </p>
                            <p class="m-2"> Status: Preorder </p>
                        </div>
                        <hr class="mx-auto" style="width:90%;  ">
                        <div class="text-right">
                            <p class="m-2"><b>MMKs: 10000</b></p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row" style="border:1px solid #808080; border-radius: 10px;">
                <div class="col-md-4">
                    <img src="{{Storage::url('public/files/xCCWSBMZi929D5ZL1RH4Tqoc7luuNjcpJtqbqNex.png')}}"
                        class="floar-right m-3 mx-auto" style=" border-radius: 20px; height:5rem; " alt="...">
                </div>
                <div class="col-md-4 mt-2 ">
                    <p><u><b>Arti Pro H001 </b></u></p>
                    <p class="m-2"> Product Code: 224 </p>
                    <p class="m-2"> Category: Headphone </p>
                    <p class="m-2"> Quantity:1 </p>
                    <p class="m-2"> Waiting Time: 3weeks </p>
                </div>
                <div class="col-md-4 mt-2 ">
                    <p></p>
                    <p class="mt-4 ml-2"> Color: Pink </p>
                    <p class="m-2"> Brand: Anti </p>
                    <p class="m-2"> Status: Preorder </p>
                </div>
                <hr class="mx-auto" style="width:90%;  ">
                <div class="text-right">
                    <p class="m-2"><b>MMKs: 10000</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6  bg-black text-white">
            <form action="/charge" method="post" id="payment-form" style="width:60%;float: right;">@csrf
                <label class="row h5 mb-2"><b>YOUR ORDER <small>(Deivery Info.)
                        </small></b>
                </label>
                <div class="form-group m-2">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" value={{auth()->user()->name}}
                        readonly required>
                </div>
                <div class="form-group m-2">
                    <label>Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="form-group m-2">
                    <label>City</label>
                    <input type="text" name="city" id="city" class="form-control" required>
                </div>
                <div class="form-group m-2">
                    <label>Delivery Township</label>
                    <input type="text" name="deltownship" id="deltownship" class="form-control" required>
                </div>
                <div class="form-group m-2">
                    <label>State/Region</label>
                    <input type="text" name="state" id="state" class="form-control" required>
                </div>
                <div class="form-group m-2">
                    <label>PhoneNumber</label>
                    <input type="number" name="phonenumber" id="phonenumber" class="form-control" required>
                </div>
                <div class="form-group m-2">
                    <label class="h4"><b>Price: 1000 MMKs</b></label>
                    <input type="hidden" name="amount" value="{{$amount}}">
                </div>
                <div class="form-group m-3">
                    <input type="checkbox" name="saveInfo">
                    <label>Save this Info for next time.</label>
                </div>
                <a href=" ">
                    <button type="button" class="btn btn-sm mx-auto mt-3 text-white"
                        style="border-radius : 20px;width:100%; background-color : #aa0000;">Continue to
                        Payment</button>
                </a>
            </form>
        </div>
    </div>
    <div class="row mt-10">
        <div class="col-md-6 text-white bg-dark">
            <label class="h5 p-3"><b>CHOOSE PAYMENT METHOD</b></label><br />
            <div class="m-1 mb-5">
                <input type="radio" id="kbzpay" name="payment" class="form-check-input m-3">
                <label class="h5 mt-2" for="kbzpay">KBZ Pay</label><br />
                <input type="radio" id="cbpay" name="payment" class="form-check-input m-3">
                <label class="h5 mt-2" for="cbpay">CB Pay</label><br />
                <input type="radio" id="wavepay" name="payment" class=" form-check-input m-3">
                <label class="h5 mt-2" for="wavepay">Wave Pay</label><br />
            </div>
        </div>
        <div class="col-md-5 text-white" style="border:1px solid #808080; ">
            <label class="h5 p-1"><b>Account Name - Ei Thinzar Ko</b></label><br />
            <label class="h5 p-1"><b>Phone Number - 09986715035</b></label><br />
            <img src="{{ asset("images/kpayImg.png") }}" class="m-auto p-2" style="width: 260px;height: 300px; " />
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
                style="border-radius:20px; background-color:#aa0000; width:10%">Send</button>
        </a>
    </div>
    <hr style="margin-top: 20px;color:white;" />
    <div class="mt-3 text-white text-center">
        <p>Questions about this payment? Contact <a href=" "><u> GameHub Myanmar</u></a></p>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
// Create a Stripe client.
window.onload = function() {
    var stripe = Stripe(
        'pk_test_51Kd9j5EADO6FT0UAYme7Vttx1eyBRvbKiJbVY5TKXPMIO2OBXtmkPmXem6BS89zJqAHa8fIkTLMjloP1gYM8KjvT00yQ6XCHPU'
    );

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var options = {
            name: document.getElementById('name').value,
            address_line1: document.getElementById('address').value,
            address_city: document.getElementById('city').value,
            address_state: document.getElementById('state').value,
            address_zip: document.getElementById('postalcode').value
        }

        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
}
</script>
@endsection