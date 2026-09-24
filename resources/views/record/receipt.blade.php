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
                        <li class="breadcrumb-item active" aria-current="page">My Receipt</li>
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
                    <div class="col-md-12 receipt-border">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="https://tremendousgold.com/wp-content/uploads/2022/10/gold.....logo_.png" width="100" class="logo-image" />
                            </div>
                            <div class="col-md-8 receipt-header-bg text-right">
                                <h3 class="text-warning">RECEIPT</h3>
                                <h6>NO.MM{{ auth()->guard('member')->user()->member_id }}</h6>
                                <h6>Date: {{ \Carbon\Carbon::now()->format('d M Y') }}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 receipt-to">
                                <h6 class="text-danger bold">RECEIPT TO:</h6>
                                <h3>{{ auth()->guard('member')->user()->name }}</h3>
                                <h5><b>USER ID:</b> {{ auth()->guard('member')->user()->member_id }}</h5>
                                <h5><b>REFERENCE ID:</b> {{ auth()->guard('member')->user()->sponsor_id }}</h5>
                            </div>
                            <div class="col-md-4 receipt-amount">
                                <h6 class="text-danger bold">RECEIPT AMOUNT:</h6>
                                {{--<h3><b>Amount:</b> ₹{{ auth()->guard('member')->user()->used_pin_rel->joining_kit_rel->amount }}</h3> --}}
                                <h5><b>DATE OF JOINING:</b> {{ auth()->guard('member')->user()->created_at->format('d-M-Y') }}</h5>
                                <h5><b>REFERENCE NAME:</b> {{ auth()->guard('member')->user()->sponsor_id }}</h5>
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
