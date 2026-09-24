@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">My Topup</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Self Upgrade</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <h6>Self Upgrade</h6>
                {!! Form::open(['method'=>'post','route'=>'member.self-upgrade']) !!}
                    <div class="row mb-3 mt-3">
                        {!! Form::label('joining_kit','Joining Kit*',['class'=>'col-md-2 col-form-label font-16']) !!}
                        <div class="col-md-6 form-group">
                            {!! Form::select('joining_kit',\App\Models\JoiningKit::where('is_red',0)->pluck('kit_name','id'),null,['class'=>'form-control','placeholder'=>'Select Kit']) !!}
                            @error('joining_kit')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Available Pins: <span class="text-danger avail-pins">0</span></h5>
                        </div>
                    </div>
                    {{-- <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Update User</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('userid','User id') !!}
                            {!! Form::text('userid',null,['class'=>'form-control','placeholder'=>'Enter user id']) !!}
                            @error('userid')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('username','Name') !!}
                            {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Enter user id','readonly']) !!}
                            @error('username')
                                <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::submit('Upgrade Package',['class'=>'btn btn-main mt-3']) !!}
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
            $('input[name=userid]').blur(function(){
                let userid = $(this).val();
                $.ajax({
                    url:"{{ route('sponsor.details') }}",
                    type: 'GET',
                    data: {
                        sponsor: userid
                    },
                    success: function (data) {
                        $('input[name=username]').val(data.sponsor);
                    }
                });
            });
        });
    </script>
@endsection
