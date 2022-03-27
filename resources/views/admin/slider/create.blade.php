@extends ('admin.layouts.main')

@section ('content')
    <div class="d-smflex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Slider</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Slider</li>
        </ol>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
            <form action="/auth/slider/create" method="POST" enctype="multipart/form-data">@csrf
                <div class="card mb-6">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Create Slider
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-file">
                                <label for="" class="custom-file-label">Choose File</label>
                                <input type="file" class="custom-file-input @error('slider_image') is-invalid @enderror" id="customFile" name="slider_image">
                                @error('slider_image')
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
@endsection