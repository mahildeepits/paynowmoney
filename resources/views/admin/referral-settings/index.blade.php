@extends('admin.layouts.admin')
@section('title','Referral Settings - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header d-flex justify-content-between align-items-center">
            <h1 class="page-title">Referral and Level Settings</h1>
            <a href="{{ route('admin.referral-settings.create') }}" class="btn btn-primary">Create / Add New</a>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered static-datatable">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Level</th>
                                            <th>Percentage (%)</th>
                                            <th width="100">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($settings as $setting)
                                            <tr>
                                                <td><span class="badge badge-info">{{ $setting->type }}</span></td>
                                                <td>{{ $setting->level }}</td>
                                                <td>{{ $setting->percentage }}%</td>
                                                <td>
                                                    {!! Form::open(['route' => ['admin.referral-settings.destroy', $setting->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this level?')">Delete</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
