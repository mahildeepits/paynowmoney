@php
$route = 'level-income.store';
$method = 'POST';
$title = 'Create Level Income';
    if(isset($levelIncome)){
        $route = ['level-income.update',$levelIncome->id];
        $method = 'PUT';
        $title = 'Edit Level Income';
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
                        {!! Form::open(['route'=> $route,'files'=>true,'method' => 'POST', 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
                            @method($method)
                            <h5>{{$title}}</h5>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('level','Level (Unique Number)') !!} <span class="text-danger">*</span>
                                        {!! Form::number('level',$levelIncome->level ?? null,['class'=>'form-control','min'=>1, 'required'=>true]) !!}
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('amount','Amount') !!} <span class="text-danger">*</span>
                                        {!! Form::number('amount',$levelIncome->amount ?? null,['class'=>'form-control','step'=>'any', 'required'=>true]) !!}
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('months','Months Count') !!} <span class="text-danger">*</span>
                                        {!! Form::number('months',$levelIncome->months ?? null,['class'=>'form-control', 'required'=>true]) !!}
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 pt-1">
                                    {!! Form::submit('Save',['class'=>'btn btn-primary mt-4']) !!}
                                    <a href="{{ route('level-income.index') }}" class="btn btn-secondary mt-4">Back</a>
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
