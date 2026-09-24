@if ($model->is_paid != null)
    <a href="javascript:void(0)" class="btn btn-success btn-sm">Paid</a>
@elseif ($model->is_requested != null)
    @if ($model->income_type == 'withdrawal')
        <a href="javascript:void(0)" onclick="commanModel(`{{route('admin.pay.view',encrypt($model->id))}}`,'Pay To User')" class="btn btn-warning btn-sm">Pay</a>
        <a href="{{route('admin.reject.payout',encrypt($model->id))}}" onclick="return confirm('Are you sure you want to reject this withdrawal request?')" class="btn btn-danger btn-sm">Reject</a>
    @else
        <span class="badge bg-primary">In Wallet</span>
    @endif
@else
    <span class="badge bg-secondary">No Action Pending</span>
@endif