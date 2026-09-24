@extends('admin.layouts.admin')
@section('title','MLM Software - Receipt')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">KYC Details</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'get']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Edit KYC Details</h4>
                            </div>
                            <div class="col-md-3 form-group">
                                {!! Form::label('member_id','Member ID') !!}
                                @php
                                    $memberId = null;
                                    if(request()->has('user_id')){
                                        $memberId = \App\Models\User::find(request()->user_id)->member_id;
                                    }
                                    if(request()->has('member_id')){
                                        $memberId = request()->member_id;
                                    }
                                @endphp
                                {!! Form::text('member_id',$memberId,['class'=>'form-control']) !!}
                            </div>
                            <div class="col-md-4 pt-4">
                                {!! Form::submit('View KYC Details',['class'=>'btn btn-primary mt-3']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div class="divider"></div>
                        {!! Form::model($kycDetails,['method'=>'post','route'=>'admin.update.kyc','files'=>true]) !!}
                            @if(!empty($kycDetails))
                                {!! Form::hidden('id',@$user['id']) !!}
                            @endif
                        <div class="row mb-3">
                            {!! Form::label('name','Name*',['class'=>'col-md-2 col-form-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Name','readonly']) !!}
                                @error('name')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            {!! Form::label('kyc_type','KYC Type*',['class'=>'col-md-2 col-form-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('kyc_type',\App\Models\KycDoc::$kycTypes,null,['class'=>'form-control','placeholder'=>'Select Type']) !!}
                                @error('kyc_type')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            {!! Form::label('card_no','Card No*',['class'=>'col-md-2 col-form-label']) !!}
                            <div class="col-md-6 form-group">
                                {!! Form::text('card_no',null,['class'=>'form-control','placeholder'=>'Enter card no']) !!}
                                @error('card_no')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            {!! Form::label('card_front','Card Front',['class'=>'col-md-2 col-form-label']) !!}
                            <div class="col-md-4 form-group">
                                {!! Form::file('card_front',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="row form-group">
                            {!! Form::label('card_back','Card Back',['class'=>'col-md-2 col-form-label']) !!}
                            <div class="col-md-4">
                                {!! Form::file('card_back',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        @if(isset($kycDetails) && !empty($kycDetails) && isset($kycDetails['card_front']) && $kycDetails['card_back'])
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Card Front</h5>
                                    <img src="{{ asset('images/kyc_docs/'.$kycDetails['card_front']) }}" width="150" />
                                </div>
                                <div class="col-md-3">
                                    <h5>Card Back</h5>
                                    <img src="{{ asset('images/kyc_docs/'.$kycDetails['card_back']) }}" width="150" />
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 mt-4">
                                {!! Form::submit('Save KYC Details',['class'=>'btn btn-primary']) !!}
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
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
