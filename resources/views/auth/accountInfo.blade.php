@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <div class="album py-2 ">
            <div class="container text-white">    
                <p class="mb-5 text-center h4"><b>Manage Your Account</b></p>
                <p class="m-2 h5"><b>Account Info</b></p>   
                <table  class="m-3">
                    <tr>
                        <td><p class="m-2">Account Name</p></td>
                        <td><p  class="ml-4">{{ $userInfo->name}}</p></td>
                    </tr>
                    <tr>
                        <td><p class="m-2">Email</p></td>
                        <td><p  class="ml-4">{{ $userInfo->email}}</p></td>
                    </tr>
                     <tr  >
                        <td><p class="m-2">Passowrd</p></td>
                        <td><p  class="ml-4">********  <a  class="text-red" href= "{{route('user.changePassword')}}"><small class="ml-4">Change passwrod? </small> </a></p></td>
                    </tr>
                </table>
                <hr class="mx-auto" style="width:100%; color: #ffffff; height: 1px; ">
                <p class="m-2 h5"><b>Personal Info</b></p>  
                <div class="row m-3">
                    <div class = "col-md-3">
                        <p  class="m-1">Phone Number</p>           
                    </div>
                    <div class = "col-md-5">
                        <p class="m-1">{{ $userInfo->phone_number}}</p>    
                       
                    </div>
                   
                </div>
            </div>
        </div>

    </main>
    <footer class="py-4 mt-5 container text-white" style="background-color : #202020; border-radius: 10px">
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
                              <p> {{$category->name}}  </p> 
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
@endsection