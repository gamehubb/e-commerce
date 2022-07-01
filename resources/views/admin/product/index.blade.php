@extends ('admin.layouts.main')

@section ('content')
<div class="d-smflex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product</li>
    </ol>
</div>
<div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Category</th>         
              <th>Brand</th>
              <th>Status</th>
              <th>Image</th>
              <th colspan="2">Actions</th>     
            </tr>
          </thead>
          <tbody>
            @if(count($products)>0)

            @foreach($products as $product)
            <tr>
              
              <td style="">
                <img src="{{Storage::url($product->productDetail[0]['image_1'])}}" width="100" alt="Image-1" class="index_image">
              <td>{{$product->name }}</td>
              <td>{{$product->category->name}}</td>
              <td>{{$product->brand->name}}</td>
              <td>
                <input data-id ="{{$product->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" data-size="xs" id="catcat" {{$product->status ? 'checked' : ''}}>
              </td>
               
              <td><a href="{{route('product.edit', $product->id)}}"><button class="btn btn-primary">Edit</button></a></td>
              <td>
                <form action="{{route('product.destroy', $product->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>  
              </td> 
            </tr>
            @endforeach
            @else 
              <td>No any products</td>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript">
     $(document).ready(function(){
      $(function(){
          $('.toggle-class').change(function(){
             var status = $(this).prop('checked') == true ? 1 : 0;
            var product_id = $(this).data('id');
            // var category_id = $("#catcat").val();
             $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                  } 
              });
              $.ajax({
                type: "GET",
                url: '/auth/changedProductStatus',
                dataType: "json",
                data: {'id' : product_id, 'status' : status},
                success:function(data){
                 alert("Status Changed")
                }
          });
          });
      });
     });
  </script>
@endsection