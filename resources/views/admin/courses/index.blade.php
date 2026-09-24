@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Courses</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if(request()->has('edit'))
                            {!! Form::model($editCourse,['route'=>'admin.courses.save','files'=>true]) !!}
                            {!! Form::hidden('id',request()->edit) !!}
                        @else
                            {!! Form::open(['route'=>'admin.courses.save','files'=>true]) !!}
                        @endif
                            <h5>Create Course</h5>
                            <div class="row mt-4">
                                <div class="col-md-3 @error('kit_name') has-error @enderror">
                                    {!! Form::label('code','Course Code') !!}
                                    {!! Form::text('code',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                    @error('code')
                                        <span class="help-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 @error('name') has-error @enderror">
                                    {!! Form::label('name','Course Name') !!}
                                    {!! Form::text('name',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                    @error('name')
                                        <span class="help-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 @error('price') has-error @enderror">
                                    {!! Form::label('price','Price') !!}
                                    {!! Form::number('price',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                    @error('price')
                                        <span class="help-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 @error('price') has-error @enderror">
                                    {!! Form::label('duration','Duration (in Weeks)') !!}
                                    {!! Form::number('duration',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                    @error('duration')
                                        <span class="help-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 @error('price') has-error @enderror">
                                    {!! Form::label('description','Description') !!}
                                    {!! Form::textarea('description',null,['class'=>'form-control','autocomplete'=>'off','rows'=>5]) !!}
                                    @error('description')
                                        <span class="help-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-2">
                                    {!! Form::label('image','Course Image') !!}
                                    {!! Form::file('image',null,['class'=>'form-control']) !!}
                                </div>
                                <div class="col-md-3 pt-1">
                                    {!! Form::submit((request()->has('edit')?'Update Course':'Save Course'),['class'=>'btn btn-primary btn-lg mt-4']) !!}
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
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th width="160">Created At</th>
                                        <th width="160">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($courses as $index => $course)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $course->code }}</td>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->price }}</td>
                                                <td>{{ $course->duration }}</td>
                                                <td>{{ $course->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.courses') }}?edit={{ $course->id }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('admin.courses.delete', $course->id) }}" method="post" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
