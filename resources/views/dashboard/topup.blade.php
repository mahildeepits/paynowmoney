@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Home</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Top-Up</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Please Pay Your Joining Amount</h3>
                        <p>Or</p>
                        <h4>Top-up your account</h4>
                        <a href="javascript:void(0)" class="btn btn-main topupNow">Top-up Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    @parent

@endsection
@section('scripts')
    @parent

@endsection
