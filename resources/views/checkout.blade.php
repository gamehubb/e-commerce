@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{route('cart.final-checkout')}}" method="POST" enctype="multipart/form-data" id="form">@csrf
        @if($cart_data != null)

        <div class="row">
            {{-- <div class="col-md-6"> --}}
            <div class="content" style="display: none;" id="cart-loader">
                <div class="loading">
                    <h3 style="color:#fff !important;">Updating</h3>
                        <span style="color:#AA2B25;"></span>
                </div>
            </div>
            {{-- </div> --}}
            <div class=" col-md-5 text-white" id="cart-view">
                <b class="nav-item fa fa-user m-2 mb-4"> Hi {{Auth::getUser()->name}}</b>           
                <div class="row mb-3" style="border:1px solid #808080;">
                    
                        @foreach($cart_data as $key => $carts)

                                <?php $product_types[] = $carts['product_type']; ?>

                                <div class="col-md-4">
                                    <img src="{{Storage::url($carts['image'])}}"
                                        class="floar-right m-3 mx-auto" style=" border-radius: 20px; height:120px; " alt="...">
                                    <p class="m-2" style="display: inline-flex;"> 
                                        <i class="fa fa-minus col-md-1 ml-1" id="minus" onclick="updateCheckout(this)" data-id="{{$carts['product_id']}}" style="background: #802012;
                                        width: 50px;
                                        padding: 5px 8px 5px 17px;
                                        cursor: pointer;"></i><br>
                                        <span class="col-lg-1 ml-2" style="" id="qty_{{$carts['product_id']}}">{{$carts['quantity']}}</span>                       
                                        <br>
                                        <i id="product_id" hidden>{{$carts['product_id']}}</i>
                                        <i class=" fa fa-plus col-md-1 ml-1" id="plus" onclick="updateCheckout(this)" data-id="{{$carts['product_id']}}" 
                                        style="background: #802012;
                                        width: 50px;
                                        padding: 5px 8px 5px 17px;
                                        border-radius: 12px;
                                        cursor: pointer;"></i> 
                                    </p>
                                  
                                </div>
                                <div class="col-md-4 mt-2 ">
                                    <p><u><b>{{$carts['product_name']}} </b></u>
                                    </p>
                                    <p class="m-2"> Product-Code: {{$carts['product_code']}} </p>
                                    <p class="m-2"> Category: {{$carts['category']}} </p>
                                    
                                </div>
                                <div class="col-md-4 mt-2 ">
                                    <span class="bg-red" style="cursor:pointer;float:right; color:#aa0000;">
                                        <i class="fas fa-trash fa-1x " id="c_trash" onclick="removeCart(this)" data-id={{$carts['product_id']}}></i>
                                    </span>
                                    <p class="m-2"> Color: <span style="color: {{$carts['color']}};font-size : 25px;background:#fff;border:1px solid black;border-radius:5px;">●</span><br>
                                    </p>
                                    <p class="m-2"> Brand: {{$carts['brand']}} </p>
                                    <p class="m-2"> Status: {{$carts['product_type'] ==1 ? 'Instock' : 'Preorder'}} </p>
                                    <p class="m-2"> Price: <span id="price_{{$carts['product_id']}}" data-price={{$carts['price']}}>{{number_format($carts['price'] )}}</span> </p>
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
                                    {{-- @if($carts['product_type'] == 2)
                                        <p class="m-2"> Deposit-Amount: {{$carts['price']}} </p>
                                    @endif --}}
                                </div>
                                
                                <hr class="mx-auto" style="width:90%;">
                                {{-- <div class="text-center">
                                    <p class="ml-4 bg-red" style="cursor:pointer;float:right;"><i class="fas fa-trash" onclick="removeCart(this)" data-id="{{$carts['product_id']}}"></i></span>
                                </div> --}}
                                <div class="text-right">
                                    <p class="m-2" id="total_price_{{$carts['product_id']}}"><b>{{number_format($carts['price'] * $carts['quantity'])}}</b></p>
                                </div>
                                <hr class="mx-auto" style="width:90%;">
                        @endforeach

                </div>
                
           
            <div class="row mb-1">
                <div class="col-md-12 mt-2">
                    <p class="text-right">Sub-total: <span class="h5"><span id="total_price_3" class="h6 text-red" data-sub-total = {{session()->get('cart')->totalPrice}} >{{session()->has('cart')?number_format(session()->get('cart')->totalPrice):'0'}}</span></span>
                    </p>     
                    <div class="row mb-3">
                        <div class="col-md-12 mt-3">
                            <span class="h6" style="float:right;" >Shipment Fees:  <span id="del_fees" class='text-muted'>Calculating</span></span>
                        </div>
                    </div>
                    <hr class="mx-auto" style="width:100%;">


                    <div class="row mb-3">
                        <div class="col-md-12 mt-3">
                            <span class="h6" style="float:right;" >Total:  <span id="total_amount" class='text-light h5'>{{session()->has('cart')?number_format(session()->get('cart')->totalPrice):'0'}}</span><span class="h6"> Ks</span></span>
                        </div>
                        
                    </div>
                    {{-- {{print_r($product_types);}} --}}
                    @if(in_array("2",$product_types))
                        <?php
                            $d_amount = (int)session()->get('cart')->totalPrice * 0.3;
                        ?>
                        <p class="text-right">Deposit Amount: <span id="d_amount">{{number_format($d_amount)}}</span></p><br>
                        <small>*As you have items with preorder status, in the 
                            checkout proceess you will have to deposit 30% of the total amount.</small> 
                    @endif
                </div>

               
                
            </div>

            {{-- <hr class="mx-auto" style="width:100%;  "> --}}
            
            </div>
            <div class="col-md-4 text-white" id="no_address_found">
                <a href="{{route('deliveryInfo.create')}}" class="link-light" style="width: 18rem;" > 
                <b><i class="fa fa-plus" id="address" style="background: #802012;
                    width: 24px;
                    padding: 5px;
                    border-radius: 12px;
                    cursor: pointer;"></i> Add New Address ( <i>Delivery</i> ) </i></b>
                <span id="no_address_text" style="color:#aa0000;"></span>
                </a>

                @if(count($delivery_info)>0)
                    @foreach($delivery_info as $delInfo)     
                <div class="card bg-dark m-4 border-address card-pf-view-single-select" id="del_info_{{$delInfo->id}}" onclick="getDeliFees({{$delInfo->id}})" data-del-fees = {{$delInfo->delivery_fees}} style="width: 18rem;" >         
                    <div class="card-body">
                        <h4 class="card-title"> <b>{{$delInfo->name}}</b></h4>
                        <p class="card-text"> {{$delInfo->phoneNumber}}</p>
                        <p class="card-text">{{$delInfo->address}} ,{{$delInfo->township}},{{$delInfo->city}},{{$delInfo->state_region}}</p>
                        <input type="radio" name ="delInfo" id="existing_address" value ={{$delInfo->id}}  style ="position: absolute;right: 5px;top: 5px;" required>
                        
                    </div>
                    <span class="invalid-feedback" role="alert">
                        <strong>Please select address</strong>
                    </span>
                </div>
                    @endforeach               
                    <input type="hidden" id="no_address" value={{count($delivery_info)}}>
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
                <div class="form-check">
                    @foreach($payments as $key => $value)
                        @if($key == '1_k')
                            <img class="paymentimg" src="{{asset('images/kpaylogo.png')}}" width="50px" height="50px" id="{{$key}}" onclick="paymentclick(this)"  style="display: inline;cursor:pointer;border-radius:5px; margin:10px;" alt="Kpay"/>
                            <input type="radio" style="display: none;"  name="payment_type" id="payment_radio" data-id="{{$key}}" class="form-group m-3" value="{{$key}}" required>
                        @elseif($key == '2_w')
                            <img class="paymentimg" src="{{asset('images/wavepay.png')}}" width="50px" height="50px" id="{{$key}}" onclick="paymentclick(this)" style=" display: inline;cursor:pointer;border-radius:5px; margin:10px;" alt="Wpay"/>
                            <input type="radio" style="display: none;"   name="payment_type" id="payment_radio" data-id="{{$key}}" class="form-group m-3" value="{{$key}}" required>
                        @else
                            <img class="paymentimg" src="{{asset('images/codlogo.png')}}" width="50px" height="50px" id="{{$key}}" onclick="paymentclick(this)" style="display: inline;cursor:pointer;border-radius:5px; margin:10px;" alt="cod"/>
                            <input type="radio"  style="display: none;" name="payment_type" id="payment_radio" data-id="{{$key}}" class="form-group m-3" value="{{$key}}" {{$hidden}}>
                        @endif

                        <label class="h5 mt-2" style="color: #ffffff" for="{{$value}}" id = "lbl_{{$key}}">
                            @if ($key =='1_k') KBZ PAY
                            @elseif ($key ==  '2_w') Wave Pay 
                            @elseif ($key ==  '3_c' && $data == "false") Cash On Delivery 
                            @endif</label><br/>
                      
                    @endforeach
                    <span class="invalid-feedback" role="alert">
                        <strong id="address-alert">Please select a payment type</strong>
                    </span>

                </div>
            </div>
            <div class="col-md-5 col-xs-5 text-white" style="border:1px solid #808080;height:300px;" id="back-img">

                {{-- <img src="{{asset('images/black.jpg')}}" width="50px" height="50px" style="display:block;width: 260px;height: 300px; margin: auto;" alt="Kpay"/> --}}
                <img src="{{asset('images/kpay.png')}}" width="50px" height="50px" id="kpay" style="display:none;width: 260px;height: 300px; margin: auto;" alt="Kpay"/>
                <img src="{{asset('images/wave-money.png')}}" width="50px" height="50px" id="wpay" style="display:none;width: 260px;height: 300px;margin: auto;" alt="WavePay">         
                <img src="{{asset('images/cod.png')}}" width="50px" height="50px" id="cod" style="display:none; width: 100%" alt="Cosh on Delivery">         
            </div>
        </div>
        <br/>
        <div id="payment" class="hidden">
           
                <div class="form-group row">
                    <small class="text-light">*Please provide your account information</small><br/>
                    <div class="col-md-3">
                        <label class="text-white">Account</label>
                        <input type="text" class="form-control" id="account" name="account">
                    </div>

                    <div class="col-md-3">
                        <label class="text-white">Phone number</label>  
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{11}">
                        <small class="text-white">Format: 09-xxxxxxxxx</small>
                    </div>
                </div>            
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
            <input type="submit" class="btn btn-sm mt-3 text-white" id="submit"  value="Checkout" style="border-radius:20px; background-color:#aa0000;width: 125px;">
        </div>
    
        <hr style="margin-top: 20px;color:white;" />
        <div class="mt-3 text-white text-center">
            <p>Questions about this payment? Contact <a href="https://m.me/gamehubmyanmar/"><u> GameHub Myanmar</u></a></p>
        </div>
    
        @endif

    </form>    
   
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">

    function updateCheckout(icon)
        {

            if(icon.getAttribute('id') == 'plus'){

                var id = icon.getAttribute('data-id');
                var price = document.getElementById('price_'+id).getAttribute('data-price');
                $("#qty_"+id).text(1+parseInt($("#qty_"+id).text()));
                var qty = $("#qty_"+id).text();
                $.ajax({
                    type: "POST",
                    url: '/products/'+id,
                    data: { qty: qty, price: price },
                
                beforeSend: function(){
                    $("#cart-loader").css("display",'grid');
                    $("body").css("opacity","0.3");
                    $("#cart-view").css("display",'none');

                },
                success: function( response ) {
                    var value = JSON.parse(response);
                    var check_del = document.getElementById('del_fees').getAttribute('del-fees');
                    if(check_del == null){
                        var delivery_fees = 0;
                    }else{
                        var delivery_fees = document.getElementById('del_fees').getAttribute('del-fees');
                    }  
                    $("#total_price_"+id).text(custom_number_format(value.product_price));
                    $("#total_price_2").text(custom_number_format(value.total_price));
                    $("#total_price_3").text(custom_number_format(value.total_price));
                    $("#total_price_3").attr('data-sub-total',value.total_price);
                    $("#total_amount").text(custom_number_format(parseInt(delivery_fees) + parseInt(value.total_price)));
                    $("#cart-loader").css("display",'none');
                    $("#cart-view").css("display",'block');
                    $("body").css("opacity","1");
                    $("#cartcount").text(value.total_quantity);
                    $('#qty_'+id).text(qty);
                    $("")
                }
            });

            }else{

                var id = icon.getAttribute('data-id');
                var qty = $("#qty_"+id).text();
                var price = document.getElementById('price_'+id).getAttribute('data-price');

                $("#qty_"+id).text(parseInt(qty)-1);

                var qty_update = $("#qty_"+id).text();
                
                if(qty == 1) {
                    $("#qty_"+id).text('1');
                    alert("Minium amount reached");
                }else{

                    $.ajax({
                        type: "POST",
                        url: '/products/'+id,
                        data: { qty: qty_update, price: price },
                        beforeSend: function(){
                        $("#cart-loader").css("display",'grid');
                        $("body").css("opacity","0.3");
                        $("#cart-view").css("display",'none');

                        },
                        success: function( response ) {
                            var value = JSON.parse(response);
                            var check_del = document.getElementById('del_fees').getAttribute('del-fees');
                            if(check_del == null){
                                var delivery_fees = 0;
                            }else{
                                var delivery_fees = document.getElementById('del_fees').getAttribute('del-fees');
                            }
                            $("#total_price_"+id).text(custom_number_format(value.product_price));
                            $("#total_price_2").text(custom_number_format(value.total_price));
                            $("#total_price_3").text(custom_number_format(0 + value.total_price));
                            $("#total_price_3").attr('data-sub-total',value.total_price);
                            $("#total_amount").text(custom_number_format(parseInt(delivery_fees) + parseInt(value.total_price)));
                            $("#cart-loader").css("display",'none');
                            $("#cart-view").css("display",'block');
                            $("body").css("opacity","1");
                            $("#cartcount").text(value.total_quantity);
                        },
                    });

                }
            }
        }

        function custom_number_format( number_input, decimals, dec_point, thousands_sep ) {
            var number = ( number_input + '' ).replace( /[^0-9+\-Ee.]/g, '' );
            var finite_number   = !isFinite( +number ) ? 0 : +number;
            var finite_decimals = !isFinite( +decimals ) ? 0 : Math.abs( decimals );
            var seperater     = ( typeof thousands_sep === 'undefined' ) ? ',' : thousands_sep;
            var decimal_pont   = ( typeof dec_point === 'undefined' ) ? '.' : dec_point;
            var number_output   = '';
            var toFixedFix = function ( n, prec ) {
                if( ( '' + n ).indexOf( 'e' ) === -1 ) {
                return +( Math.round( n + 'e+' + prec ) + 'e-' + prec );
                } else {
                var arr = ( '' + n ).split( 'e' );
                let sig = '';
                if ( +arr[1] + prec > 0 ) {
                    sig = '+';
                }
                return ( +(Math.round( +arr[0] + 'e' + sig + ( +arr[1] + prec ) ) + 'e-' + prec ) ).toFixed( prec );
                }
            }
            number_output = ( finite_decimals ? toFixedFix( finite_number, finite_decimals ).toString() : '' + Math.round( finite_number ) ).split( '.' );
            if( number_output[0].length > 3 ) {
                number_output[0] = number_output[0].replace( /\B(?=(?:\d{3})+(?!\d))/g, seperater );
            }
            if( ( number_output[1] || '' ).length < finite_decimals ) {
                number_output[1] = number_output[1] || '';
                number_output[1] += new Array( finite_decimals - number_output[1].length + 1 ).join( '0' );
            }
            return number_output.join( decimal_pont );
        }

    $(document).ready(function() {

        // Card Single Select
        $('.card-pf-view-single-select').click(function() {
            if ($(this).hasClass('border-address') || $(this).hasClass('border-danger') )
            {
                $('.card-pf-view-single-select').removeClass('border-success');
                $('.card-pf-view-single-select').removeClass('border-danger');

                $('.card-pf-view-single-select').addClass('border-address');
            $(this).removeClass('border-address'); 
            $(this).addClass('border-success'); 
            $(this).find('input').prop('checked', true);  
            } 
        });
    });
    function paymentclick(logo) {
        var value = logo.getAttribute('id');
     
        if(value == '1_k')
        {
            var img_src = document.getElementById('kpay').getAttribute('src');
            $('#back-img').css({"background-image":"url("+img_src+")"});
            $('#payment').show();
            $('#account').prop('required',true);
            $('#phone').prop('required',true);
            $("input[data-id=1_k]").prop("checked", true);
            document.getElementById('lbl_1_k').style = "color: #aa0000;";
            document.getElementById('lbl_2_w').style = "color: #ffffff;";
            document.getElementById('lbl_3_c').style = "color: #ffffff;";
         
        }
        else if(value == '2_w')
        {
            var img_src = document.getElementById('wpay').getAttribute('src');
            $('#back-img').css({"background-image":"url("+img_src+")"});
            $('#payment').show();
            $('#account').prop('required',true);
            $('#phone').prop('required',true);
            $("input[data-id=2_w]").prop("checked", true);
            document.getElementById('lbl_2_w').style = "color: #aa0000;";
            document.getElementById('lbl_1_k').style = "color: #ffffff;";
            document.getElementById('lbl_3_c').style = "color: #ffffff;";
        }
        else if(value == "3_c")
        {
            var img_src = document.getElementById('cod').getAttribute('src');
            $('#back-img').css({"background-image":"url("+img_src+")"});
            $('#payment').hide();
            $('#account').prop('required',false);
            $('#phone').prop('required',false);
            $("input[data-id=3_c]").prop("checked", true);
            document.getElementById('lbl_3_c').style = "color: #aa0000;";
            document.getElementById('lbl_1_k').style = "color: #ffffff;";
            document.getElementById('lbl_2_w').style = "color: #ffffff;";
        }
        
    };

