@extends ('admin.layouts.main')

<style>
    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .button {
        color: gray;
        border-radius: 8px;
        font-weight: bold;
    }

    .upload-btn-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
    }
</style>

@section ('content')
    <div class="d-smflex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">@csrf
                @method('PATCH')
                <div class="card mb-6">
                    <div class="card-header py-3 d-flex flex-row align-item-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Create Product
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ $product->name }}" id="" aria-describedby="" placeholder="Enter name of product" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Code</label>
                                <input type="text" name="product_code" class="form-control" value="{{ $product->code }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="">Choose Category</label>
                                <select name="category" id="" class="form-control @error ('category') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach 
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col-md-6">
                                <label for="">Choose Brand</label>
                                <select name="brand" id="" class="form-control @error ('brand') is-invalid @enderror" required>
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                                    @endforeach 
                                </select>
                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                <div class="bg-light container-fluid">
                                    <div class="container">
                                        <table class="table text-gray" id="product_info_table" name="table">
                                            <thead>
                                                <tr>
                                                    <td>Color</td>
                                                    <td>Price</td>
                                                    <td>Quantity</td>
                                                    <td>Discount</td>
                                                    <td>Product Type</td>
                                                    <td>Special</td>
                                                    <td>Upload Image</td>
                                                    <td><button type="button" id="add_row" class="btn btn-default bg-white"><i class="fa fa-plus"></i></button></td>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($productDetail as $product)
                                                    
                                                <tr id="row_{{ $product->id }}">
                                                    <td>
                                                        <input type="text" name="product_detail_id[]" id="product_id_{{$product->id}}" value="{{$product->id}}" style="width:30px;">
                                                    </td>
                                                    <td>
                                                        <input type="color" name="color[{{$product->id}}]" id="colorpicker_1" value="{{$product->color}}" style="width:30px;">
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="number" name="product_price[{{$product->id}}]" id="product_price_1" value="{{$product->price}}" style="width:100px;height:42px;margin-left:-17px;border:1px solid black;" required>
                                                    </td>

                                                    <td>
                                                        <input type="number" name="quantity[{{$product->id}}]" id="quantity_1" value="{{$product->quantity}}" style="width:62px;height:42px;border:1px solid black;" required>
                                                    </td>

                                                    <td>
                                                        <input type="number" name="discount[{{$product->id}}]" id="discount_1" value="{{$product->discount}}" class="form-control" min="0">
                                                    </td>

                                                    <td>
                                                        <select name="product_type[{{$product->id}}]" id="product_type_1" style="height:42px;" required>
                                                            @foreach ($product_types as $key => $value)
                                                            <option value={{$key}} {{ $product->product_type == $key ? 'selected' : '' }}>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input id="is_special_1" type="checkbox" name="special[{{$product->id}}]" value="1" class="form-control" {{ $product->is_special == 1 ? 'checked' : '' }}>
                                                    </td>

                                                    <td class="upload-btn-wrapper" id="first_img_1">
                                                        <span class="button" id="first_button_1"><img src="{{Storage::url($product->image_1)}}" style="width:62%;cursor:pointer;" alt="first image"></span>
                                                        <input type="file" id="fist_product_image_1" name="product_image_1[{{$product->id}}]" onchange="loadFile(event)" data-id="1" data-row="first" >
                                                        <span id="first_image_text_1"></span>
                                                    </td>

                                                    <td class="upload-btn-wrapper" id="second_img_1">
                                                        <span class="button" id="se cond_button_1"><img src="@if ($product->image_2 == 'no-img') https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png @else {{ Storage::url($product->image_2) }} @endif" style="width:62%;cursor:pointer;" alt="second image"/></span>
                                                        <input type="file" id="second_product_image_1" name="product_image_2[{{$product->id}}]" onchange="loadFile(event)" data-id="1" data-row="second">
                                                        <span id="second_image_text_1"></span>
                                                    </td>

                                                    <td class="upload-btn-wrapper" id="third_img_1">
                                                        <span class="button" id="third_button_1"><img src="@if ($product->image_3 == 'no-img') https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png @else {{ Storage::url($product->image_3) }} @endif" style="width:62%;cursor:pointer;" alt="second image"/></span>
                                                        <input type="file" id="third_product_image_1" name="product_image_3[{{$product->id}}]" onchange="loadFile(event)" data-id="1" data-row="third">
                                                        <span id="third_image_text_1"></span>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        
                                    </div>


                                </div>
                                <hr/>
                                <br/>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="product_description" id="summernote" cols="30" rows="6" class="form-control @error ('product_description') is-invalid @enderror">{{ $product->description }}</textarea>
                                    @error('product_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="">Additional Information</label>
                                    <textarea name="product_additionalinfo" id="summernote1" cols="30" rows="3" class="form-control @error ('product_additionalinfo') is-invalid @enderror">{{ $product->additional_info }}</textarea>
                                    @error('product_additionalinfo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Wired Option</label>
                                    <input type="checkbox" name="wired_option" value="1" {{ $product->wireless == 1 ? 'checked' : '' }} />
                                </div>
                                
                        <div class="form-group float-right">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">

    $("#add_row").on('click', function() {
        var table = $("#product_info_table");
        var count_table_tbody_tr = $("#product_info_table tbody tr").length;
        var row_id = count_table_tbody_tr + 1;
        var html = '<tr id="row_'+row_id+'">'+
            '<td><input type="text" name="product_detail_id[]" id="product_id_'+row_id+'" value="0" style="width:30px;">'+
            '<td><input type="color" name="color[]" id="colorpicker_'+row_id+'" value="#0000ff" style="width:30px;"></td>'+ 
            '<td><input type="number" name="product_price[]" id="product_price_'+row_id+'" style="width:100px;height:42px;margin-left:-17px;border:1px solid black;"></td>'+
            '<td><input type="number" name="quantity[]" id="quantity_'+row_id+'" style="width:62px;height:42px;border:1px solid black;"></td>'+
            '<td>'+
                '<input type="number" name="discount[]" id="discount_'+row_id+'" class="form-control" min="0">'+
            '</td>'+
            '<td>'+
                '<select name="product_type[]" id="product_type_'+row_id+'" style="height:42px;">'+
                    '<option value="1">In-stock</option>'+
                    '<option value="2">Pre-Order</option>'+
                '</select>'+
            '</td>'+

            '<td>'+
                '<input id="is_special_'+row_id+'" type="checkbox"  name="special[]" value="1" class="form-control">'+
            '</td>'+
            
            '<td class="upload-btn-wrapper" id="frist_img_'+row_id+'">'+
                '<span class="button" id="frist_button_'+row_id+'"><img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png" style="width:62%;cursor:pointer;"/></span>'+
                '<input type="file" id="frist_product_image'+row_id+'" name="product_image_1[]" onchange="loadFile(event)" data-id='+row_id+' required data-row="first" />'+
                '<span id="first_image_text_'+row_id+'"></span>'+
            '</td>'+

            '<td class="upload-btn-wrapper" id="second_img_'+row_id+'">'+
                '<span class="button" id="second_button_'+row_id+'"><img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png" style="width:62%;cursor:pointer;"/></span>'+
                '<input type="file" id="second_product_image_'+row_id+'" name="product_image_2[]" onchange="loadFile(event)" data-id="'+row_id+'" data-row="second"/>'+
                '<span id="second_image_text_'+row_id+'"></span>'+
            '</td>'+

            '<td class="upload-btn-wrapper" id="third_img_'+row_id+'">'+
                '<span class="button" id="third_button_'+row_id+'"><img src="https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png" style="width:62%;cursor:pointer;"/></span>'+
                '<input type="file" id="third_product_image_'+row_id+'" name="product_image_3[]" onchange="loadFile(event)" data-id="'+row_id+'" data-row="third"/>'+
                '<span id="third_image_text_'+row_id+'"></span>'+
            '</td>'+
            '<td><button type="button" class="btn btn-default bg-white" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-minus"></i></button></td>'+
            '</tr>';
            '</tr>';

        if(count_table_tbody_tr >= 1) {
        $("#product_info_table tbody tr:last").after(html);  
        }
        else {
        $("#product_info_table tbody").html(html);
        }
    });

    function removeRow(tr_id)
    {
        $("#product_info_table tbody tr#row_"+tr_id).remove();
    }

    var loadFile = function(event) {
        for(var i =0; i< event.target.files.length; i++){
            var row_id = event.target.getAttribute('data-id');
            var img_row_id = event.target.getAttribute('data-row');
            var src = URL.createObjectURL(event.target.files[i]);
            $('#'+img_row_id+'_image_text_'+row_id).text('file uploaded');

        }
    };

    </script>
@endsection