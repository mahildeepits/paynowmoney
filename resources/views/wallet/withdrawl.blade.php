@extends('layout.main')
@section('content')
@php
$route = 'wallet.withdrawl';
$method = 'post';
$user = authUser('member');
$adminCharge = \App\Models\AdminCharge::first();
$transaction_fees_percentage = ($adminCharge->admin_charges ?? 5) / 100;
$walletBalance = authUser()->walletIncomesByKey();
@endphp

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">Wallet</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Withdrawal</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center mb-4">
                            <div><i class="bx bxs-wallet-alt me-1 font-22 "></i>
                            </div>
                            <h5 class="mb-0">Request Withdrawal</h5>
                        </div>
                        <hr>
                        
                        @if(!authUser()->wallet_pin)
                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                <div class="text-white">
                                    <i class='bx bx-error-circle'></i> <strong>Notice!</strong> Please <a href="{{ route('wallet.pin') }}" class="text-white text-decoration-underline">Set your Withdrawal PIN</a> first before making a withdrawal.
                                </div>
                            </div>
                        @endif

                        @if($user->is_paid == 0)
                            <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show">
                                <div class="text-dark">
                                    <i class='bx bx-error-circle'></i> <strong>ID Inactive!</strong> Your ID is currently inactive. Please pay your Installments/Topup to enable withdrawals.
                                </div>
                            </div>
                        @endif

                        @php
                            $rewardIncomeCredit = $user->reward_income_credit;
                            $daysSinceCreation = $user->created_at->diffInDays(now());
                        @endphp

                        @if($daysSinceCreation < 90 && $rewardIncomeCredit > 0)
                            <div class="alert alert-info border-0 bg-info alert-dismissible fade show">
                                <div class="text-white">
                                    <i class='bx bx-info-circle'></i> You can withdrawal you rewards Income After 90 days. 
                                    <strong>₹{{ $rewardIncomeCredit }}</strong>
                                </div>
                            </div>
                        @elseif($daysSinceCreation >= 90 && $rewardIncomeCredit > 0)
                            <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
                                <div class="text-white">
                                    <i class='bx bx-check-circle'></i> You can withrawal your reward income now onwards.
                                </div>
                            </div>
                        @endif

                        <div class="balance-card bg-light p-3 rounded mb-4 text-center border">
                            <h6 class="text-muted mb-1">Available Wallet Balance</h6>
                            <h2 class="mb-0 text-dark">₹{{ $walletBalance ?? '0' }}</h2>
                        </div>

                        <form action="{{ route($route) }}" id="withdrawal-form" method="post">
                            @csrf
                            <input type="hidden" name="transaction_fees_percentage" id="transaction_fees_percentage" value="{{ $transaction_fees_percentage }}" />
                            <input type="hidden" name="withdrawal_pin" id="withdrawal_pin" value="" />
                            
                            <fieldset @if(!authUser()->wallet_pin || $user->is_paid == 0) disabled @endif>
                                <div class="row g-3">
                                    <div class="col-12 form-group">
                                        <label for="amount" class="form-label font-weight-bold">Amount to Withdraw (₹)</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-transparent"><i class='bx bx-rupee' ></i></span>
                                            <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount" min="1000" step="1">
                                        </div>
                                        <div class="invalid-feedback"></div>
                                        <small class="text-muted mt-2 d-block">Min: ₹1000</small>
                                    </div>
                                    
                                    <div class="col-12 mt-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Service Charges ({{ $transaction_fees_percentage * 100 }}%)</span>
                                            <span class="fw-bold" id="transaction_fee_display">₹0</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="text-dark fw-bold">Net Payable Amount</span>
                                            <span class="fw-bold text-success font-20" id="total_amount_display">₹0</span>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="transaction_fees" value="" class="transaction_fee" />
                                    <input type="hidden" value="" name="total_amount" class="total_amount"/>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-main btn-lg w-100 shadow-sm" @if(!authUser()->wallet_pin || $user->is_paid == 0) disabled @endif>
                                            <i class='bx bx-check-circle me-1'></i> Confirm Withdrawal
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        <div class="mt-4 p-3 bg-light-warning rounded border border-warning border-dashed">
                            <h6 class="text-warning mb-2"><i class='bx bx-info-circle me-1'></i> Important Notes:</h6>
                            <ul class="mb-0 font-13 ps-3 text-dark">
                                <li class="mb-1">Minimum withdrawal amount is <b>₹1000</b>.</li>
                                <!-- <li class="mb-1">Maximum withdrawal amount per request is <b>₹1000</b>.</li> -->
                                <li class="mb-1">Standard service charges of <b>{{ $transaction_fees_percentage * 100 }}%</b> will apply.</li>
                                <li>Funds will be credited to your linked bank account within 24-48 hours.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PIN Overlay -->