// Create a Stripe client.
    // $("input:radio[type=radio]").click(function() {
    //     var value = $(this).val();
    //     if(value == '1_k')
    //         {
    //         var img_src = document.getElementById('kpay').getAttribute('src');
    //         $('#back-img').css({"background-image":"url("+img_src+")"});
    //         $('#payment').show();
    //         $('#account').prop('required',true);
    //         $('#phone').prop('required',true);

    //         }
    //     else if(value == '2_w')
    //         {
    //         var img_src = document.getElementById('wpay').getAttribute('src');
    //         $('#back-img').css({"background-image":"url("+img_src+")"});
    //         $('#payment').show();
    //         $('#account').prop('required',true);
    //         $('#phone').prop('required',true);
    //         }
    //     else if(value == "3_c")
    //         {
    //         var img_src = document.getElementById('cod').getAttribute('src');
    //         $('#back-img').css({"background-image":"url("+img_src+")"});
    //         $('#payment').hide();
    //         $('#account').prop('required',false);
    //         $('#phone').prop('required',false);
    //         }
        
    // });

    function getDeliFees(id)
    {
        var del_fees = document.getElementById('del_info_'+id).getAttribute('data-del-fees');

        var sub_total = document.getElementById('total_price_3').getAttribute('data-sub-total');

        $("#del_fees").text(custom_number_format(del_fees));

        $("#del_fees").attr('del-fees',del_fees);

        $("#total_amount").text(custom_number_format(parseInt(del_fees) + parseInt(sub_total)));

    }

    $("#submit").click(function(){
        if($("#no_address").val() > 0 && $('#existing_address').is(':checked') == false)
        {   
            $('.card-pf-view-single-select').addClass('border-danger');


        }else if($("#no_address").val() == 0 ){

            // $("#no_address_text").text("No address found");

            $("#no_address").addClass("is-invalid");

            
            $('html, body').animate({
                'scrollTop' : $("#no_address_found").position()
            });

        }
        if($('[id=payment_radio]').is(':checked') == false)
        {
            $('[id=payment_radio]').addClass('is-invalid');
        }
        if($('#existing_address').is(':checked') == true && $('[id=payment_radio]').is(':checked') == true)
        {
            var id = $('input[type=radio][name=payment_type]:checked').attr('data-id');
            var name = document.getElementById('account').value;
            var phone = document.getElementById('phone').value;
            if((id == "1_k" || id == "2_w") && name != "" && phone != ""){
                $("#form").submit();   
            }else if(id == "3_c"){
                $("#form").submit();   
            }
           
           
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