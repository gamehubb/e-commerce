@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        <div class="album py-2 ">
            <div class="container text-white">    
                <h3 class="h4">Manage Your Account</h3><br>
                <p class="m-2 h5"><b>Account Info</b> <a  class="text-red link-light" href= "{{route('user.changeAccountInfo')}}"><small class="fas fa-edit fa-1x ml-4"></small></a></p>   
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
                    <tr  >
                        <td><p class="m-2">Phone Number</p></td>
                        <td><p class="ml-4">{{ $userInfo->phone_number}}</p></td>
                    </tr>

                </table>
               
            </div>
        </div>

    </main>
   
</div>
@endsection