<div id="pin-overlay" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="z-index: 9999; background: rgba(0,0,0,0.85); backdrop-filter: blur(5px);">
    <div class="card border-0 shadow-lg animated fadeInDown" style="max-width: 400px; width: 90%;">
        <div class="card-body p-4 text-center">
            <div class="mb-3">
                <i class='bx bxs-lock-alt font-50 text-primary'></i>
            </div>
            <h5 class="mb-1">Enter Security PIN</h5>
            <p class="text-muted small mb-4">Please enter your 4-digit withdrawal PIN to confirm.</p>
            
            <div class="d-flex justify-content-center gap-2 mb-4">
                <input type="password" maxlength="1" inputmode="numeric" class="form-control text-center pin-input shadow-sm" style="width: 50px; height: 50px; font-size: 24px; border-radius: 10px;" />
                <input type="password" maxlength="1" inputmode="numeric" class="form-control text-center pin-input shadow-sm" style="width: 50px; height: 50px; font-size: 24px; border-radius: 10px;" />
                <input type="password" maxlength="1" inputmode="numeric" class="form-control text-center pin-input shadow-sm" style="width: 50px; height: 50px; font-size: 24px; border-radius: 10px;" />
                <input type="password" maxlength="1" inputmode="numeric" class="form-control text-center pin-input shadow-sm" style="width: 50px; height: 50px; font-size: 24px; border-radius: 10px;" />
            </div>
            
            <div class="d-grid gap-2">
                <button class="btn btn-main btn-lg" id="confirm-pin">Verify & Submit</button>
                <button class="btn btn-link text-muted" onclick="$('#pin-overlay').addClass('d-none')">Cancel Request</button>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light-warning { background-color: #fff9e6; }
    .border-dashed { border-style: dashed !important; }
    .animated { animation-duration: 0.3s; }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translate3d(0, -20px, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }
    .fadeInDown { animation-name: fadeInDown; }
</style>
@endsection

@section('scripts')
    @parent
<script>
    $(document).on('keyup change','#amount',function(){
        let amount = parseInt($(this).val()) || 0;
        let percentage = parseFloat($('#transaction_fees_percentage').val()) || 0.05;
        let transaction_fee = Math.round(amount * percentage);
        let total_amount = Math.round(amount - transaction_fee);
        
        $('.transaction_fee').val(transaction_fee);
        $('#transaction_fee_display').text('₹' + transaction_fee);
        
        $('.total_amount').val(total_amount);
        $('#total_amount_display').text('₹' + total_amount);
    });

    $('#withdrawal-form').on('submit', function(e){
        e.preventDefault();
        
        let amount = parseInt($('#amount').val()) || 0;
        let balance = {{ $walletBalance ?? 0 }};
        
        
        if(amount > balance) {
            toasterMessanger.error('Error', 'Insufficient wallet balance.');
            return;
        }

        $('.pin-input').val('');
        $('#pin-overlay').removeClass('d-none');
        $('.pin-input').first().focus();
    });

    $('.pin-input').on('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length === 1) {
            $(this).next('.pin-input').focus();
        }
    });
    
    $('.pin-input').on('keydown', function (e) {
        if (e.key === 'Backspace' && this.value.length === 0) {
            $(this).prev('.pin-input').focus();
        }
        if (e.key === 'Enter') {
            $('#confirm-pin').click();
        }
    });

    $('#confirm-pin').on('click', async function() {
        let pin = '';
        $('.pin-input').each(function() {
            pin += $(this).val();
        });

        if (pin.length !== 4) {
            toasterMessanger.warning('Wait', 'Please enter your 4-digit PIN.');
            return;
        }

        $('#withdrawal_pin').val(pin);
        $('#pin-overlay').addClass('d-none');
        await ajaxFormSubmit($('#withdrawal-form'));
    });
</script>
@endsection
