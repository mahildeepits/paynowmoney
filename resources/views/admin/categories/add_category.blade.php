@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
<div id="main-wrapper">
<div class="content-header">
   <h1 class="page-title">Category</h1>
</div>
@if(session('success_msg')==true)
    <div class="alert alert-success">{{session('success_msg')}}</div>
@endif
@if(session('exit')==true)
<div class="alert alert-danger">{{session('exit')}}</div>
@endif
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            {!! Form::open(['route'=>'createCategory','files'=>true]) !!}
            <h5>Create Category </h5>

            <div class="row mt-4">
               <div class="col-md-4 @error('name') has-error @enderror">
                  {!! Form::label('name',' Category Name*') !!}
                  {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Enter name','required']) !!}
                  @error('name')
                  <span class="help-block text-danger">
                  {{ $message }}
                  </span>
                  @enderror
               </div>

               <div class="col-md-4">
                  <div class="form-group">
                     <label>Select parent category*</label>
                     <select type="text" name="parent_id" class="form-control">
                        <option value="">None</option>
                        @if($categories)
                        @foreach($categories as $category)
                        <?php $dash=''; ?>
                            <option {{ old('parent_id') == $category->id ? 'selected' : '' }} style="font-size:22px;" value="{{$category->id}}">{{$category->name}}</option>
                             @if(count($category->subcategory))
                                     @include('admin.categories.subCategoryList-option',['subcategories' => $category->subcategory])
                             @endif
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>

               <div class="col-md-4 @error('category_Type') has-error @enderror">
                  {!! Form::label('category_Type','Category Type*') !!}
                  {!! Form::text('category_Type',old('category_Type'),['class'=>'form-control','placeholder'=>'Enter Type','autocomplete'=>'off','required']) !!}
                  @error('category_Type')
                  <span class="help-block text-danger">
                  {{ $message }}
                  </span>
                  @enderror
               </div>
            </div>

            <div class="row mt-4">
                 <div class="col-md-4">
                    <img  id="blah" class="mt-1 mb-1"  style="width: 120px; height:120px; border:1px solid black; margin-left:8px;" src="https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg" alt="your image" />
                    <input {{old('image')}} type="file" accept="image/png, image/gif, image/jpeg"  class="form-control {{$errors->first('image') ? 'is-invalid': ''}} "  style="background-color:white" name="image" id="" onchange="readURL(this)";/>
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
                @if ($errors->has('image'))
                <span  style="display: inline"  class="help-block text-danger">
                    {{ $errors->first('image') }}
                </span>
                @endif
                </div>


               <div class="col-md-4 @error('category_slug') has-error @enderror">
                    {!! Form::label('category_slug','Category Slug*') !!}
                    {!! Form::text('category_slug',old('category_slug'),['class'=> session()->has('slug_exit') ? 'form-control is-invalid' : 'form-control','placeholder'=>'Enter slug','autocomplete'=>'off','required']) !!}
                    @error('category_slug')
                    <span class="help-block text-danger">
                    {{ $message }}
                    </span>
                    @enderror
                    @if(session('slug_exit')==True)
                    <span class="help-block text-danger">
                    {{session('slug_exit')}}
                    </span>
                    @endif
                </div>

               <div class="col-md-4 @error('status') has-error @enderror">
                  {!! Form::label('status','Status*') !!}
                  <div class="col-mb-3">
                     {{ Form::radio('status', '1', true) }} Active
                     {{ Form::radio('status', '0') }} Inactive
                  </div>
                  @error('status')
                  <span class="help-block text-danger">
                  {{ $message }}
                  </span>
                  @enderror
               </div>


               <div class="col-md-3 pt-1">
                  {!! Form::submit('Save Catagory',['class'=>'btn btn-primary btn-lg mt-4']) !!}
               </div>
            </div>
            {!! Form::close() !!}
            <div class="divider"></div>
            <div class="row">
               <div class="col-md-12 table-responsive">
                  <table class="table table-striped table-bordered static-datatable">
                     <thead>
                        <tr>
                           <th>Sr No.</th>
                           <th>Catagory Name</th>
                           <th>Parents</th>
                           <th>Slug</th>
                           <th>Images</th>
                           <th width="160">Action</th>
                           <th width="160">Created At</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $index=1 ?>
                        @if($categoris_table)
                            @foreach($categoris_table as $category)
                        <tr>
                            <td><?=$index++?></td>
                            <td>{{$category->name}}
                                   @if($category->parent != null)
                                        {{'(subcat)'}}
                                    @endif
                            </td>
                            <td>
                                @if($category->parent != null)
                                        {{$category->parent->name }}
                                @endif
                            </td>
                            <td>{{$category->category_slug}}</td>
                            <td><img src="{{ asset('category/images/'.$category->category_images) }}" width="100" height="120"/></td>
                            <td>{{($category->status=='0')?'Deactivate':'Active'}}</td>
                            <td>{{ $category->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{route('delete_category',['id'=>$category->id])}}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-xs">Delete</a>
                                <a href="{{route('edit_category',['id'=>$category->id])}}"  class="btn btn-primary btn-xs">Edit</a>
                            </td>
                            <td>
                            </td>
                            </tr>
                            @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Main Wrapper -->
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#category_list').on('change',function(){
                        $value=$(this).val();
            });
        });
    </script>
@endsection

