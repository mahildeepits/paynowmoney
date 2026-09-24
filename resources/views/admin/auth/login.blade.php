@extends('admin.layouts.auth')
@section('title','MLM Software - Admin Panel')
@section('auth_header','Login your account')
@section('auth_sub_header','Login to your admin account securely!.')
@section('content')
    <div class="login-body">
        <div class="alert alert-danger text-left ajax-error" role="alert" style="display: none;">

        </div>
        @if(!$errors->isEmpty())
            <div class="alert alert-danger text-left" role="alert">
                {{ $errors->first() }}
            </div>
        @endif
        {!! Form::open(['route'=>'admin.login']) !!}
            <div class="form-group">
                {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Username*','autocomplete'=>'off']) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Password*','autocomplete'=>'new-password']) !!}
            </div>
            {!! Form::submit('Login',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
