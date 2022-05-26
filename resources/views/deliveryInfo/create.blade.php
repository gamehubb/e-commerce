@extends('layouts.app')

@section('content')
<div class="container">
    
        <div class="col-md-8 text-white"  >     
            <form action="{{ route('deliveryInfo.store') }}" method="post" id="payment-form" style="width:60%;float: right;">@csrf
                <div class="form-group m-2">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" value={{auth()->user()->name}}
                        readonly="" required>
                </div>
                <div class="form-group m-2">
                    <label>PhoneNumber</label>
                    <input type="number" name="phoneNumber" id="phonenumber" class="form-control" required>
                </div>       
                <div class="form-group m-2">
                    <label>Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
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
             
               
                    <button type="submit" class="btn btn-sm mx-auto mt-3 text-white"
                        style="border-radius : 20px;width:50%; background-color : #aa0000; float: right;">Save</button>
               
            </form>  
        </div>  
</div>

@endsection