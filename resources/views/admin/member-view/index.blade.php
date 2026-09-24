@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Member View</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! $dataTable->table() !!}
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
    {!! $dataTable->scripts() !!}
@endsection
