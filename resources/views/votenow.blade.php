@extends('layouts.app')
 
@section('content')

<div class="container justify-content-center  mt-1000">
    <div class="row" style="margin-top: 100px; margin-bottom:180px;">
        <div class="col-md-5 col-sm-6 teams border-team" style="border-radius: 25px">
            <div class="our-team  text-center">
                <div class="pic">
                    <img src="{{asset('images/arg.png')}}" width="300px"  id="worldcup" style="  margin: auto;" alt="World Cup"/>
                </div>
                <h3 class="title h2">Argentina</h3>   
                <h4 class="percent h2 text-white" hidden>51%</h4>   
                <input   type="button"   class="btn text-white  mt-3" style="background-color : #aa0000;" value="Vote"/>       
            </div> 
        </div>
        <div class="col-md-2 col-sm-6 align-self-center">
        <p class="text-white h3 text-center">Vs</p>
        </div>
        <div class="col-md-5 col-sm-6 teams border-team" style="border-radius: 25px">
            <div class="our-team  text-center">
                <div class="pic">
                    <img src="{{asset('images/france.png')}}" width="200px"  id="worldcup" style="  margin: auto;" alt="World Cup"/>
                </div>
                <h3 class="title h2">France</h3>
                <h4 class="percent h2 text-white" hidden>49%</h4>   
                <input type="button"  class="btn text-white  mt-3" style="background-color : #aa0000;" value="Vote"/>       
        </div>
    </div>
  </div>
 
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {

// Card Single Select
$('.btn').click(function() {
    $('.btn').val('Vote');
    $('.btn').css('background-color', '#aa0000');
    $('.btn').attr('disabled' , 'disabled' );
    
    $(this).val('Voted');
    $(this).css('background-color', 'green');  
    $('.percent').removeAttr("hidden");
});
});
</script>
@endsection