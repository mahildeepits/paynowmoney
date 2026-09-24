@extends('admin.layouts.admin')

@section('content')
<div id="main-wrapper">
    <div class="content-header">
        <h1 class="page-title">Payment Requests</h1>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Payment Requests</h4>
            </div>
            <div class="card-body table-responsive">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID (Member)</th>
                            <th>Amount</th>
                            <th>Transaction ID</th>
                            <th>Receipt</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $req)
                        <tr>
                            <td>{{ $req->id }}</td>
                            <td>{{ $req->user->name ?? 'N/A' }} ({{ $req->user_id }})</td>
                            <td>{{ $req->amount }}</td>
                            <td>{{ $req->transaction_id }}</td>
                            <td>
                                @if($req->receipt_image)
                                    <a href="{{ asset('storage/payment_receipts/' . $req->receipt_image) }}" target="_blank">View Receipt</a>
                                @endif
                            </td>
                            <td>
                                @if($req->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($req->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($req->status == 'pending')
                                    <form action="{{ route('admin.payment-requests.status', $req->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this payment and activate user?')">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.payment-requests.status', $req->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this payment?')">Reject</button>
                                    </form>
                                @else
                                    {{ ucfirst($req->status) }}
                                @endif
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
