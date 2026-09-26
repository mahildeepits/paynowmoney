@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel | User Loan Requests')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">User Loan Requests</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">All Requests</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped static-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Loan Type</th>
                                    <th>Loan Amount</th>
                                    <th>Status</th>
                                    <th>Requested At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userLoans as $key => $loan)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $loan->user->name ?? 'N/A' }} ({{ $loan->user->member_id ?? '' }})</td>
                                        <td>{{ $loan->loanType->name ?? 'N/A' }}</td>
                                        <td>₹{{ number_format($loan->loanType->loan_amount ?? 0, 2) }}</td>
                                        <td>
                                            @if($loan->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($loan->status == 'active' || $loan->status == 'approved')
                                                <span class="badge badge-success">Approved / Active</span>
                                            @elseif($loan->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                                @if($loan->rejection_reason)
                                                    <br><small class="text-danger">Reason: {{ $loan->rejection_reason }}</small>
                                                @endif
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($loan->status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $loan->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            @if($loan->status == 'pending')
                                                <form action="{{ route('admin.user_loans.approve', $loan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to approve this loan? EMIs will be generated automatically.');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.user_loans.reject', $loan->id) }}" method="POST" style="display:inline;" onsubmit="let reason = prompt('Please enter the reason for rejection:'); if(reason !== null) { this.insertAdjacentHTML('beforeend', '<input type=\'hidden\' name=\'rejection_reason\' value=\'' + reason + '\'>'); return true; } return false;">
                                                    @csrf
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
                            {{ $userLoans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
