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
                    <label>Delivery Township</label>
                    <input type="text" name="township" id="deltownship" class="form-control" required>
                </div>
                <div class="form-group m-2">
                    <label>City</label>
                    <input type="text" name="city" id="city" class="form-control" required>
                </div>
           
                
                <div class="form-group m-2">
                    <label>State/Region</label>
                    <input type="text" name="state_region" id="state" class="form-control">
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

@endsection