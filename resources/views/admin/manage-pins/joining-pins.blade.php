@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Joining Pins</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route'=>'admin.transfer.pins']) !!}
                            <h5>Transfer Pins</h5>
                            <div class="row mt-4">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-3 @error('joining_kit') has-error @enderror">
                                            {!! Form::label('joinig_kit','Joining Kit') !!}
                                            {!! Form::select('joining_kit', getJoiningKits() ?? [], null, ['class'=>'form-control','autocomplete'=>'off','placeholder' => 'Select kit']) !!}
                                            @error('joining_kit')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 @error('number_of_pins') has-error @enderror">
                                            {!! Form::label('number_of_pins','Number of pins') !!}
                                            {!! Form::number('number_of_pins',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                            @error('number_of_pins')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 @error('to_user') has-error @enderror">
                                            {!! Form::label('to_user','To User') !!}
                                            {!! Form::text('to_user',null,['class'=>'form-control','autocomplete'=>'new-password']) !!}
                                            @error('to_user')
                                                <span class="help-block text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3 @error('user_name') has-error @enderror">
                                            {!! Form::label('user_name','User Name*') !!}
                                            {!! Form::text('user_name',null,['class'=>'form-control','placeholder'=>'User Name','readonly']) !!}
                                            <span class="ajax-error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 pt-1">
                                    {!! Form::submit('Transfer Pins',['class'=>'btn btn-primary btn-lg mt-4','name'=>'transfer_pins']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="divider"></div>
                        @if(!$epinsList->isEmpty())
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-striped table-bordered static-datatable">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Pin No</th>
                                                <th>Transferred To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($epinsList as $key => $singleEpin)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $singleEpin->pin_no }}</td>
                                                    <td>{{ request()->to_user }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
    <script>
         $('input[name=to_user]').blur(function(){
            if($(this).val().trim() != ''){
                $.ajax({
                    type: 'GET',
                    url: route()+'/member/sponsor/validate',
                    data: {
                        sponsor: $(this).val(),
                    },
                    success: function(result){
                        if(result.error_code == 0){
                            $('input[name=user_name]').val(result.sponsor);
                            $('.ajax-error').html('').removeClass('text-danger');
                        }else{
                            $('.ajax-error').html(result.error).addClass('text-danger');
                            $('input[name=user_name]').val('');
                        }
                    }
                });
            }
        });
        setTimeout(()=>{
            $('input[name=to_user]').trigger('blur');
        },1000);
    </script>
@endsection
