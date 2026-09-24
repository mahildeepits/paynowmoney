@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Withdrawal PIN</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Set/Change PIN</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-2">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4">Set/Change Withdrawal PIN</h5>
                <form action="{{ route('wallet.pin') }}" method="post" id="set-pin-form">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            <label class="form-label">Current Login Password <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" class="form-control" placeholder="Enter current login password" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 form-group">
                            <label class="form-label">New 4-Digit PIN <span class="text-danger">*</span></label>
                            <input type="hidden" name="wallet_pin" id="wallet_pin_val" value="" />
                            <div class="d-flex justify-content-between gap-2" id="pin-inputs">
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center pin-input-field" style="font-size: 24px;" required />
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center pin-input-field" style="font-size: 24px;" required />
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center pin-input-field" style="font-size: 24px;" required />
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center pin-input-field" style="font-size: 24px;" required />
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 form-group">
                            <label class="form-label">Confirm PIN <span class="text-danger">*</span></label>
                            <input type="hidden" name="confirm_pin" id="confirm_pin_val" value="" />
                            <div class="d-flex justify-content-between gap-2" id="cpin-inputs">
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center cpin-input-field" style="font-size: 24px;" required />
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center cpin-input-field" style="font-size: 24px;" required />
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center cpin-input-field" style="font-size: 24px;" required />
                                <input type="password" inputmode="numeric" maxlength="1" class="form-control text-center cpin-input-field" style="font-size: 24px;" required />
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-main">Save Withdrawal PIN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
<script>
$(document).ready(function(){
    $('.pin-input-field').on('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length === 1) {
            $(this).next('.pin-input-field').focus();
        }
    });
    $('.cpin-input-field').on('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length === 1) {
            $(this).next('.cpin-input-field').focus();
        }
    });
    $('.pin-input-field').on('keydown', function (e) {
        if (e.key === 'Backspace' && this.value.length === 0) {
            $(this).prev('.pin-input-field').focus();
        }
    });
    $('.cpin-input-field').on('keydown', function (e) {
        if (e.key === 'Backspace' && this.value.length === 0) {
            $(this).prev('.cpin-input-field').focus();
        }
    });

    $('#set-pin-form').on('submit', function(e) {
        e.preventDefault();
        let pin = '';
        let cpin = '';
        $('.pin-input-field').each(function() { pin += $(this).val(); });
        $('.cpin-input-field').each(function() { cpin += $(this).val(); });

        if(pin.length !== 4 || cpin.length !== 4) {
            alert('Please enter a 4-digit PIN.');
            return;
        }

        if(pin !== cpin) {
            alert('PIN and Confirm PIN do not match.');
            return;
        }

        $('#wallet_pin_val').val(pin);
        $('#confirm_pin_val').val(cpin);
        ajaxFormSubmit($(this));
    });
});
</script>
@endsection
