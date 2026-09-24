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
                        <li class="breadcrumb-item active" aria-current="page">Bank Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <h6>Edit Bank Details</h6>
                {!! Form::model($model,['method'=>'post','route'=>'account.save-bank-details']) !!}
                    <div class="row mb-3 mt-3">
                        {!! Form::label('ifsc_code','IFSC Code*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('ifsc_code',null,['class'=>'form-control','placeholder'=>'Enter ifsc code']) !!}
                            @error('ifsc_code')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('account_number','Account Number*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('account_number',null,['class'=>'form-control','placeholder'=>'Enter account number']) !!}
                            @error('account_number')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('account_holder_name','Account Holder Name*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('account_holder_name',null,['class'=>'form-control','placeholder'=>'Enter account holder name']) !!}
                            @error('account_holder_name')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('bank_name','Bank Name*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('bank_name',null,['class'=>'form-control','placeholder'=>'Enter bank name']) !!}
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('bank_branch','Bank Branch*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('bank_branch',null,['class'=>'form-control','placeholder'=>'Enter bank branch']) !!}
                            @error('bank_branch')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('bank_city','Bank City*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('bank_city',null,['class'=>'form-control','placeholder'=>'Enter bank city']) !!}
                            @error('bank_city')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('nominee_name','Nominee Name*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nominee_name',null,['class'=>'form-control','placeholder'=>'Nominee Name']) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('nominee_relation','Nominee Relation*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('nominee_relation',null,['class'=>'form-control','placeholder'=>'Nominee relation']) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('nominee_dob','Nominee DOB*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::date('nominee_dob',null,['class'=>'form-control','placeholder'=>'Select DOB']) !!}
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('google_pay','Google Pay*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('google_pay',null,['class'=>'form-control','placeholder'=>'Enter google pay']) !!}
                            @error('google_pay')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('bhim_pay','BHIM Pay*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('bhim_pay',null,['class'=>'form-control','placeholder'=>'Enter bhim pay']) !!}
                            @error('bhim_pay')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        {!! Form::label('paytm_no','Paytm No*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('paytm_no',null,['class'=>'form-control','placeholder'=>'Enter paytm no']) !!}
                            @error('paytm_no')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        {!! Form::label('phone_pay','Phone Pay*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::text('phone_pay',null,['class'=>'form-control','placeholder'=>'Enter phone pay']) !!}
                            @error('phone_pay')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        {!! Form::label('bank_address','Address',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-4">
                            {!! Form::textarea('bank_address',null,['class'=>'form-control','placeholder'=>'Enter address','rows'=>4]) !!}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            {!! Form::submit('Save Bank Details',['class'=>'btn btn-main']) !!}
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
            $('input, textarea').each(function(index){
                if($(this).val() !== '' && $(this).val() !== null){
                    $(this).prop('readonly',true);
                }
            })
        });
    </script>
@endsection
