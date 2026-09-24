@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Payout Details</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'get']) !!}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h4>Select Date to Show Details</h4>
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('from_date','From Date') !!}
                                    {!! Form::date('from_date',request()->from_date,['class'=>'form-control','placeholder'=>'Select From Date']) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('to_date','To Date') !!}
                                    {!! Form::date('to_date',request()->to_date,['class'=>'form-control','placeholder'=>'Select To Date']) !!}
                                </div>
                                <div class="col-md-4 ml-5">
                                    <div class="card colorfull-bg">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body text-left">
                                                    <h4 class=""> <span id="ctl00_ContentPlaceHolder1_inc_ctl00_lbl8" class="currency">
                                                        @if(isset($details) && !is_array($details))
                                                            {{ $details->getCollection()->groupBy('username')->count() }}
                                                        @else
                                                            0
                                                        @endif
                                                    </span>
                                                    </h4>
                                                    <span class=""><span id="ctl00_ContentPlaceHolder1_inc_ctl00_Label1">Total Payouts</span></span>
                                                </div>
                                                <div class="align-self-center w-circle-icon rounded-circle bg-contrast">
                                                    <i class="fas fa-globe  font-40"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::submit('Show Payout Details',['class'=>'btn btn-primary mt-0 btn-md']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Payout Details</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="printTable()">Print</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Member ID</th>
                                <th>Pair Amount</th>
                                <th>TDS</th>
                                <th>Admin Charges</th>
                                <th>Net Amount</th>
                                <th>Is Credited</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_array($details))
                                @foreach($details->getCollection()->groupBy('username') as $key => $singlePayout)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $singlePayout[0]->username }}</td>
                                        <td>{{ $singlePayout[0]->pair_amount }}</td>
                                        <td>{{ $singlePayout[0]->tds }}</td>
                                        <td>{{ $singlePayout[0]->admin_charges }}</td>
                                        <td>{{ $singlePayout->sum('net_amount') }}</td>
                                        <td>{!! ($singlePayout[0]->credit_or_cut == null)?"<i class='text-danger'>No Credited Yet</i>":"<span class='badge badge-success'>Credited</span>" !!}</td>
                                        <td>
                                            @if($singlePayout[0]->credit_or_cut == null)
                                                <a href="{{ route('admin.payout.setpaid',$singlePayout[0]->id) }}" onclick="return confirm('Are you sure to set as paid?')" class="btn btn-danger">Set As Paid</a>
                                            @else
                                                <span class="badge badge-danger">Payment Success</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
    <script>
        function printTable() {
            var table = document.getElementById("myTable");
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><head><title>Print Table</title></head><body>');
            newWin.document.write('<h2>Table Content</h2>');
            newWin.document.write(table.outerHTML);
            newWin.document.write('</body></html>');
            newWin.document.close();
            setTimeout(function(){newWin.print();}, 1000);
        }
    </script>
@endsection
