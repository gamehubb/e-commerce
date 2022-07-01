@extends('layouts.app')

@section('content')
<div class="container">
    
        <div class="col-md-4 text-white m-auto">     
            <form action="{{ route('deliveryInfo.store') }}" method="post" id="payment-form" style="">@csrf
                <div class="form-group m-2">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" value={{auth()->user()->name}}
                       >
                </div>
                <div class="form-group m-2">
                    <label>PhoneNumber</label>
                    <input type="number" name="phoneNumber" id="phonenumber" class="form-control" value={{auth()->user()->phone_number}} required>
                </div>       
                
                <div class="form-group m-2">
                    <label>State/Region</label>
                    <select name="state_region" id="state_region" class="form-control">
                        <option disabled>Select Region</option>
                        <option value="Yangon" selected>Yangon</option>
                        <option disabled>Coming Soon</option>
                        
                    </select>
                </div>

                <div class="form-group m-2">
                    <label>City</label>
                    <select name="city" id="city" class="form-control">
                        <option disabled selected>Select City</option>
                        <option value="Yangon City">Yangon City</option>
                        <option value="Dagon Myothit">Dagon Myothit</option>
                        <option value="Yangon Division">Yangon Division</option>
                        
                    </select>                
                </div>

                <div class="form-group m-2">
                    <label>Delivery Township</label>
                    <select name="township" id="township" class="form-control"></select>
                    </div>

                <div class="form-group m-2">
                    <label>Address</label>
                    <textarea name="address" id="address" cols="10" rows="3" class="form-control" required></textarea>
                </div>

                    <button type="submit" class="btn btn-sm mx-auto mt-3 text-white"
                        style="border-radius : 20px;width:50%; background-color : #aa0000; float: right;">Save</button>
               
            </form>  
        </div>  
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#city').on('change',function(e) {
            var cat_id = e.target.value;
            $.ajax({
                url:"/getTownship/"+cat_id,
                type:"GET",

                    beforeSend:function(data){
                        $("#preloader").css('display','block');
                        $("body").css('opacity','0.3');

                    },
            
                    success:function (data) {
                        $('#township').empty();
                        $.each(Object.values(data),function(index,township){
                        $('#township').append('<option value="'+township+'">'+township+'</option>');
                        $("#preloader").css('display','none');
                        $("body").css('opacity','1');
                    })
                }
            });

    });

})
</script>

@endsection