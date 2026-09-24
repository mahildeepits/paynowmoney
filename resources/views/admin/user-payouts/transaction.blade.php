@php
    $bank = $payout->user->bank_details;
@endphp
@if($bank)
    <div class="alert alert-info" style="color: #333; background-color: #d1ecf1; border-color: #bee5eb;">
        <strong>Bank Name:</strong> {{ $bank->bank_name }} <br>
        <strong>Account No:</strong> {{ $bank->account_number }} <br>
        <strong>IFSC Code:</strong> {{ $bank->ifsc_code }} <br>
        <strong>Holder Name:</strong> {{ $bank->account_holder }} <br>
        <strong>UPI ID:</strong> {{ $bank->upi_id }}
    </div>
@endif
{!! Form::open(['method' => 'post','route' => ['admin.pay.payouts',$id],'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="transaction_id">Transaction ID</label>
                <input type="text" name="transaction_id" class="form-control" value="" placeholder="Enter transaction ID here" >
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </div>
{!! Form::close() !!}