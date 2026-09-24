@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Change Passowrd</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        {!! Form::open() !!}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    {!! Form::label('new_password','New Password') !!}
                                    {!! Form::text('new_password',null,['class'=>'form-control','placeholder'=>'Enter new password']) !!}
                                    @error('new_password')
                                        <span class="text-info text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 pt-3">
                                    {!! Form::submit('Change Password',['class'=>'btn btn-primary mt-4']) !!}
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
    <script>
        $(document).ready(function(){
            @if(request()->q)
                setTimeout(function(){
                    $('input[type=search]').val('{{ request()->q }}').trigger('keyup');
                },500);
            @endif
            @if(request()->has('kyc_details'))
                $('#kyc-modal').modal('show');
            @endif
        });
    </script>
@endsection
