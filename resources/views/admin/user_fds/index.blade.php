@extends('admin.layouts.admin')
@section('title','Admin Panel | User FD Requests')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">User FD Requests</h1>
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
                                    <th>Amount</th>
                                    <th>Maturity</th>
                                    <th>Payment Screenshot</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fds as $key => $fd)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $fd->user->name ?? 'N/A' }}</td>
                                        <td>{{ $fd->plan->name ?? 'N/A' }}</td>
                                        <td>
                                            Investment: ₹{{ number_format($fd->amount, 2) }}<br>
                                            Expected Return: ₹{{ number_format($fd->total_expected_return, 2) }}
                                        </td>
                                        <td>
                                            Duration: {{ $fd->duration_months }} Months<br>
                                            @if($fd->maturity_date)
                                                Maturity Date: {{ \Carbon\Carbon::parse($fd->maturity_date)->format('d M Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($fd->payment_screenshot)
                                                <a href="{{ asset($fd->payment_screenshot) }}" target="_blank">View Screenshot</a>
                                                <br>
                                                <small>Method: {{ $fd->payment_method }}<br>UTR: {{ $fd->transaction_id }}</small>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($fd->status == 'pending_approval')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($fd->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($fd->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                                <br><small>Remarks: {{ $fd->admin_remarks }}</small>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($fd->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($fd->status == 'pending_approval')
                                                <form action="{{ route('admin.user_fds.review', $fd->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Approve this FD?');">
                                                    @csrf
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="btn btn-success btn-sm mb-1">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.user_fds.review', $fd->id) }}" method="POST" style="display:inline;" onsubmit="let reason = prompt('Please enter remarks for rejection:'); if(reason !== null) { this.insertAdjacentHTML('beforeend', '<input type=\'hidden\' name=\'admin_remarks\' value=\'' + reason + '\'>'); return true; } return false;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-3">
                            {{ $fds->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
