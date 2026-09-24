@if($model->is_paid != null)
    <span class="badge bg-success">Paid</span>
@elseif($model->income_type == 'withdrawal')
    <span class="badge bg-warning text-dark">Withdrawal Pending</span>
@else
    <span class="badge bg-primary">In Wallet</span>
@endif