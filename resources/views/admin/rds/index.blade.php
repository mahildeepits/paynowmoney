@extends('admin.layouts.admin')
@section('title', 'Manage RD Master')
@section('content')
<div id="main-wrapper">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Manage RD Master</h4>
                <a href="{{ route('admin.rds.create') }}" class="btn btn-primary">Add New RD</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>RD Name</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rds as $key => $rd)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $rd->name }}</td>
                                <td>
                                    @if($rd->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach($rd->details as $detail)
                                        <span class="badge bg-info mb-1">
                                            EMI: {{ $detail->emi_amount }}, Months: {{ $detail->months }}, Return: {{ $detail->return_percentage }}%
                                        </span><br>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.rds.edit', $rd->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.rds.destroy', $rd->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this RD Master?');">
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
</div>
@endsection
