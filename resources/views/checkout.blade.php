@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{route('cart.final-checkout')}}" method="POST" enctype="multipart/form-data" id="form">@csrf
        @if($cart_data != null)

        <div class="row">
            <div class="col-6 col-md-5  text-white">
                <i class="nav-item fa fa-user m-2 mb-4"> Hi {{Auth::getUser()->name}}</i>
                <div class="row mb-3" style="border:1px solid #808080; border-radius: 10px;">

                        @foreach($cart_data as $key => $carts)
                                <div class="col-md-4">
                                    <img src="{{Storage::url($carts['image'])}}"
                                        class="floar-right m-3 mx-auto" style=" border-radius: 20px; " alt="...">
                                </div>
                                <div class="col-md-4 mt-2 ">
                                    <p><u><b>{{$carts['product_name']}} </b></u></p>
                                    <p class="m-2"> Product Code:{{$carts['product_code']}} </p>
                                    <p class="m-2"> Category: {{$carts['category']}} </p>
                                    <p class="m-2"> Quantity: {{$carts['quantity']}} </p>
                                    @if($carts['product_type'] == 2) 
                                        <p class="m-2"> Waiting Time: 3weeks </p>
                                    @endif
                                    
                                </div>
                                <div class="col-md-4 mt-2 ">
                                    <p></p>
                                    <p class="mt-4 ml-2"> Color: {{$carts['color']}} </p>
                                    <p class="m-2"> Brand: {{$carts['brand']}} </p>
                                    <p class="m-2"> Status: {{$carts['product_type'] ==1 ? 'Instock' : 'Preorder'}} </p>
                                    <?php 
                                    
                                    $product_types[] = $carts['product_type'];

                                    if(in_array('2',$product_types)){
                                        $data = "true";
                                        $hidden = 'hidden';
                                    }else{
                                        $data = "false";
                                        $hidden = "";
                                    }
                                    
                                    ?>
                                </div>
                                <hr class="mx-auto" style="width:90%;  ">
                                <div class="text-right">
                                    <p class="m-2"><b>{{$carts['price'] * $carts['quantity']}}</b></p>
                                </div>
                        @endforeach

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
            <div class="col-md-4 text-white  mt-4" id="no_address_found"  >
                <a href="{{route('deliveryInfo.create')}}"  style="width: 18rem; float: right;" > 
                <u><i class="fa fa-plus" id="address"></i>Add New Address </i></u>
                <span id="no_address_text" style="color:#aa0000;"></span>
                </a>

                @if(count($delivery_info)>0)
                    @foreach($delivery_info as $delInfo)     
                <div class="card bg-dark m-2 border-secondary card-pf-view-single-select"  style="width: 18rem;  float: right;" >         
                    <div class="card-body">
                    <h4 class="card-title"> <b>{{$delInfo->name}}</b></h4>
                    <p class="card-text"> {{$delInfo->phoneNumber}}</p>
                    <p class="card-text">{{$delInfo->address}} ,{{$delInfo->township}},{{$delInfo->city}},{{$delInfo->state_region}}</p>
                    <input type="radio" name ="delInfo" id="existing_address" value ={{$delInfo->id}} style ="position: absolute;right: 5px;top: 5px;" required>
                    <span class="invalid-feedback" role="alert">
                        <strong>Please select address</strong>
                    </span>
                    </div>
                </div>
                    @endforeach               
                    <input type="hidden" id="no_address" value={{count($delivery_info)}} >

                @else
                <input type="text" id="no_address" required style="display: none;" ><br/>
                <span class="invalid-feedback text-center" role="alert">
                    <strong>No address available</strong>
                </span>
                @endif

                
            
            </div>
        </div>
        <div class="row mt-10">
            <div class="col-md-6 text-white bg-dark">
                <label class="h5 p-3"><b>CHOOSE PAYMENT METHOD</b></label><br />
                <div class="m-1 mb-5">
                    @foreach($payments as $key => $value)
                        @if($key == '1_k' || $key == '2_w')

                            <input type="radio" name="payment_type" id="payment_radio" class="form-check-input m-3" value="{{$key}}" required>
                        @else
                            <input type="radio" name="payment_type" id="payment_radio" class="form-check-input m-3" value="{{$key}}" {{$hidden}}>
                        @endif
                            <label class="h5 mt-2" for="{{$value}}"> @if ($key ==1) KBZ PAY @elseif ($key == 2) Wave Pay @elseif ($key == 3 && $data == "false") Cash On Delivery @endif</label><br/>
                        <label class="text-white"></label>
                    @endforeach
                    <span class="invalid-feedback" role="alert">
                        <strong id="address-alert">Please select a payment type</strong>
                    </span>

                </div>
            </div>
            <div class="col-md-5 text-white" style="border:1px solid #808080;" id="back-img">
         
                <img src="{{asset('images/kpay.png')}}" width="50px" height="50px" id="kpay" style="display:none;width: 260px;height: 300px; margin: auto;" alt="Kpay"/>
                <img src="{{asset('images/wave-money.png')}}" width="50px" height="50px" id="wpay" style="display:none;width: 260px;height: 300px;margin: auto;" alt="WavePay">         
                <img src="{{asset('images/cod.png')}}" width="50px" height="50px" id="cod" style="display:none; width: 100%" alt="Cosh on Delivery">         
            </div>
        </div>
        <br/>
        <div id="payment" class="hidden">
           
                <div class="form-group row">
                    <div class="col-md-3">
                        <label class="text-white">Account</label>
                        <input type="text" class="form-control" id="account" name="account">
                    </div>

                    <div class="col-md-3">
                        <label class="text-white">Phone number</label>  
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{11}">
                        <small class="text-white">Format: 09123456789</small>
                    </div>
                </div>

            {{-- </div> --}}
            
        </div>


        @else
        <div class="row m-auto">
            <div class="col-md-12" id="submit">
                <a href="{{route('home')}}" class="btn btn-sm mt-3 text-white" style="border-radius:20px; background-color:#aa0000;"><i class="fas fa-home"></i> Find your need. Shop with us.</a>
            </div>
        </div>
        @endif

        @if($cart_data != null)

        <div class="col-md-12 text-right" id="submit">
            <input type="submit" class="btn btn-sm mt-3 text-white" id="submit"  value="Checkout" style="border-radius:20px; background-color:#aa0000;">
        </div>
    
        <hr style="margin-top: 20px;color:white;" />
        <div class="mt-3 text-white text-center">
            <p>Questions about this payment? Contact <a href=" "><u> GameHub Myanmar</u></a></p>
        </div>
    
        @endif

    </form>

   
       
        <footer class="py-4 mt-5 text-white" style="background-color : #202020; border-radius: 10px">
            <div class="row">
                <div class="col-md-7">
                    <div class="container ">
                        <span class="h1" style="color: #aa0000;">GM <label class="h6 text-white">GAMEHUB
                                MYANMAR</label></span> <br />
                        <label>A place where you can shop and download free games in this gaminig community. </label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="container text-white">
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <p><b>Category</b></p>
                                @foreach ($categories as $category )
                                <a href="{{ route('productCategory',[$category->slug]) }}">
                                  <p>{{$category->name}}</p> 
                                </a>
                                @endforeach
                               
                            </div>
                            <div class="col-md-4  mt-2">
                                <p><b>Brand</b></p>
                                @foreach ($brands as $brand )
                                <a href="{{ route('productBrand',[$brand->slug]) }}">
                                    <p> {{$brand->name}}  </p> 
                                </a>
                                @endforeach
                            </div>
                            <div class="col-md-4  mt-2">
                                <p><b>Company</b></p>
                                <p> Terms & Condition </p>
                                <p> Privacy Policy </p>
                                <p> Supplier Relations </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" container row mt-10">
                <div class="col-md-4">
                    <p><i class="fa fa-clock"></i> Office Hour : 9AM to 5PM </p>
                </div>
                <div class="col-md-4 text-center ">
                    <p><i class="fa fa-phone"></i> Call Us: 0996332033,0996332033 </p>
                </div>
                <div class="col-md-4 text-right">
                    <p><i class="fa fa-envelope"></i> Mail Us: info@gmaihubmyanmar.com </p>
                </div>
            </div>
        </footer>
    
   
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {

    if($('#address').is(':checked')){

        $('#address').removeClass('is-invalid');

    }
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
        if(value == '1_k')
            {
            var img_src = document.getElementById('kpay').getAttribute('src');
            $('#back-img').css({"background-image":"url("+img_src+")"});
            $('#payment').show();
            $('#account').prop('required',true);
            $('#phone').prop('required',true);

            }
        else if(value == '2_w')
            {
            var img_src = document.getElementById('wpay').getAttribute('src');
            $('#back-img').css({"background-image":"url("+img_src+")"});
            $('#payment').show();
            $('#account').prop('required',true);
            $('#phone').prop('required',true);
            }
        else if(value == "3_c")
            {
            var img_src = document.getElementById('cod').getAttribute('src');
            $('#back-img').css({"background-image":"url("+img_src+")"});
            $('#payment').hide();
            $('#account').prop('required',false);
            $('#phone').prop('required',false);
            }
        
    });

    $("#submit").click(function(){
        if($("#no_address").val() > 0 && $('#existing_address').is(':checked') == false)
        {   
            $("#existing_address").addClass('is-invalid');


            $('html, body').animate({
                'scrollTop' : $("#existing_address").position().top
            });

        }else if($("#no_address").val() == 0 ){

            // $("#no_address_text").text("No address found");

            $("#no_address").addClass("is-invalid");

            
            $('html, body').animate({
                'scrollTop' : $("#no_address_found").position().top
            });

        }

        if($('[id=payment_radio]').is(':checked') == false)
        {
            $('[id=payment_radio]').addClass('is-invalid');
        }

        if($('#existing_address').is(':checked') == true && $('[id=payment_radio]').is(':checked') == true)
        {
            $("#form").submit();     
        }
    })

        $('[id=payment_radio]').on('click',function(){
            
            $('[id=payment_radio]').removeClass('is-invalid');

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