@extends('admin.layouts.admin')
@section('title','MLM Software - Receipt')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Profile</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'get']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>View User Profile</h4>
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('member_id','Member ID') !!}
                                    {!! Form::text('member_id',request()->member_id,['class'=>'form-control']) !!}
                                </div>
                                <div class="col-md-4 pt-4">
                                    {!! Form::submit('View User Profile',['class'=>'btn btn-primary mt-3']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="divider"></div>
                        {!! Form::model($userModel,['method'=>'post','route'=>'admin.profile.update']) !!}
                            @if(!empty($userModel))
                                {!! Form::hidden('id',$userModel['user_id']) !!}
                            @endif
                            <div class="row mb-3">
                                {!! Form::label('name','Name*',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter name']) !!}
                                </div>
                            </div>
                            <div class="row">
                                {!! Form::label('email','Email*',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-6 form-group">
                                    {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter email']) !!}
                                </div>
                            </div>
                            <div class="row">
                                {!! Form::label('gender','Gender',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4 form-group">
                                    {!! Form::select('gender',['male'=>'Male','female'=>'Female'],null,['class'=>'form-control','placeholder'=>'Select Gender']) !!}
                                </div>
                            </div>
                            <div class="row form-group">
                                {!! Form::label('mobile','Mobile',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4">
                                    {!! Form::number('mobile',null,['class'=>'form-control','placeholder'=>'Enter mobile']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                {!! Form::label('password','Password',['class'=>'col-md-2 col-form-label']) !!}
                                <div class="col-md-4">
                                    {!! Form::number('password',null,['class'=>'form-control','placeholder'=>'Enter password']) !!}
                                    <small class="help-block text-muted">
                                        <p>Leave bank if do not want update</p>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl">
                                    <div class="accordion" id="bankDetails">
                                        <div class="card">
                                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#bankDet" aria-expanded="true" aria-controls="collapseOne">
                                                Bank Details
                                            </div>
                                            <div id="bankDet" class="collapse show" aria-labelledby="headingOne" data-parent="#bankDetails">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row mb-3">
                                                                {!! Form::label('bank_nominee_name','Nominee Name*',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6">
                                                                    {!! Form::text('bank_nominee_name',null,['class'=>'form-control','placeholder'=>'Nominee Name']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                {!! Form::label('bank_nominee_relation','Nominee Relation*',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6 form-group">
                                                                    {!! Form::text('bank_nominee_relation',null,['class'=>'form-control','placeholder'=>'Nominee relation']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                {!! Form::label('bank_nominee_dob','Nominee DOB*',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6 form-group">
                                                                    {!! Form::date('bank_nominee_dob',null,['class'=>'form-control','placeholder'=>'Select DOB']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                {!! Form::label('bank_name','Bank Name*',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6 form-group">
                                                                    {!! Form::text('bank_name',null,['class'=>'form-control','placeholder'=>'Enter bank name']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                {!! Form::label('account_number','Account Number*',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6 form-group">
                                                                    {!! Form::text('account_number',null,['class'=>'form-control','placeholder'=>'Enter account number']) !!}
                                                                    @error('account_number')
                                                                        <span class="help-block text-danger">
                                                                            {{ $message }}
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                {!! Form::label('ifsc_code','IFSC Code*',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6 form-group">
                                                                    {!! Form::text('ifsc_code',null,['class'=>'form-control','placeholder'=>'Enter ifsc code']) !!}
                                                                    @error('ifsc_code')
                                                                        <span class="help-block text-danger">
                                                                            {{ $message }}
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('bank_address','Address',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6">
                                                                    {!! Form::textarea('bank_address',null,['class'=>'form-control','placeholder'=>'Enter address','rows'=>4]) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('pan_number','Pan Number',['class'=>'col-md-4 col-form-label']) !!}
                                                                <div class="col-md-6">
                                                                    {!! Form::text('pan_number',null,['class'=>'form-control','placeholder'=>'Enter pan details']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Additional Information
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row form-group">
                                                                {!! Form::label('profile_image','Profile Image*',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::file('profile_image',['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('profile[father_name]','Father Name*',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9 form-group">
                                                                    {!! Form::text('father_name',null,['class'=>'form-control','placeholder'=>'Enter father name']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('mother_name','Mother Name:*',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9 form-group">
                                                                    {!! Form::text('mother_name',null,['class'=>'form-control','placeholder'=>'Enter mother name']) !!}
                                                                </div>
                                                            </div>

                                                            <div class="row form-group">
                                                                {!! Form::label('dob','Date of Birth:',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::date('dob',null,['class'=>'form-control','placeholder'=>'Select DOB']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('address','Address:',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::textarea('address',null,['class'=>'form-control','placeholder'=>'Enter address','rows'=>3]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">

                                                            <div class="row form-group">
                                                                {!! Form::label('country','Country:',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::text('country',null,['class'=>'form-control','placeholder'=>'Enter country']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('state','State:',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::text('state',null,['class'=>'form-control','placeholder'=>'Enter state']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('city','City:',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::text('city',null,['class'=>'form-control','placeholder'=>'Enter city']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('pin_code','Pincode:',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::text('pin_code',null,['class'=>'form-control','placeholder'=>'Enter pincode']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row form-group">
                                                                {!! Form::label('pan_card_number','Pan Card Number*',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::text('pan_card_number',null,['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('pan_card_image','Pan Card Image*',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::file('pan_card_image',['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row form-group">
                                                                {!! Form::label('nominee_name','Nominee Name*',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::text('nominee_name',null,['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                {!! Form::label('nominee_relation','Nominee Realtion*',['class'=>'col-md-3 col-form-label']) !!}
                                                                <div class="col-md-9">
                                                                    {!! Form::text('nominee_relation',null,['class'=>'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::submit('Save Profile',['class'=>'btn btn-primary']) !!}
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
