@extends('admin.layouts.admin')
@section('title','Admin Panel | RD EMIs')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">RD EMIs for User: {{ $rd->user->name ?? 'N/A' }}</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">All EMIs - RD Plan: {{ $rd->plan->name ?? 'N/A' }}</h4>
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
                                    <th>Installment</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Payment Date</th>
                                    <th>Payment Screenshot</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emis as $emi)
                                    <tr>
                                        <td>{{ $emi->installment_number }}</td>
                                        <td>₹{{ number_format($emi->amount, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($emi->due_date)->format('d M Y') }}</td>
                                        <td>{{ $emi->payment_date ? \Carbon\Carbon::parse($emi->payment_date)->format('d M Y') : 'N/A' }}</td>
                                        <td>
                                            @if($emi->payment_screenshot)
                                                <a href="{{ asset($emi->payment_screenshot) }}" target="_blank">View Screenshot</a>
                                                <br>
                                                <small>Method: {{ $emi->payment_method }}<br>UTR: {{ $emi->transaction_id }}</small>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($emi->status == 'pending')
                                                <span class="badge badge-secondary">Pending</span>
                                            @elseif($emi->status == 'pending_approval')
                                                <span class="badge badge-warning">Pending Approval</span>
                                            @elseif($emi->status == 'paid')
                                                <span class="badge badge-success">Paid</span>
                                            @elseif($emi->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($emi->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($emi->status == 'pending_approval')
                                                <form action="{{ route('admin.user_rds.emi.verify', $emi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Verify this EMI payment?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm mb-1">Verify</button>
                                                </form>
                                                <form action="{{ route('admin.user_rds.emi.reject', $emi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Reject this EMI payment?');">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
