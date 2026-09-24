@extends('admin.layouts.admin')
@section('title','MLM Software - Receipt')
@section('styles')
    <style>
        .fields_invalid{
            color:red;
        }

        #upload_album_thumbnail_show .image_box{
            max-width:150px;margin:10px 0 0 10px;border-radius:5px;
        }
        #upload_album_thumbnail_show .image_box img{
            width:100%;
            height:100%;
        }
        #vehicle_image_preview .append{
            max-width:150px;margin:10px 0 0 10px;border-radius:5px;
        }
        #vehicle_image_preview .append img{
            width:100%;
            height:100%;
        }
        #upload_album_thumbnail_show .image_box .deletealbumimage{
            position: absolute;
            top: -8px;
            right: -7px;
            background-color: black;
            padding: 4px;
            border-radius: 50%;
            width: 17px;
            height: 17px;
            text-align: center;
        }
        #vehicle_image_preview .append .remove_image{
            /* position: relative;
            top: -95px;
            right: -155px;
            background-color: black;
            padding: 4px;
            border-radius: 30px; */
            position: absolute;
            top: -8px;
            right: -7px;
            background-color: black;
            padding: 4px;
            border-radius: 50%;
            width: 17px;
            height: 17px;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Product</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.list.product', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Edit Products</h4>
                                </div>
                                <div class="col-md-4 pt-4">
                                    {!! Form::submit('View Products',['class'=>'btn btn-primary mt-3']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="divider"></div>
                        {!! Form::open(['route'=> 'admin.product.update','method'=>'post','files' => true]) !!}
                            <div class="row mb-3">
                                {!! Form::label('name','Product Name*',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-6">
                                    <input type="text" name="edit_id" value="{{$product->id}}" hidden>
                                    {!! Form::text('name',$product->name,['class'=>'form-control','placeholder'=>'Enter  Product name','required']) !!}
                                </div>
                                @error('name')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                                
                            @enderror
                            </div>
                            {{-- {{dd($product)}} --}}
                            <div class="row">
                                {!! Form::label('email','Category*',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-6 form-group">
                                    <?php $category ?>
                                    {!! Form::select('category_list', ['1'=>'Category1','2'=>'Category2'], $product->category_id, ['placeholder' => 'Select Category','class' =>'form-control','id' =>'category_list'])!!}
                                    {{-- {!! Form::select('category_list', $category->pluck('category_name'), $product->category_id,['placeholder'=>'Select Category','class' =>'form-control','id' =>'category_list']) !!} --}}
                                </div>
                                @error('category_name')
                                    <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                               @enderror
                            </div>
                         
                            <div class="row">
                                {!! Form::label('email','Sub Category*',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-6 form-group">
                                    <?php $optionsub=['1'=>'one','3']  ?>
                                    {{-- {!! Form::select('sub_category_list', $optionsub,$product->sub_category_id,['placeholder'=>'Select Subcategory','class'=>'form-control','id'=>'mySelect'])!!}                                       --}}
                                    {!! Form::select('sub_category_list',[],null,['placeholder'=>'Select Subcategory','class'=>'form-control','id'=>'mySelect'])!!}
                                </div>
                                @error('category_name')
                                    <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                               @enderror
                            </div>

                            <div class="row form-group">
                                {!! Form::label('price','Price',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4">
                                    {!! Form::number('price',$product->price,['class'=>'form-control','placeholder'=>'Enter price','required']) !!}
                                </div>
                                @error('price')
                                    <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                               @enderror
                            </div>
                            <div class="row form-group">
                                {!! Form::label('Discount','Discount Price',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4">
                                    {!! Form::number('discount',$product->discount,['class'=>'form-control','placeholder'=>'Enter discount','required']) !!}
                                </div>
                                @error('discount')
                                    <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                               @enderror
                            </div>
                            <div class="row form-group">
                                {!! Form::label('description','Description',['class'=>'col-md-2 col-form-label'])!!}
                                <div class="col-md-4">
                                    {!! Form::textarea('description', $product->description, ['class' => 'form-control','required'])!!}
                                </div>
                                @error('description')
                                    <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                               @enderror
                            </div>
                            <div class="row form-group">
                                {!! Form::label('Image','Image',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4 file">
                                    <input type="file" class="form-control" name="images[]" id="file" multiple required>
                                    <div id="vehicle_image_preview"  class=" row d-flex justify-content-start align-items-start"></div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="upload_album_thumbnail_show" class=" row d-flex justify-content-start align-items-start">
                                                        <?php foreach ($get_images as $key => $value) { ?>
                                                            <div class="image_box position-relative p-0"  style=" width:100px; height:100px; margin-right:20px;">
                                                                <img src="{{ asset('product/images/'.$value->image_path) }}"><i class="fa fa-times text-danger deletealbumimage" type="button" data-id="<?php echo $value->id; ?>" aria-hidden="true"></i>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                <span class="fields_invalid" id="file_errors">
                                                    
                                </span>
                            </div>
                            <div class="row form-group">
                                {!! Form::label('Stock Availablity','Stock Available',['class'=>'col-md-2 col-form-label'])!!}
                                <div class="col-md-4">
                                    {!! Form::number('stock_available', 10, ['class' => 'form-control','readonly'])!!}
                                </div>
                              
                            </div>
                            <div class="row form-group">
                                {!! Form::label('Quantity','Add Quantity',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4">
                                    {!! Form::number('quantity',$product->quantity,['class'=>'form-control','placeholder'=>'Enter Quantity','required']) !!}
                                </div>
                            </div>
                            <div class="row form-group">
                                {!! Form::label('Delivry Charges','Delivery Charges',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4">
                                    {!! Form::number('Dilevery Charges',$product->delivery_charge,['class'=>'form-control','placeholder'=>'Enter Charges','required']) !!}
                                    <small class="help-block text-muted">
                                        <p>Enter Amount For Delivery Charges ( For Eg Rs 50) want update</p>
                                    </small>
                                </div>
                            </div>
                            <div class="row form-group">
                                {!! Form::label('Sizes','Enter Available Sizes',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('Available Sizes',$product->sizes,['class'=>'form-control','placeholder'=>'Enter Sizes','required']) !!}
                                    <small class="help-block text-muted">
                                        <p>( Use Sizes Separated By , For Eg  S,M , L, XL, XXL )</p>
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    {!! Form::submit('Edit Product',['class'=>'btn btn-primary']) !!}
                                    {!! link_to_route('admin.product', 'Back', [], ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
     
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
    <script>
        var images=[];
        var $files=[];
                 $("#file").on("change",function(e){
                    e.preventDefault();
                    var that = $(this);
                    var $files = $(this)[0].files;
                    for (let i = 0; i < $files.length; i++) {
                        if($.inArray($files[i].type.toLowerCase(), ['image/jpeg','image/jpg','image/png','image/webp']) == -1){
                            $("#file_errors").html("Please select only jpeg, jpg, png  file.");
                            $("#file").val("");
                            return;
                        }
                        $("#file_errors").html("");
                        $("#vehicle_image_preview").append('<div class="col-3 append position-relative p-0" style="width: 50%; height: 70%"><img src="'+URL.createObjectURL($files[i])+'" data-index="'+i+'"/><i class="fa fa-times text-danger remove_image"  data-index="'+images.indexOf(i)+'"   aria-hidden="true"></i></div>');
                    }
                    images.push.apply(images,$files);
                    console.log(images);
                    $("#upload_album_thumbnails").show();
                    if(images.length > 0){
                        $(".upload_album_images").removeAttr('required');
                    }else{
                        $(".upload_album_images").attr('required','required');
                    }
                 });
                 $("body").on("click",".remove_image",function(e){
                    e.preventDefault();
                        var x=$(this).data('index');
                      images.splice(x,1);
                      $files.splice(x, 1);
                        console.log(images)
                        if(images.length === 0 ){

                            $("#file").val("");
                        }
                        $(this).parent().remove();
                });
        $(document).ready(function(){
            $('#category_list').on('change',function(e){
                e.preventDefault();
                    let value=$(this).val();
                    var url = "{{route('admin.get.subcategory','id')}}";
                        ajaxurl = url.replace('id', value);
                        var type = "GET";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                     
                    $.ajax({
                        type: type,
                        url: ajaxurl,
                        success: function (response) {
                               
                                const selectElement = document.getElementById("mySelect");
                                // Clear any existing options
                                selectElement.innerHTML = '';
                                if (response.data.length === 0) {
                                    const defaultOption = document.createElement("option");
                                    defaultOption.text = "No options available";
                                    selectElement.appendChild(defaultOption);
                                } 
                                else
                                {
                                    response.data.forEach(element => {
                                        const option = document.createElement("option");
                                        option.text = element.category_name;
                                        option.value = element.id;
                                        selectElement.appendChild(option);
                                    });
                                }
                        }
                    })
            });
            $('.deletealbumimage').click(function(e){
                e.preventDefault();
                var that = $(this);
                var $id = $(this).data('id');
                console.log($id);
                var url = "{{route('admin.delete_product_image','id')}}";
                url = url.replace('id', $id);
                if(confirm("Are you Sure Want to delete?")){
                    $.ajax({
                        url : url,
                        type : "GET",
                        success: function(response){
                            if(response.type =="success"){
                                $(that).parent().remove();
                            }
                        }
                    }); 
                }

            });
        });
    </script>
@endsection
