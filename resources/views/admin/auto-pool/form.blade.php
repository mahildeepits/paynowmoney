@php
$route = 'auto-pool.store';
$method = 'POST';
$title = 'Create Autopool';
    if(isset($autopool)){
        $route = ['auto-pool.update',$autopool->id];
        $method = 'PUT';
        $title = 'Edit Autopool';
    }
@endphp
@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route'=> $route,'files'=>true,'method' => 'POST']) !!}
                            @method($method)
                            <h5>{{$title}}</h5>
                            <div class="row mt-4">
                                <div class="col-md-6 @error('name') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('name','Name') !!} <span class="text-danger">*</span>
                                        {!! Form::text('name',$autopool->name ?? null,['class'=>'form-control',]) !!}
                                        @error('name')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 @error('count_4') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('count_4','Level 4') !!} <span class="text-danger">*</span>
                                        {!! Form::text('count_4',$autopool->count_4 ?? null,['class'=>'form-control',]) !!}
                                        @error('count_4')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 @error('count_16') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('count_16','Level 16') !!} <span class="text-danger">*</span>
                                        {!! Form::text('count_16',$autopool->count_16 ?? null,['class'=>'form-control',]) !!}
                                        @error('count_16')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 @error('count_64') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('count_64','Level 64') !!} <span class="text-danger">*</span>
                                        {!! Form::text('count_64',$autopool->count_64 ?? null,['class'=>'form-control',]) !!}
                                        @error('count_64')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 @error('count_256') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('count_256','Level 256') !!} <span class="text-danger">*</span>
                                        {!! Form::text('count_256',$autopool->count_256 ?? null,['class'=>'form-control',]) !!}
                                        @error('count_256')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 @error('count_1024') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('count_1024','Level 1024') !!} <span class="text-danger">*</span>
                                        {!! Form::text('count_1024',$autopool->count_1024 ?? null,['class'=>'form-control',]) !!}
                                        @error('count_1024')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 @error('count_4096') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('count_4096','Level 4096') !!} <span class="text-danger">*</span>
                                        {!! Form::text('count_4096',$autopool->count_4096 ?? null,['class'=>'form-control',]) !!}
                                        @error('count_4096')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 @error('count_16384') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('count_16384','Level 16384') !!} <span class="text-danger">*</span>
                                        {!! Form::text('count_16384',$autopool->count_16384 ?? null,['class'=>'form-control',]) !!}
                                        @error('count_16384')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 pt-1">
                                    {!! Form::submit('Save',['class'=>'btn btn-primary mt-4']) !!}
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
    
@endsection
