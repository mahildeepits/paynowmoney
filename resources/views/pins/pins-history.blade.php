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
                        <li class="breadcrumb-item active" aria-current="page">Pin History</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-3">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="widgets-icons rounded-circle mx-auto bg-light-info text-info mb-3"><i class="fadeIn animated bx bx-paperclip"></i>
                            </div>
                            <h4 class="my-1">{{ $availablePins->count() }}</h4>
                            <p class="mb-0 text-secondary">Available Pins</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="widgets-icons rounded-circle mx-auto bg-light-warning text-warning mb-3"><i class="fadeIn animated bx bx-shuffle"></i>
                            </div>
                            <h4 class="my-1">{{ $transferredPin->count() }}</h4>
                            <p class="mb-0 text-secondary">Transferred Pins</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Epin Report</h4>
                {!! Form::open(['route' => 'member.pins.history', 'method' => 'GET']) !!}
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('from_date', 'From Date') !!}
                            {!! Form::date('from_date', request()->from_date, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('to_date', 'To Date') !!}
                            {!! Form::date('to_date', request()->to_date, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('joining_kit_id', 'Joining Kit') !!}
                            {!! Form::select('joining_kit_id',\App\Models\JoiningKit::pluck('kit_name','id'), request()->joining_kit_id, ['class' => 'form-control']) !!}
                        </div>
                        @if(auth()->guard('admin')->check())
                            <div class="col-md-3">
                                {!! Form::label('to_user_id', 'To User Id') !!}
                                {!! Form::text('to_user_id', null, ['class' => 'form-control']) !!}
                            </div>
                        @endif
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            {!! Form::submit('Search Records',['class'=>'btn btn-main']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                <div class="row">
                    <div class="col-md-12">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
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
    {!! $dataTable->scripts() !!}
    <script type="text/javascript">
    </script>
@endsection
