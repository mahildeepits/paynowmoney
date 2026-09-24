@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Admin Charges</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Charges</h4>
                                {!! Form::model($details) !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            {!! Form::label('tds_charges','TDS Charges') !!}
                                            {!! Form::number('tds_charges',null,['class'=>'form-control','placeholder'=>'Enter TDS charges']) !!}
                                            @error('tds_charges')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('admin_charges','Admin Charges') !!}
                                            {!! Form::number('admin_charges',null,['class'=>'form-control','placeholder'=>'Enter admin charges']) !!}
                                            @error('admin_charges')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('direct_amount','Direct Amount') !!}
                                            {!! Form::number('direct_amount',null,['class'=>'form-control','placeholder'=>'Enter direct amount']) !!}
                                            <small class="help-block">
                                                200 will be default if it s blank
                                            </small>
                                            @error('direct_amount')
                                                 <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('pair_amount','Pair Amount') !!}
                                            {!! Form::number('pair_amount',null,['class'=>'form-control','placeholder'=>'Enter admin charges']) !!}
                                            @error('pair_amount')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('capping_of_pair','Daily Pair Capping') !!}
                                            {!! Form::number('capping_of_pair',null,['class'=>'form-control','placeholder'=>'Enter admin charges']) !!}
                                            @error('capping_of_pair')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('id_prefix','ID Prefix') !!}
                                            {!! Form::text('id_prefix',null,['class'=>'form-control','placeholder'=>'Enter id prefix text']) !!}
                                            @error('id_prefix')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            {!! Form::label('activation_fee','Activation Fee') !!}
                                            {!! Form::number('activation_fee',null,['class'=>'form-control','placeholder'=>'Enter fixed activation fee']) !!}
                                            @error('activation_fee')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            {!! Form::submit('Save Charges',['class'=>'btn btn-primary']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
