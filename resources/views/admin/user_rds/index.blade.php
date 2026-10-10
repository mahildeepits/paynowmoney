@extends('admin.layouts.admin')
@section('title','Admin Panel | User RD Requests')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">User RD Requests</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">All Requests</h4>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success m-3">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger m-3">{{ session('error') }}</div>
                    @endif
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped static-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Plan</th>
                                    <th>Monthly Deposit</th>
                                    <th>Duration</th>
                                    <th>Total Expected Return</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rds as $key => $rd)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $rd->user->name ?? 'N/A' }}</td>
                                        <td>{{ $rd->plan->name ?? 'N/A' }}</td>
                                        <td>₹{{ number_format($rd->monthly_deposit, 2) }}</td>
                                        <td>{{ $rd->duration_months }} Months</td>
                                        <td>₹{{ number_format($rd->total_expected_return, 2) }}</td>
                                        <td>
                                            @if($rd->status == 'pending_approval')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($rd->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($rd->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                                <br><small>Remarks: {{ $rd->admin_remarks }}</small>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($rd->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($rd->status == 'pending_approval')
                                                <form action="{{ route('admin.user_rds.review', $rd->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Approve this RD?');">
                                                    @csrf
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="btn btn-success btn-sm mb-1">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.user_rds.review', $rd->id) }}" method="POST" style="display:inline;" onsubmit="let reason = prompt('Please enter remarks for rejection:'); if(reason !== null) { this.insertAdjacentHTML('beforeend', '<input type=\'hidden\' name=\'admin_remarks\' value=\'' + reason + '\'>'); return true; } return false;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1">Reject</button>
                                                </form>
                                            @elseif($rd->status == 'active')
                                                <a href="{{ route('admin.user_rds.emis', $rd->id) }}" class="btn btn-info btn-sm">View EMIs</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-3">
                            {{ $rds->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
