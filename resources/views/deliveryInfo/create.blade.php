@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

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
                    <select name="city" id="city" class="form-control" required>
                        <option selected disabled>State/Region</option>
                        <option value="ရန်ကုန်တိုင်းဒေသကြီး ရန်ကုန်မြို့">ရန်ကုန်တိုင်းဒေသကြီး ရန်ကုန်မြို့</option>
                        <option value="ရန်ကုန်တိုင်းဒေသကြီး အခြားမြို့များ">ရန်ကုန်တိုင်းဒေသကြီး အခြားမြို့များ</option>
                        <option value="ဧရာဝတီတိုင်းဒေသကြီး">ဧရာဝတီတိုင်းဒေသကြီး</option>
                        <option value="ပဲခူးတိုင်းဒေသကြီး">ပဲခူးတိုင်းဒေသကြီး</option>
                        <option value="ပဲခူးတိုင်းဒေသကြီး တောင်ငူမြို့">ပဲခူးတိုင်းဒေသကြီး တောင်ငူမြို့</option>
                        <option value="ပဲခူးတိုင်းဒေသကြီး သာယာဝတီမြို့">ပဲခူးတိုင်းဒေသကြီး သာယာဝတီမြို့</option>
                        <option value="မကွေးတိုင်းဒေသကြီး">မကွေးတိုင်းဒေသကြီး</option>
                        <option value="မကွေးတိုင်းဒေသကြီး မင်းဘူးမြို့">မကွေးတိုင်းဒေသကြီး မင်းဘူးမြို့</option>
                        <option value="မန္တလေးတိုင်းဒေသကြီး">မန္တလေးတိုင်းဒေသကြီး</option>
                        <option value="မန္တလေးတိုင်းဒေသကြီး မန္တလေးမြို့">မန္တလေးတိုင်းဒေသကြီး မန္တလေးမြို့</option>
                        <option value="မန္တလေးတိုင်းဒေသကြီး ညောင်ဦးမြို့">မန္တလေးတိုင်းဒေသကြီး ညောင်ဦးမြို့</option>
                        <option value="နေပြည်တော်တိုင်းဒေသကြီး နေပြည်တော်မြို့">နေပြည်တော်တိုင်းဒေသကြီး နေပြည်တော်မြို့</option>
                        <option value="တနသာ်ရီတိုင်းဒေသကြီး">တနသာ်ရီတိုင်းဒေသကြီး</option>
                        <option value="စစ်ကိုင်းတိုင်းဒေသကြီး">စစ်ကိုင်းတိုင်းဒေသကြီး</option>
                        <option value="စစ်ကိုင်းတိုင်းဒေသကြီး ရွှေဘိုမြို့">စစ်ကိုင်းတိုင်းဒေသကြီး ရွှေဘိုမြို့</option>
                        <option value="ချင်းပြည်နယ်">ချင်းပြည်နယ်</option>
                        <option value="ချင်းပြည်နယ် မတူပီမြို့">ချင်းပြည်နယ် မတူပီမြို့</option>
                        <option value="ကချင်ပြည်နယ်">ကချင်ပြည်နယ်</option>
                        <option value="ကချင်ပြည်နယ် မိုးညှင်းမြို့">ကချင်ပြည်နယ် မိုးညှင်းမြို့</option>
                        <option value="ကရင်ပြည်နယ်">ကရင်ပြည်နယ်</option>
                        <option value="မွန်ပြည်နယ်">မွန်ပြည်နယ်</option>
                        <option value="ရခိုင်ပြည်နယ်">ရခိုင်ပြည်နယ်</option>
                        <option value="ရခိုင်ပြည်နယ် သံတွဲမြို့">ရခိုင်ပြည်နယ် သံတွဲမြို့</option>
                        <option value="ရှမ်းပြည်နယ်">ရှမ်းပြည်နယ်</option>
                        <option value="ရှမ်းပြည်နယ် တောင်ကြီးမြို့">ရှမ်းပြည်နယ် တောင်ကြီးမြို့</option>


                        
                    </select>                
                </div>

                <div class="form-group m-2">
                    <label>Township</label>
                    <select name="township" id="township" id="select2" class="form-control" required></select>
                    </div>

                <div class="form-group m-2">
                    <label>Address</label>
                    <textarea name="address" id="address" cols="10" rows="3" class="form-control" required></textarea>
                </div>

                    <button type="submit" class="btn btn-sm mx-auto mt-3 text-white"
                        style="border-radius : 20px;width:20%; background-color : #aa0000; float: right;">Save</button>
               
            </form>  
        </div>  
    </div>
</div>

@endsection