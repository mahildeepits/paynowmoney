@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <style>
        .over-flow-scroll{
            overflow-x: scroll;
        }
    </style>
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">All Payouts</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
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
                            <label for="member_id">Member ID</label>
                            {!! Form::select('member_id',[],null,['class'=>'form-control filter select2-ajax','placeholder'=>'Enter Member id','id' => 'member_id']) !!}
                        </div>
                    </div>
                    @if ($type == 'income')
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Income Type</label>
                            @php
                                $incomeTypes = (new \App\Models\WalletTransaction)->getKeywordNames();
                                unset($incomeTypes['withdrawal']);
                                unset($incomeTypes['withdrawal_refund']);
                            @endphp
                            {!! Form::select('income_type', $incomeTypes, null, ['class' => 'form-control filter', 'placeholder' => 'All', 'id' => 'income_type']) !!}
                        </div>
                    </div>
                    @endif

                    @if ($type == 'withdrawal' || $type == null)
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Payment Status</label>
                            {!! Form::select('status',['paid' => 'Paid','not_paid' => 'Not paid'],null,['class' => 'form-control filter','placeholder' => 'All','id' => 'payment_status']) !!}
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-12 text-nowrap">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    {!! $dataTable->scripts() !!}
    <script>
        const alluserspayoutsDataTable = $('#alluserspayouts-table');
        $(document).ready(function(){
            alluserspayoutsDataTable.parent().addClass('over-flow-scroll');
        });
        alluserspayoutsDataTable.on('preXhr.dt',function(e, settings,data){
            data.from = $('#from_date').val();
            data.to = $('#to_date').val();
            data.type = $('#list_type').val();
            data.status = $('#payment_status').val();
            data.user_id = $('#member_id').val();
            data.income_type = $('#income_type').val();
        });
        $(function(){
            $('.filter').on('change',function(){
                alluserspayoutsDataTable.DataTable().ajax.reload();
            });
        });
    </script>
@endsection
