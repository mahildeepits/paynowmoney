@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">My Payouts</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Payouts</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mb-4 mx-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">From date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control filter" id="from_date">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">To date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control filter" id="to_date">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Income Type</label>
                            @php
                                $incomeTypes = (new \App\Models\WalletTransaction)->getKeywordNames();
                                unset($incomeTypes['withdrawal']);
                                unset($incomeTypes['withdrawal_refund']);
                                // Add autopool if needed, or keep it consistent with what's active in WalletTransaction
                            @endphp
                            {!! Form::select('income_type', $incomeTypes, null, ['class' => 'form-control filter', 'placeholder' => 'All', 'id' => 'income_type']) !!}
                        </div>
                    </div>
                    <!-- @if ($type == null)
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">List type</label>
                                {!! Form::select('status',['requested' => 'Requested','not_requested' => 'Not Requested'],null,['class' => 'form-control filter','placeholder' => 'All','id' => 'list_type']) !!}
                            </div>
                        </div>
                    @endif
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Payment Status</label>
                            {!! Form::select('status',['paid' => 'Paid','not_paid' => 'Not paid'],null,['class' => 'form-control filter','placeholder' => 'All','id' => 'payment_status']) !!}
                        </div>
                    </div> -->
                </div>
                {{-- <div class="row mb-2 mx-2">
                    <div class="col-md-12">
                        <button type="button" id="transfer-selected" class="btn btn-primary btn-sm">Transfer Selected to Wallet</button>
                        <button type="button" id="transfer-all" class="btn btn-success btn-sm">Transfer All Payouts to Wallet</button>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-12 text-nowrap">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    {!! $dataTable->scripts() !!}
    <script>
        const userpayoutsDataTable = $('#userpayouts-table');
        $(document).ready(function(){
            userpayoutsDataTable.parent().addClass('over-flow-scroll');

            // Select All logic
            $(document).on('change', '#select-all-payouts', function() {
                $('.payout-checkbox').prop('checked', this.checked);
            });

            $(document).on('change', '.payout-checkbox', function() {
                if ($('.payout-checkbox:checked').length == $('.payout-checkbox').length) {
                    $('#select-all-payouts').prop('checked', true);
                } else {
                    $('#select-all-payouts').prop('checked', false);
                }
            });

            // Transfer Selected logic
            $('#transfer-selected').click(function() {
                let selectedIds = $('.payout-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length === 0) {
                    alert('Please select at least one payout.');
                    return;
                }

                if (confirm('Are you sure you want to transfer selected payouts to wallet?')) {
                    bulkTransfer(selectedIds);
                }
            });

            // Transfer All logic
            $('#transfer-all').click(function() {
                if (confirm('Are you sure you want to transfer ALL pending payouts to wallet?')) {
                    bulkTransfer('all');
                }
            });

            function bulkTransfer(ids) {
                $.ajax({
                    url: "{{ route('member.payout.bulk-transfer') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: ids
                    },
                    success: function(res) {
                        if (res.status) {
                            alert(res.message);
                            userpayoutsDataTable.DataTable().ajax.reload();
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function(err) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });
        userpayoutsDataTable.on('preXhr.dt',function(e, settings,data){
            data.from = $('#from_date').val();
            data.to = $('#to_date').val();
            data.type = $('#list_type').val();
            data.status = $('#payment_status').val();
            data.income_type = $('#income_type').val();
        });
        $(function(){
            $('.filter').on('change',function(){
                userpayoutsDataTable.DataTable().ajax.reload();
            });
        });
    </script>
@endsection
