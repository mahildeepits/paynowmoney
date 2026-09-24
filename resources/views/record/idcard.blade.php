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
                        <li class="breadcrumb-item active" aria-current="page">My ID Card</li>
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
                    <div class="col-md-6 offset-3 border border-5 bg-white">
                        <div class="row">
                            <div class="col-md-12 p-0 idcard-header pb-2 pt-2 text-center">
                                <img src="{{ asset('images/54.png') }}" width="100" />
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 text-center pt-3 pb-3">
                                        <img src="{{ authUser('member')->profile_image_url }}" width="80%" />
                                    </div>
                                    <div class="col-md-8 pl-5 pt-3 pb-3">
                                        <table class="id-card-table">
                                            <tr>
                                                <th width="120">Distributor Name</th>
                                                <td>:</td>
                                                <td>{{ auth()->guard('member')->user()->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Distributor ID</th>
                                                <td>:</td>
                                                <td>{{ auth()->guard('member')->user()->member_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile No</th>
                                                <td>:</td>
                                                <td>{{ auth()->guard('member')->user()->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <th valign="top">Address</th>
                                                <td valign="top">:</td>
                                                <td>{{ isset(auth()->guard('member')->user()->profile) ? auth()->guard('member')->user()->profile->address:'' }}</td>
                                            </tr>
                                            <tr>
                                                <th>City</th>
                                                <td>:</td>
                                                <td>{{ isset(auth()->guard('member')->user()->profile) ? auth()->guard('member')->user()->profile->city : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>State</th>
                                                <td>:</td>
                                                <td>{{ isset(auth()->guard('member')->user()->profile) ? auth()->guard('member')->user()->profile->state : '' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-0 pt-3 pb-3 idcard-footer text-center text-white">
                                {{ config('app.name')}}
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
