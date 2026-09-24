@extends('layout.auth')
@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="{{ asset('images/54.png') }}" width="180" alt="" />
                            {{-- <h3>{{ config('app.name') }}</h3> --}}
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign in</h3>
                                        <p>Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a>
                                        </p>
                                    </div>
                                    <div class="form-body">
                                        {!! Form::open(['class'=>'row g-3','method'=>'post','route'=>'login']) !!}
                                        <div class="col-12">
                                            {!! Form::label('username','Username',['class'=>'form-label']) !!}
                                            {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Enter username']) !!}
                                            @error('username')
                                                <span class="text-danger text-info">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            {!! Form::label('password','Enter Password',['class'=>'form-label']) !!}
                                            <div class="input-group" id="show_hide_password">
                                                {!! Form::password('password',['class'=>'form-control border-end-0','placeholder'=>'Enter Password']) !!}
                                                <a href="javascript:void(0)" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                            @error('password')
                                                <span class="text-danger text-info">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end">	<a href="{{ route('forget.password') }}">Forgot Password ?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-main"><i class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
@endsection
