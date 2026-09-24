@extends('admin.layouts.admin')

@section('content')
<div id="main-wrapper">
    <div class="content-header">
        <h1 class="page-title">Payment Methods</h1>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-bottom clearfix">
                <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary float-right">Add New</a>
                <h4 class="card-title">Payment Methods</h4>
            </div>
            <div class="card-body table-responsive">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($methods as $method)
                        <tr>
                            <td>{{ $method->id }}</td>
                            <td>{{ $method->type }}</td>
                            <td>{{ $method->details }}</td>
                            <td>{{ $method->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this payment method?')">Delete</button>
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
