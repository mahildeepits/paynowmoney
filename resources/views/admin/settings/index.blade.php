@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Settings</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Settings</h4>
                                {!! Form::model($settings) !!}
                                    <div class="row">

                                        <div class="col-md-4">
                                            {!! Form::label('email','Email') !!}
                                            {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter email id']) !!}
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('mobile','Mobile') !!}
                                            {!! Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Enter mobile number']) !!}
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::label('whats_app_number','Whatsapp Mobile') !!}
                                            {!! Form::text('whats_app_number',null,['class'=>'form-control','placeholder'=>'Enter mobile number']) !!}
                                        </div>
                                        <div class="col-md-4 form-group mt-5">
                                            {!! Form::label('office_address','Office Address') !!}
                                            {!! Form::textarea('office_address',null,['class'=>'form-control','placeholder'=>'Enter address','rows'=>3]) !!}
                                        </div>
                                        <div class="col-md-12">
                                            {!! Form::submit('Save Settings',['class'=>'btn btn-primary']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                                <div class="divider"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('delete-records',$string) }}" onclick="return confirm('Are you sure to delete all the data? This will not able to undo again.')" class="btn btn-danger btn-lg">Delete All Data</a>
                                    </div>
                                </div>
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
