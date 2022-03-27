@extends ('admin.layouts.main')

@section ('content')
    <div class="d-smflex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
            <form action="/auth/product/create" method="POST" enctype="multipart/form-data">@csrf
                <div class="card mb-6">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Create Product
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="" aria-describedby="" placeholder="Enter name of product">
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="product_description" id="summernote" cols="30" rows="6" class="form-control @error ('product_description') is-invalid @enderror"></textarea>
                            @error('product_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <label for="" class="custom-file-label">Choose File</label>
                                <input type="file" class="custom-file-input @error('product_image') is-invalid @enderror" id="customFile" name="product_image">
                                @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="product_price" class="form-control @error('product_price') is-invalid @enderror">
                            @error('product_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Additional Information</label>
                            <textarea name="product_additionalinfo" id="summernote1" cols="30" rows="3" class="form-control @error ('product_additionalinfo') is-invalid @enderror"></textarea>
                            @error('product_additionalinfo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <label for="">Choose Category</label>
                                <select name="category" id="" class="form-control @error ('category') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($select_category as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach 
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <label for="">Choose Sub Category</label>
                                <select name="subcategory" id="" class="form-control @error ('subcategory') is-invalid @enderror">
                                    <option value="">Select Subcategory</option>
                                   
                                </select>
                                @error('subcategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $("document").ready(function(){
            $('select[name="category"]').on('change',function(){
               var catId = $(this).val();
               if(catId){
                   $.ajax({
                       url: '/auth/subcategories/'+catId,
                       type: "GET",
                       dataType: "json",
                       success:function(data){
                           $('select[name="subcategory"]').empty();
                           $.each(data,function(key,value){
                               $('select[name="subcategory"]').append('<option value="'+key+'">'+value+'</option>');
                           })
                       }
                   })
               }
               else{
                   $('select[name="subcategory"]').empty();
               }
               
            });
        });
    </script>
@endsection