@extends('layouts.app')
 
@section('content')

<div class="container justify-content-center  mt-1000">
    <p class="h2 text-white text-center">2022 World Cup - Final</p>
    <div class="row" style="margin-top: 80px; margin-bottom:180px;">
        <div class="col-md-5 col-sm-6 teams border-team" style="border-radius: 25px">
            <div class="our-team  text-center">
                <div class="pic">
                    <img src="{{asset('images/arg.png')}}" width="300px"  id="worldcup" style="  margin: auto;" alt="World Cup"/>
                </div>
                <h3 class="title h2">Argentina</h3>   
                <input type="button" class="btn text-white mt-3 btn-lg argentina" id= "argentina" name= "argentina" style="background-color : #aa0000;" value="Vote"/>       
            </div> 
        </div>
        <div class="col-md-2 col-sm-6 align-self-center">
        <p class="text-white h3 text-center">Vs</p>
        </div>
        <div class="col-md-5 col-sm-6 teams border-team" style="border-radius: 25px">
            <div class="our-team  text-center">
                <div class="pic">
                    <img src="{{asset('images/france.png')}}" width="200px" id="worldcup" style="margin: auto;" alt="World Cup"/>
                </div>
                <h3 class="title h2">France</h3>
                <input type="button"  class="btn text-white mt-3 btn-lg france"  id= "france"  name= "france" style="background-color : #aa0000;" value="Vote"/>       
        </div>
    </div>
  </div>
 
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var team =  sessionStorage.getItem("team");
 
if(team =="argentina"){
    $('.btn').attr('disabled' , 'disabled' );
    $('#argentina').css('background-color', 'green');
    $('#argentina').val('Voted');
}
else if(team =="france"){
    $('.btn').attr('disabled' , 'disabled' );
    $('#france').css('background-color', 'green');
    $('#france').val('Voted');
}
// Card Single Select
$('.btn').click(function() {
    $('.btn').val('Vote');
    $('.btn').css('background-color', '#aa0000');
    $('.btn').attr('disabled' , 'disabled' );
    var name = $(this).attr("name");
    sessionStorage.setItem("team",name);
    $(this).val('Voted');
    $(this).css('background-color', 'green');  
    $('.percent').removeAttr("hidden");
});
});
</script>
@endsection