@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Fund Management</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Payout Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
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
                                            <b>{{ auth()->guard('member')->user()->name }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="150">
                                            <small>Joining Date</small>
                                        </td>
                                        <td width="10">:</td>
                                        <td>{{ auth()->guard('member')->user()->created_at->diffForHumans() }} ({{ auth()->guard('member')->user()->created_at->format('d-M-Y') }})</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <small>Joining Amount</small>
                                        </td>
                                        <td>:</td>
                                        <td>
                                            {{ auth()->guard('member')->user()->used_pin_rel->joining_kit_rel->amount }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <small>Address</small>
                                        </td>
                                        <td>:</td>
                                        @php
                                            $userAddress = auth()->guard('member')->user()->user_address?->first();
                                        @endphp
                                        <td>{{ ($userAddress !== null)?$userAddress->address:'-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 offset-4">
                                <table>
                                    <tr>
                                        <td>
                                            <b>{{ auth()->guard('member')->user()->name }}</b>
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
                                        <td class="text-center">&#8377;{{ $singleRecord->created_at->format('d-M-Y') }}</td>
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
                        @php
                            $adminCharges = \App\Models\AdminCharge::first();
                        @endphp
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="300">TDS DEDUCTED ({{ $adminCharges->tds_charges }}%)</th>
                                    <td width="20">:</td>
                                    <td>&#8377;{{ $totalTds }}</td>
                                </tr>
                                <tr>
                                    <th>TDS 5 % WITHOUT PAN CARD</th>
                                    <td>:</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>ADMINISTRATIVE CHARGES ({{ $adminCharges->admin_charges }}%)</th>
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
@endsection
@section('css')
    @parent
    <style type="text/css">

    </style>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">

    </script>
@endsection
