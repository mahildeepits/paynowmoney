@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Portal</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <h6>Edit Profile</h6>
                @php
                    $userDetails = auth()->guard('member')->user();
                @endphp
                {!! Form::open(['method'=>'post','route'=>'account.save-profile']) !!}
                    <div class="row mb-3 mt-3">
                        {!! Form::label('name','Name*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('name',auth()->guard('member')->user()->name,['class'=>'form-control','placeholder'=>'Enter name']) !!}
                            @error('name')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('father_name','Father Name*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('father_name',auth()->guard('member')->user()->father_name,['class'=>'form-control','placeholder'=>'Enter father name']) !!}
                            @error('father_name')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('address','Address*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('address',auth()->guard('member')->user()->profile_rel?->address,['class'=>'form-control','placeholder'=>'Enter address']) !!}
                            @error('address')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('city','City*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('city',auth()->guard('member')->user()->profile_rel?->city,['class'=>'form-control','placeholder'=>'Enter city']) !!}
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('country','Country*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('country',auth()->guard('member')->user()->profile_rel?->country,['class'=>'form-control','placeholder'=>'Enter country']) !!}
                            @error('country')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('state','State*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('state',auth()->guard('member')->user()->profile_rel?->state,['class'=>'form-control','placeholder'=>'Enter state']) !!}
                            @error('state')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('pin_code','Pincode*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6">
                            {!! Form::text('pin_code',auth()->guard('member')->user()->profile_rel?->pin_code,['class'=>'form-control','placeholder'=>'Pincode']) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('mobile','Mobile*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('mobile',auth()->guard('member')->user()->mobile,['class'=>'form-control','placeholder'=>'Mobile']) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('dob','DOB*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::date('dob',auth()->guard('member')->user()->dob,['class'=>'form-control','placeholder'=>'Date of Birth']) !!}
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('gender','Gender*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::select('gender',['male'=>'Male','female'=>'Female'],auth()->guard('member')->user()->gender,['class'=>'form-control','placeholder'=>'Gender']) !!}
                            @error('gender')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('email','Email Id*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('email',auth()->guard('member')->user()->email,['class'=>'form-control','placeholder'=>'Enter email']) !!}
                            @error('email')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('nominee_name','Nominee Name*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('nominee_name',auth()->guard('member')->user()->profile_rel?->nominee_name,['class'=>'form-control','placeholder'=>'Enter nominee name']) !!}
                            @error('nominee_name')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('nominee_relation','Nominee Relation*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('nominee_relation',auth()->guard('member')->user()->profile_rel?->nominee_relation,['class'=>'form-control','placeholder'=>'Enter nominee relation']) !!}
                            @error('nominee_relation')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            {!! Form::submit('Save Profile',['class'=>'btn btn-main']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('css')
    @parent
    <style type="text/css">

    </style>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            @if($userDetails->kyc_rel !== null)
                $('input').each(function(){
                    if($(this).attr('name') !== 'mobile' && $(this).attr('name') !== 'password'){
                        $(this).prop('readonly',true);
                    }
                })
            @endif
        });
    </script>
@endsection
