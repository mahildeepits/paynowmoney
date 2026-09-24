@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
<div id="main-wrapper">
<div class="content-header">
   <h1 class="page-title">Category Edit</h1>
</div>
@if(session('success_msg')==true)
    <div class="alert alert-success">{{session('success_msg')}}</div>
@endif
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            {!! Form::open(['route'=>'edit_category','files'=>true]) !!}
            <h5>Create Category </h5>
            <div class="row mt-4">
               <div class="col-md-4 @error('name') has-error @enderror">
                  {!! Form::label('name',' Category Name*') !!}
                  {!! Form::text('name',$edit->name,['class'=>'form-control','placeholder'=>'Enter name']) !!}
                  @error('name')
                  <span class="help-block text-danger">
                  {{ $message }}
                  </span>
                  @enderror
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>Select parent category*</label>
                     <select disabled type="text" name="parent_id" class="form-control">
                        <option value="">None</option>
                        @if($categories)
                        @foreach($categories as $category)
                        <?php $dash=''; ?>
                            <option @if($category->id == $edit->id) selected @endif style="font-size:22px;" value="{{$category->id}}">{{$category->name}}</option>
                             @if(count($category->subcategory))
                                     @include('admin.categories.editSubCategoryList-option',['subcategories' => $category->subcategory,'edit_id'=>$edit->id])
                             @endif
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>

               <div class="col-md-4 @error('category_Type') has-error @enderror">
                  {!! Form::label('category_Type','Category Type*') !!}
                  {!! Form::text('category_Type',$edit->category_type,['class'=>'form-control','placeholder'=>'Enter Type','autocomplete'=>'off','required']) !!}
                  @error('category_Type')
                  <span class="help-block text-danger">
                  {{ $message }}
                  </span>
                  @enderror
               </div>
            </div>
            <div class="row mt-3">
            <div class="col-md-4">
                <img  id="blah" class="mt-1 mb-1"  style="width: 120px; height:120px; border:1px solid black; margin-left:8px;" src="{{asset('category/images//'.$edit->category_images)}}" alt="your image" />
                <input type="file" accept="image/png, image/gif, image/jpeg"  class="form-control"  style="background-color:white" name="image" id="" onchange="readURL(this)";/>

                @if ($errors->has('image'))
                <span class="help-block text-danger">
                    {{ $errors->first('image') }}
                </span>
                @endif

                <script>
                    function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#blah')
                                .attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                        }
                </script>
            </div>

               <div class="col-md-4 @error('category_slug') has-error @enderror">
                  {!! Form::label('category_slug','Category Slug*') !!}
                  {!! Form::text('category_slug',$edit->category_slug,['class'=>'form-control','placeholder'=>'Enter slug','autocomplete'=>'off','required']) !!}
                  @error('category_slug')
                  <span class="help-block text-danger">
                  {{ $message }}
                  </span>
                  @enderror

                  @if(session()->has('slug_exit'))
                  <span class="help-block text-danger">
                  {{session('slug_exit')}}
                  </span>
                  @endif

               </div>
               <div class="col-md-4 @error('status') has-error @enderror">
                  {!! Form::label('status','Status*') !!}
                  <div class="col-mb-3">
                     {{ Form::radio('status', '1', ($edit->status==1)?true:'') }} Active
                     {{ Form::radio('status', '0',($edit->status==0)?true:'') }} Inactive
                  </div>
                  @error('status')
                  <span class="help-block text-danger">
                  {{ $message }}
                  </span>
                  @enderror
               </div>

               <div class="col-md-4 mb-4">
                  {!! Form::submit('Update Catagory',['class'=>'btn btn-primary btn-lg mt-4']) !!}
                 <a href="{{route('createCategory')}}" class='btn btn-danger btn-lg mt-4 text-white'>Back</a>
               </div>


            </div>

            <input type="hidden" value="{{$edit->id}}" name="update_id">
            {!! Form::close() !!}

            {{-- <div class="divider"></div> --}}
         </div>
      </div>
   </div>
</div>
<!-- Main Wrapper -->
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
{{-- {{print_r($cate_gory)}} --}}
