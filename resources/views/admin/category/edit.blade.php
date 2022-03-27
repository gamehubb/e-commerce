@extends ('admin.layouts.main')

@section ('content')
    <div class="d-smflex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Category</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
            <form action="/auth/category/update/{{$category->id}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card mb-6">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Update Category
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="" aria-describedby="" value="{{$category->name}}">
                            @error('category_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="category_description" id="" cols="30" rows="3" class="form-control @error ('category_description') is-invalid @enderror">{{$category->description}}</textarea>
                            @error('category_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <label for="" class="custom-file-label">Choose File</label>
                                <input type="file" class="custom-file-input @error('category_image') is-invalid @enderror" id="customFile" name="category_image">
                                @error('category_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <img src="{{Storage::url($category->image)}}" width="200" alt="" class="edit_category">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection