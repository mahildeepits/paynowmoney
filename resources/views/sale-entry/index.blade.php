@extends('layout.main')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Portal</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Sale Entry</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <h6>Sale Entry</h6>
                @php
                    $userDetails = auth()->guard('member')->user();
                @endphp
                {!! Form::open(['method'=>'post','route'=>'member.sale.entries']) !!}

                <div class="row mb-3">
                    {!! Form::label('memberID','Member ID*',['class'=>'col-md-2 col-form-label font-16']) !!}
                    <div class="col-md-6 form-group">
                        {!! Form::text('member_id',old('member_id'),['class'=>'form-control','placeholder'=>'Enter Member ID']) !!}
                        @error('member_id')
                        <span class="help-block text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    {!! Form::label('amount','Amount*',['class'=>'col-md-2 col-form-label font-16']) !!}
                    <div class="col-md-6 form-group">
                        {!! Form::number('amount',old('amount'),['class'=>'form-control','placeholder'=>'Enter amount']) !!}
                        @error('amount')
                            <span class="help-block text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    {!! Form::label('created_on','Date*',['class'=>'col-md-2 col-form-label font-16']) !!}
                    <div class="col-md-6 form-group">
                        {!! Form::date('created_on',old('created_on') ? old('created_on'): date('Y-m-d') ,['class'=>'form-control']) !!}
                        @error('created_on')
                        <span class="help-block text-danger">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        {!! Form::submit('Save',['class'=>'btn btn-main']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6>All Sale Entries</h6>

                <div class="row py-3">
                    <div class="col-md-12">
                        {!! Form::open(['method'=>'get']) !!}

                                @php
                                    $cls = 'align-items-end';
                                    $margincls = 'mt-2';
                                    if((request()->has('end_date') && request()->end_date == '') || (request()->has('date') && request()->date == '')) {
                                        $cls = 'align-self-center';
                                        $margincls = 'mt-4 pt-2';
                                    }
                                @endphp
                            <div class="row mb-3 {{$cls}}">

                                <div class="col-md-4 form-group">
                                    {!! Form::label('date','Start Date',['class'=>'col-form-label font-16']) !!}
                                    <span class="text-danger">*</span>

                                    {!! Form::date('date', request()->date,['class'=>'form-control', 'id' => 'start_date']) !!}
                                    @if(request()->has('date') && request()->date == '')
                                        <span class="text-danger">Please enter Start date</span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group">
                                    {!! Form::label('end_date','End Date',['class'=>' col-form-label font-16']) !!}
                                    <span class="text-danger">*</span>

                                    {!! Form::date('end_date', request()->end_date,['class'=>'form-control', !isset($_GET['date']) ? 'readonly' : '' , 'id' => 'end_date']) !!}

                                    @if(request()->has('end_date') && request()->end_date == '')
                                        <span class="text-danger">Please enter End date</span>
                                    @endif
                                </div>


                                <div class="col-md-2 {{$margincls}}">

                                    {!! Form::submit('Filter',['class'=>'btn btn-main']) !!}

                                    @if(request()->date || request()->end_date)
                                        <a href="{{route('member.sale.entries')}}" class="btn btn-danger">Reset</a>
                                    @else
                                        {!! Form::reset('Reset',['class'=>'btn btn-danger']) !!}
                                    @endif
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-striped" id="datatable-sale-entries">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($saleInfo as $key => $saleDetail)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$saleDetail->user->member_id}}</td>
                                    <td>{{ \Carbon\Carbon::parse($saleDetail->created_on)->format('d-M-Y') }}</td>
                                    <td> <i class="fadeIn animated bx bx-rupee"></i> {{$saleDetail->amount}}</td>
                                </tr>
                            @endforeach
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
<script>

    $(document).ready(function() {
        $('#datatable-sale-entries').DataTable({
            bSort: false,
        });

        // End date:- remove Readonly, set min date acc to start date
        function setEndDate() {
            let date = $('#start_date').val();

            let fullDate = date.split('-');

            let dt = parseInt(fullDate[2]) + 1;

            let minDate = `${fullDate[0]}-${fullDate[1]}-${dt}`;

            $('#end_date').removeAttr('readonly');
            $('#end_date').attr('min', minDate);
        }


        if($('#start_date').val()) {
            setEndDate();
            $('#end_date').removeAttr('readonly');
            $('#end_date').attr('min', minDate);

        }

        $('#start_date').on('change', function(){
            $('#end_date').val('');

            if($(this).val().length > 0) {
                setEndDate();
                $('#end_date').removeAttr('readonly');
                $('#end_date').attr('min', minDate);
            }else{
                $('#end_date').props('readonly', true);
                $('#end_date').removeAttr('min');
            }
        });

    });

</script>

@endsection
