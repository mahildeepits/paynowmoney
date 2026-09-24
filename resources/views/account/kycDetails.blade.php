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
                        <li class="breadcrumb-item active" aria-current="page">KYC Doc</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                {!! Form::model($model,['method'=>'post','route'=>'update.kyc-documents','files'=>true]) !!}
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5>Edit KYC Doc</h5>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>KYC Type</td>
                                        <td>Card No</td>
                                        <td>Image Front</td>
                                        <td>Image Back</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($model as $k => $details)
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{ \App\Models\KycDoc::$kycTypes[$details->kyc_type] }}</td>
                                        <td>{{ $details->card_no }}</td>
                                        <td><img src="{{ asset('images/kyc_docs/'.$details->card_front) }}" width="100"/> </td>
                                        <td><img src="{{ asset('images/kyc_docs/'.$details->card_back) }}" width="100"/></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                {!! Form::label('name','Name:',['class'=>'col-md-2 pt-2']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('name',auth()->guard('member')->user()->name,['class'=>'form-control','readonly']) !!}
                                </div>
                            </div>
                            <div class="row mt-3">
                                {!! Form::label('kyc_type','KYC Type:',['class'=>'col-md-2 pt-2']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('kyc_type',\App\Models\KycDoc::$kycTypes,null,['class'=>'form-control','readonly','placeholder'=>'KYC Type']) !!}
                                    <small class="text-info text-danger">Note: Once you select your KYC details, it will never change again!</small>
                                    @error('kyc_type')
                                        <br/>
                                        <span class="text-info text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                {!! Form::label('card_no','Card No:',['class'=>'col-md-2 pt-2']) !!}
                                @php
                                    $readonly = false;
                                @endphp
                                <div class="col-md-8">
                                    {!! Form::text('card_no',null,['class'=>'form-control','placeholder'=>'Enter Card No','readonly'=>$readonly]) !!}
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    {!! Form::submit('Save KYC Details',['class'=>'btn btn-main btn-sm']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Card Front</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::file('card_front',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Card Back</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::file('card_back',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
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
        f
    </script>
@endsection
