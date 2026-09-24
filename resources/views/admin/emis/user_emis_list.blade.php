<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Month</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Paid At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $can_approve = true; @endphp
            @forelse($emis as $index => $emi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $emi->month }}</td>
                <td>{{ number_format($emi->amount, 0) }}</td>
                <td>
                    @if($emi->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($emi->status == 'submitted')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($emi->status == 'rejected' || $emi->status == 'Rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @else
                        <span class="badge badge-secondary">Unpaid</span>
                    @endif
                </td>
                <td>{{ $emi->paid_at ? \Carbon\Carbon::parse($emi->paid_at)->format('d M Y') : '-' }}</td>
                <td>
                    @if($emi->status == 'submitted')
                        <button class="btn btn-success btn-sm modal-verify-btn" data-id="{{ $emi->id }}" {{ !$can_approve ? 'disabled' : '' }}>Verify</button>
                        <button class="btn btn-danger btn-sm modal-reject-btn" data-id="{{ $emi->id }}" {{ !$can_approve ? 'disabled' : '' }}>Reject</button>
                        @php $can_approve = false; @endphp
                    @elseif($emi->status == 'approved')
                        <span class="text-success"><i class="fa fa-check-circle"></i> Done</span>
                    @else
                        @php $can_approve = false; @endphp
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No Records Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
