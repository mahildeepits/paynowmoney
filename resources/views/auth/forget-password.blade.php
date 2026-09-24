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
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Forget Password</h3>
                                        <p>Remember account details? <a href="{{ route('login') }}">Login Now</a>
                                        </p>
                                    </div>
                                    <div class="form-body">
                                        {!! Form::open(['class'=>'row g-3','method'=>'post','route'=>'forget.password']) !!}
                                        <div class="col-12">
                                            {!! Form::label('username','Username',['class'=>'form-label']) !!}
                                            {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Enter username']) !!}
                                            @error('username')
                                                <span class="text-danger text-info">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-main"><i class="bx bxs-lock-open"></i>Send Password</button>
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
