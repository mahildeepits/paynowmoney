@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Network</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Replace Tree</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <h4>Replace Tree</h4>
                {!! Form::open(['route' => 'member.tree.replace','method' => 'post']) !!}
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-label">Parent User ID</label>
                            {!! Form::text('parent_id', null, ['class' => 'form-control']) !!}
                            @error('parent_id')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-label">User Tree For Replace</label>
                            {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
                            @error('user_id')
                                <span class="help-block text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group  mt-4 pt-1">
                            <input type="submit" value="Submit" class="btn btn-main">
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

@endsection
