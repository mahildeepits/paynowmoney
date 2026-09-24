@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Payout Report</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'get']) !!}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h3>Members Payout Report</h3>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::select('member_id',[],request()->member_id,['class'=>'form-control select2-ajax','placeholder'=>'Enter user id']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::submit('Show Payout Report',['class'=>'btn btn-primary mt-0 btn-lg']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @if($userDetails != null)
            <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Payout</h5>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td colspan="3">
                                                    <b>{{ $userDetails->name }}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="150">
                                                    <small>Joining Date</small>
                                                </td>
                                                <td width="10">:</td>
                                                <td>{{ $userDetails->created_at->diffForHumans() }} ({{ $userDetails->created_at->format('d-M-Y') }})</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <small>Joining Amount</small>
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    {{ $userDetails->used_pin_rel->joining_kit_rel->amount }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <small>Address</small>
                                                </td>
                                                <td>:</td>
                                                @php
                                                    $userAddress = $userDetails->user_address?->first();
                                                @endphp
                                                <td>{{ ($userAddress !== null)?$userAddress->address:'-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4 offset-4">
                                        <table>
                                            <tr>
                                                <td>
                                                    <b>{{ $userDetails->name }}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <small>YOUR INCOME FOR THE PAYOUT FROM DAILY JOINING</small>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5>Payout Incentive</h5>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Matching Income</th>
                                        <th>Direct Income</th>
                                        <th>Level Income</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $totalAmount = 0;
                                        $totalTds = 0;
                                        $totalAdminCharges = 0;
                                    @endphp
                                    @foreach($payoutDetails as $key => $singleRecord)
                                        <tr>
                                            <td class="text-center">&#8377;{{ $singleRecord->pair_amount }}</td>
                                            <td class="text-center">&#8377;0</td>
                                            <td class="text-center">&#8377;0</td>
                                            <td class="text-center">{{ $singleRecord->created_at->format('d-M-Y') }}</td>
                                        </tr>
                                        @php
                                            $totalAmount += $singleRecord->pair_amount;
                                            $totalTds += $singleRecord->tds;
                                            $totalAdminCharges += $singleRecord->admin_charge;
                                        @endphp
                                    @endforeach
                                    @if($payoutDetails->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center"><i>No Payout Yet</i></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 text-left">
                                <h6><b>Total Payout: </b> &#8377;{{ $totalAmount }}</h6>
                            </div>
                            <div class="col-md-12 mt-3">
                                <h5>Payout Details</h5>
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th width="300">TDS DEDUCTED (5%)</th>
                                        <td width="20">:</td>
                                        <td>&#8377;{{ $totalTds }}</td>
                                    </tr>
                                    <tr>
                                        <th>TDS 5 % WITHOUT PAN CARD</th>
                                        <td>:</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>ADMINISTRATIVE CHARGES (5%)</th>
                                        <td>:</td>
                                        <td>&#8377;{{ $totalAdminCharges }}</td>
                                    </tr>
                                    <tr>
                                        <th>OTHER DEDUCTIONS ( 0% )</th>
                                        <td>:</td>
                                        <td>&#8377;0</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>:</td>
                                        <td>
                                            <b>&#8377;{{ $totalAmount - $totalTds - $totalAdminCharges }}</b>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
