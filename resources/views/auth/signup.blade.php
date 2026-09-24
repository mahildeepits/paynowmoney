@extends('layout.auth')

@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="{{ asset('images/54.png') }}" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign Up</h3>
                                        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                                        </p>
                                    </div>
                                    <div class="form-body">
                                        {!! Form::open(['route'=>'register','class'=>'row g-3','method'=>'POST']) !!}
                                            {!! Form::hidden('parent_id',request()->parent) !!}
                                            @php
                                                $pin = request()->pin;
                                            @endphp
                                            @if(request()->has('no_pin') && request()->no_pin == "true")
                                                @php
                                                    $pin = '1231231';
                                                @endphp
                                                <div class="col-sm-6">
                                                    {!! Form::label('epin','E-Pin*') !!}
                                                    {!! Form::text('epin',$pin,['class'=>'form-control','placeholder'=>'Enter pin']) !!}
                                                    @error('epin')
                                                    <span class="text-danger text-info">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class="col-sm-6">
                                                {!! Form::label('sponsor','Sponsor*') !!}
                                                {!! Form::text('sponsor',request()->sponsor,['class'=>'form-control','placeholder'=>'Sponsor/Referral Username']) !!}
                                                <span class="ajax-error text-danger"></span>
                                                @error('sponsor')
                                                    <span class="text-danger text-info">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                {!! Form::label('sponsor_name','Sponsor Name*') !!}
                                                {!! Form::text('sponsor_name',null,['class'=>'form-control','placeholder'=>'Sponsor Name','readonly']) !!}
                                                @error('sponsor_name')
                                                    <span class="text-danger text-info">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            {{-- <div class="col-sm-6">
                                                {!! Form::label('position','Position*') !!}
                                                {!! Form::select('position',['left'=>'Left','right'=>'Right'],request()->position,['class'=>'form-control','placeholder'=>'Select Position']) !!}
                                                @error('position')
                                                    <span class="text-danger text-info">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div> --}}
                                            <div class="col-sm-6">
                                                {!! Form::label('full_name','Full Name*') !!}
                                                {!! Form::text('full_name',null,['class'=>'form-control','placeholder'=>'Enter Full Name']) !!}
                                                @error('full_name')
                                                    <span class="text-danger text-info">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                {!! Form::label('email','Email*') !!}
                                                {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                                                @error('email')
                                                    <span class="text-danger text-info">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                {!! Form::label('password','Password*') !!}
                                                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter Password']) !!}
                                                @error('password')
                                                    <span class="text-danger text-info">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                {!! Form::label('mobile','Mobile*') !!}
                                                {!! Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Enter Mobile']) !!}
                                                @error('mobile')
                                                    <span class="text-danger text-info">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-main"><i class='bx bx-user'></i>Sign up</button>
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
@section('scripts')
    @parent
    <script src="{{ asset('js/register.js?ref='.rand(1111,9999)) }}"></script>
@endsection
