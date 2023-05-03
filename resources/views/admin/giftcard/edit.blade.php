@extends ('admin.layouts.main')

@section ('content')
    <div class="d-smflex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Gift Card</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gift Card</li>
        </ol>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
            <form action="/auth/giftcard/update/{{$giftcard->id}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card mb-6">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Update Gift Card
                        </h6>
                    </div>
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-secondary">
                            <strong>User Info -</strong> <span>{{$giftcard->user_info}}</span><br/> 
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" aria-describedby="" placeholder="Enter your name" value="{{$giftcard->name}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="" aria-describedby="" placeholder="+95xxxxxx" value="{{$giftcard->phone}}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="" aria-describedby="" placeholder="No.xxxx" value="{{$giftcard->address}}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Fb link</label>
                                    <input type="text" name="fb_link" class="form-control @error('fb_link') is-invalid @enderror" id="" aria-describedby="" placeholder="Fb link" value="{{$giftcard->fb_link}}">
                                    @error('fb_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" id="" aria-describedby="" placeholder="Eg: 40000" value="{{$giftcard->amount}}">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Balance</label>
                                    <input type="text" name="balance" class="form-control @error('balance') is-invalid @enderror" id="" aria-describedby="" placeholder="Eg: 20000" value="{{$giftcard->balance}}">
                                    @error('balance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Expire Date</label>
                                    <input type="date" name="expire_date" class="form-control @error('expire_date') is-invalid @enderror" id="" aria-describedby="" min="{{date('Y-m-d')}}"placeholder="Eg: **-**-****" value="{{$giftcard->expire_date}}" >
                                    @error('expire_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="30" rows="3" class="form-control @error ('description') is-invalid @enderror">{{$giftcard->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection