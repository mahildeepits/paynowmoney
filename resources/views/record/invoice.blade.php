@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Record</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Invoice</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="javascript:void(0)" class="btn btn-main" onclick="printDiv('printArea')">Print Now</a>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="row" id="printArea">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="invoice-header">
                                            <img src="{{ asset('images/54.png') }}" width="100" />
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="invoice-header">
                                            <h2 class="float-right">Invoice</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg m-b-md">
                                                <p class="bold">Billed From:</p>
                                                <span>Stacks</span><br>
                                                <span>5025 Collwood Blvd, apt. 2314</span><br>
                                                <span>San Diego, CA 92115</span><br>
                                                <span>P: (619) 511-2333</span>
                                            </div>
                                            <div class="col-lg m-b-md">
                                                <p class="bold">Billed To:</p>
                                                <span>{{ auth()->guard('member')->user()->name }}</span><br>
                                                <span>{{ isset(auth()->guard('member')->user()->profile) ? auth()->guard('member')->user()->profile->address : '' }}</span><br>
                                                <span>P: {{ auth()->guard('member')->user()->mobile }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="invoice-info m-b-md">
                                            <p>Invoice Number: <span>20191008-5689-87</span></p>
                                            <p>Issue Date: <span>{{ auth()->guard('member')->user()->created_at->format('F d, Y') }}</span></p>
                                            <p>Due Date: <span>{{ auth()->guard('member')->user()->created_at->format('F d, Y') }}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table m-t-xxl">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Particulars</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col" class="text-right">Price</th>
                                                <th scope="col" class="text-right">Total Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>{{ auth()->guard('member')->user()->used_pin_rel->joining_kit_rel->amount }}</td>
                                                <td>1</td>
                                                <td class="text-right">₹{{ auth()->guard('member')->user()->used_pin_rel->joining_kit_rel->amount }}</td>
                                                <td class="text-right">₹{{ auth()->guard('member')->user()->used_pin_rel->joining_kit_rel->amount }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 m-t-xxl">
                                        <div class="invoice-info">
                                            <span class="bold m-b-md d-block">Info:</span>
                                            <p>All disputes arising under this bill shall be settled in Amritsar (Karnataka) Courts only.
                                                Goods/Service once sold will not be taken back
                                                This Is Electronic Generated Slip . No Stamp Or Signature Is Required</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 m-t-xxl">
                                        <div class="invoice-info">
                                            <p>Sub-Total <span>₹{{ auth()->guard('member')->user()->used_pin_rel->joining_kit_rel->amount }}</span></p>
                                            <p>Tax <span>0</span></p>
                                            <p>Discount <span>0</span></p>
                                            <p class="bold">Total <span>₹{{ auth()->guard('member')->user()->used_pin_rel->joining_kit_rel->amount }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    @parent
    <style type="text/css">
        @media print {
            #printArea{
                height: 500px;
            }
        }
    </style>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
