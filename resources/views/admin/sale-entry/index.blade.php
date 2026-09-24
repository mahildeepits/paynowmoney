@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Sale Entry Details</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'get']) !!}
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h4>Enter details to View Data</h4>
                            </div>

                            <div class="col-md-3 form-group">
                                {!! Form::label('member','Member ID') !!}
                                <span class="text-danger">*</span>
                                {!! Form::text('member', request()->member, ['class'=>'form-control','placeholder'=>'Enter Member ID', 'id' => 'member']) !!}
                                @if(request()->has('member') && request()->member == '')
                                    <span class="text-danger">Please enter member id</span>
                                @endif

                            </div>
                            <div class="col-md-3 form-group">
                                {!! Form::label('from_date','From Date') !!}
                                <span class="text-danger">*</span>
                                {!! Form::date('from_date', request()->from_date,['class'=>'form-control','placeholder'=>'Select From Date', 'id' => 'from_date']) !!}
                                @if(request()->has('from_date') && request()->from_date == '')
                                    <span class="text-danger">Please enter from date</span>
                                @endif

                            </div>
                            <div class="col-md-3 form-group">
                                {!! Form::label('to_date','To Date') !!}
                                <span class="text-danger">*</span>
                                {!! Form::date('to_date',isset($_GET['to_date']) ? $_GET['to_date'] : '',['class'=>'form-control','placeholder'=>'Select To Date', 'id' => 'to_date']) !!}
                                @if(request()->has('to_date') && request()->to_date == '')
                                    <span class="text-danger">Please enter to date</span>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::submit('Show Sale Details',['class'=>'btn btn-primary mt-0 btn-md']) !!}

                                @if(isset($_GET['member']) ||  isset($_GET['from_date']) || isset($_GET['to_date']))
                                    <a href="{{route('admin.sale.entries')}}" class="btn btn-danger">Reset</a>
                                @else
                                    {!! Form::reset('Reset',['class'=>'btn btn-danger']) !!}
                                @endif
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        @if(isset($saleInfo))

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Payout Details</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @if(count($saleInfo) > 0)

                                        @foreach($saleInfo as $key => $saleDetail)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{  \Carbon\Carbon::parse($saleDetail->created_on)->format('d-M-Y')  }}</td>
                                                <td><i class="fa fa-inr" aria-hidden="true"></i> {{$saleDetail->amount}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">No data found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {!! $saleInfo->links('vendor.pagination.simple-bootstrap-4') !!}
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
    <script>
        $(document).ready(function() {
            // End date:- remove Readonly, set min date acc to start date
            function setEndDate() {
                let date = $('#from_date').val();

                let fullDate = date.split('-');

                let dt = parseInt(fullDate[2]) + 1;

                let minDate = `${fullDate[0]}-${fullDate[1]}-${dt}`;

                $('#to_date').removeAttr('readonly');
                $('#to_date').attr('min', minDate);
            }

            if ($('#from_date').val()) {
                setEndDate();
            }

            $('#from_date').on('change', function () {
                if ($(this).val().length > 0) {
                    setEndDate();
                    $('#to_date').val('');
                } else {
                    $('#to_date').attr('readonly', true);
                    $('#to_date').removeAttr('min');
                    $('#to_date').val('');
                }
            });

        });

    </script>
@endsection
