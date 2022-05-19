@extends ('admin.layouts.main')

@section ('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All Brands</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Table</li>
        <li class="breadcrumb-item active" aria-current="page">Brands</li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Brands </h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>SN</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @if(count($brands) > 0)
                @foreach($brands as $key=>$value)
                <tr>
                  <td><a href="#">{{$key+1}}</a></td>
                  <td><img src="{{Storage::url($value->image)}}" width="100" alt=""></td>
                  <td>{{$value->name}}</td>
                  <td> 
                    <input data-id ="{{$value->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" data-size="xs" id="catcat" {{$value->status ? 'checked' : ''}}>
                  </td>
                  <td><a href="{{ route('brand.edit', $value->id) }}"><button class="btn btn-primary">Edit</button></a></td>
                  <td>
                    <form action="{{ route('brand.destroy',$value->id) }}" method="POST">@csrf
                      @method('DELETE')   
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                @else
                  <td>No brands listing yet.</td>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
   $(document).ready(function(){
    $(function(){
        $('.toggle-class').change(function(){
           var status = $(this).prop('checked') == true ? 1 : 0;
          var subcategory_id = $(this).data('id');
          // var category_id = $("#catcat").val();
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                } 
            });
            $.ajax({
              type: "GET",
              url: '/auth/changedSubCategoryStatus',
              dataType: "json",
              data: {'id' : subcategory_id, 'status' : status},
              success:function(data){
               alert("Status Changed")
              }
        });
        });
    });
   });
</script>
@endsection