@extends('admin.layouts.admin')
@section('title','Announcements')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Announcements</h1>
            <a href="javascript:void(0)" class="btn btn-primary float-end btn-sm" onclick="commanModel(`{{route('announcements.create')}}`,'Add Announcement')">Add</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent
    {{ $dataTable->scripts() }}
@endsection
