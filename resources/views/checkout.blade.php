@extends('layouts.app')

@section('content')
<form action="{{route('cart.final-checkout')}}" method="POST" enctype="multipart/form-data">@csrf

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

            </div>
           <hr class="mx-auto" style="width:100%;  ">
           <div class="row mb-3">
            <div class="col-md-8 mt-2 ">
                <p class="m-2  h6"> Subtotal : </p>
                <p class="m-2  h6">Delivery :</p>
            </div>
            <div class="col-md-4 mt-2 ">
                <p class="m-2 h6">MMKs {{session()->has('cart')?session()->get('cart')->totalPrice:'0'}}</p>
                <p class="m-2 h6">MMKs 0</p>
            </div>
           </div>
           <hr class="mx-auto" style="width:100%;  ">
           <div class="row mb-3">
            <div class="col-md-8 mt-2 ">
                <p class="m-2 h5"><b>TOTAL :</b></p>      
            </div>
            <div class="col-md-4 mt-2 ">
                <p class="m-2 h5"><b>MMKs {{session()->has('cart')?session()->get('cart')->totalPrice:'0'}} </b></p>
               
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
                <input type="radio" name ="delInfo" value ={{$delInfo->id}} style ="position: absolute;right: 5px;top: 5px;" required>
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
                @foreach($payments as $key => $value)
                    <input type="radio" id="{{$value}}" name="payment_type" class="form-check-input m-3" value="{{$key}}">
                    <label class="h5 mt-2" for="{{$value}}"> @if ($key ==1) KBZ PAY @elseif ($key == 2) Wave Pay @elseif ($key == 3) Cash On Delivery @endif</label><br/>
                    {{-- <label class="h5 mt-2" for="kbzpay">KBZ Pay</label><br /> --}}
                    {{-- <input type="radio" id="wavepay" name="payment_type" class="form-check-input m-3" value="2">
                    <label class="h5 mt-2" for="wavepay">Wave Pay</label><br />
                    @if($carts['product_type'] != 2) --}}
                        {{-- <input type="radio" id="cod" name="payment_type" class="form-check-input m-3" value="3">
                        <label class="h5 mt-2" for="cod">Cash On Delivery</label><br />
                    @endif --}}
                @endforeach

            </div>
        </div>
        <div class="col-md-5 text-white" style="border:1px solid #808080;">
            <label class="h5 p-1" id="kpay"><b>Account Name - Gamehub</b></label><br />
            <label class="h5 p-1" id="kpay"><b>Phone Number - 09986715035</b></label><br />
            <img src="{{asset('images/kpay.jpg')}}" width="50px" height="50px" id="kpay" style="display:none;width: 260px;height: 300px; margin: auto;" alt="Kpay"/>
            <img src="{{asset('images/wave-money.jpg')}}" width="50px" height="50px" id="wpay" style="display:none;width: 260px;height: 300px;margin: auto;" alt="WavePay">         
        </div>
    </div>
    <div id="payment">
        <div class="mt-3">
            <i class="fa fa-warning fa-xl m-2 mb-4" style="color: red"> </i>
            <label class="text-white">Don't forget to save your payment vocher.</label>
        </div>
        <div class="mt-3 text-white text-center">
            <label for="upload-photo">Upload you voucher</label>
            <input class="m-auto" type="file" name="payment_slip" id="upload-photo" style="width: 95px" onchange="return fileValidation()"/><br />
            <div id="imagePreview"></div>
        </div>
    </div>

    <input type="submit" class="btn btn-sm  mt-3 text-white bg-dark"
            value="Checkout" style="border-radius:20px; background-color:#aa0000; width:12%">
    @endif
    <hr style="margin-top: 20px;color:white;" />
    <div class="mt-3 text-white text-center">
        <p>Questions about this payment? Contact <a href=" "><u> GameHub Myanmar</u></a></p>
    </div>
</div>
</form>
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

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
           $(this).find('input').prop('checked', true);  
        } 
    });
  });
// Create a Stripe client.
    $("input:radio[type=radio]").click(function() {
        var value = $(this).val();
        if(value == 1)
            {
            $('[id=kpay]').show();
            $('#wpay').hide();
            $('#payment').show();
            }
        else if(value == 2)
            {
            $('[id=kpay]').hide();
            $('#wpay').show();
            $('#payment').show();
            }
        else if(value == 3)
            {
            $('[id=kpay]').hide();
            $('#wpay').hide();
            $('#payment').hide();
            }
        
    });

        function fileValidation() {
            var fileInput =
                document.getElementById('upload-photo');
             
            var filePath = fileInput.value;
         
            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            }
            else
            {
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'imagePreview').innerHTML =
                            '<img src="' + e.target.result
                            + 
                            '"style="width:100px;"/>';
                    };
                     
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }

</script>
@endsection