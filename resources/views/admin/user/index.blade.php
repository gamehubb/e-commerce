@extends ('admin.layouts.main')

@section ('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All Users</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Email-Verification</th>
                  <th>Status</th>


                </tr>
              </thead>
              <tbody>
                @if(count($users) > 0)
                @foreach($users as $key=>$user)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>

                  <td>
                    <input data-id ="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="on" data-off="off" data-size="md" id="catcat" {{$user->email_verified ? 'checked' : ''}}>
                  </td>
                  <td>
                    <input data-id ="{{$user->id}}" class="toggle-class1" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="on" data-off="off" data-size="md" id="catcat" {{$user->status ? 'checked' : ''}}>
                  </td>
                  
                </tr>
                @endforeach
                @else
                  <td>No Users Created.</td>
                @endif
               
                    
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!--Row-->

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to logout?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
            <a href="login.html" class="btn btn-primary">Logout</a>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript">
     $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
          } 
      });
          $('.toggle-class').change(function(){
             var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');
            // var category_id = $("#catcat").val();
             
              $.ajax({
                type: "GET",
                url: '/auth/changeVerifiedStatus',
                dataType: "json",
                data: {'id' : user_id, 'status' : status},
                beforeSend: function(){
                  $("#preloader").show();
                  $("body").css("opacity",'0.3');
                },
                success:function(data){
                  $("#preloader").hide();
                  $("body").css("opacity",'1');       
               }
          });
          });

          $('.toggle-class1').change(function(){
             var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');
            // var category_id = $("#catcat").val();
             
              $.ajax({
                type: "GET",
                url: '/auth/statusToggle',
                dataType: "json",
                data: {'id' : user_id, 'status' : status},
                beforeSend: function(){
                  $("#preloader").show();
                  $("body").css("opacity",'0.3');
                },
                success:function(data){
                  $("#preloader").hide();
                  $("body").css("opacity",'1');       
               }
          });
          });
      });
  </script>
@endsection