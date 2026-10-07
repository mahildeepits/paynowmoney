@extends('admin.layouts.admin')
@section('title','Admin Panel | Fixed Deposit Plans')
@section('content')
    <div id="main-wrapper">
        <div class="content-header d-flex justify-content-between align-items-center">
            <h1 class="page-title">Fixed Deposit Plans</h1>
            <a href="{{ route('admin.fds.create') }}" class="btn btn-primary">Add New Plan</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped static-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plan Name</th>
                                    <th>Options</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fds as $key => $fd)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $fd->name }}</td>
                                        <td>
                                            <ul>
                                            @foreach($fd->details as $detail)
                                                <li>Amount: ₹{{ $detail->amount }}, {{ $detail->months }} Months, {{ $detail->return_percentage }}%</li>
                                            @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @if($fd->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.fds.edit', $fd->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('admin.fds.destroy', $fd->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this plan?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
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
@endsection
