@extends('layout.auth')
@section('content')
    <style>
        .add-member-form{
            width: 50%;
            margin: 0 auto;
        }
        .custom-input{
            height: 30px;
            font-size: 13px;
        }
        .btn-green{
            background-color: #0f761cc7;
            color: white;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="m-3">
                <h3>
                    Add member
                    <a href="{{ route('member.tree',1) }}" class="btn btn-green custom-input float-end">View Tree</a>
                </h2>

            </div>
            <div class="add-member-form main-row mt-5">
                <div class="form-body">
                    {!! Form::open(['route'=>'store.member','method' => 'post','class'=>'row g-3','id' => 'form']) !!}
                    <div class="col-sm-6">
                        {!! Form::label('sponsor','Sponsor*') !!}
                        {!! Form::text('sponsor',request()->sponsor,['class'=>'form-control','placeholder'=>'Sponsor/Referral Username']) !!}
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
                        <div class="form-group">
                            <label for="rale">Role <span class="text-danger">*</span></label>
                            {!! Form::select('role', getRolesToPluck() ?? [], null, ['class' => 'form-control  custom-input','id' => 'role','placeholder' => 'Select Role']) !!}
                            <div class="invalid-feedback d-block"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sponsor_id">Parent Role Users <span class="text-danger">*</span></label>
                            {!! Form::select('sponsor_id', [], null, ['class' => 'form-control  custom-input','id' => 'parent_users','placeholder' => 'Select Parent User']) !!}
                            <div class="invalid-feedback d-block"></div>
                        </div>
                    </div> --}}

                    {{-- @if(request()->has('no_pin') && request()->no_pin == "true")
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
                            {!! Form::label('position','Position*') !!}
                            {!! Form::select('position',['left'=>'Left','right'=>'Right'],request()->position,['class'=>'form-control','placeholder'=>'Select Position']) !!}
                            @error('position')
                                <span class="text-danger text-info">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div> --}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('full_name','Full Name*') !!}
                                {!! Form::text('name',null,['class'=>'form-control  custom-input','placeholder'=>'Enter Full Name']) !!}
                                <div class="invalid-feedback d-block"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('password','Password*') !!}
                                {!! Form::password('password',['class'=>'form-control  custom-input','placeholder'=>'Enter Password']) !!}
                                <div class="invalid-feedback d-block"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('email','Email*') !!}
                                {!! Form::text('email',null,['class'=>'form-control  custom-input','placeholder'=>'Enter Email']) !!}
                                <div class="invalid-feedback d-block"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('mobile','Mobile*') !!}
                                {!! Form::text('mobile',null,['class'=>'form-control  custom-input','placeholder'=>'Enter Mobile']) !!}
                                <div class="invalid-feedback d-block"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-green ">Add</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@parent
    <script src="{{ asset('js/register.js?ref='.rand(1111,9999)) }}"></script>
    <script>
        $(document).on('change','#role',function(){
            var roleId = $(this).val();
            $.ajax({
                url: `{{route('role.users')}}`,
                type: 'get',
                data:{
                    role_id : roleId,
                },
                success:function(res){
                    $('#parent_users').html(res);
                }
            })
        })
        function message(res){
            if(res.status){

                toasterMessage('success',res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }else{
                toasterMessage('danger',res.message);
            }
        }
        $(document).on('submit','#form',function(){
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            // console.log(formData.values());
            $(document).find('.invalid-feedback').html('');
            $.ajax({
                url: route,
                type: method,
                data: formData,
                processData:false,
                contentType:false,
                success:function(res){
                    message(res);
                },
                error:function(errors){
                    $.each(errors.responseJSON.errors, function(index, error) {
                        if($(document).find('[name='+index+']').length > 0){
                            $(document).find('[name='+index+']').parents('.form-group').find('.invalid-feedback').html('<span class="text-danger">'+error[0]+'</span>');
                        }else{
                            $(document).find('#'+index).parents('.form-group').find('.invalid-feedback').html('<span class="text-danger">'+error[0]+'</span>');
                        }
                    });
                }
            });
        });
    </script>
@endsection
