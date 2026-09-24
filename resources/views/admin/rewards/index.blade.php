@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Rewards</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route'=>'rewards.save','files'=>true]) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {!! Form::label('pairs','Pairs') !!}
                                            {!! Form::text('pairs',null,['class'=>'form-control']) !!}
                                            @error('pairs')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label('amount','Amount') !!}
                                            {!! Form::text('amount',null,['class'=>'form-control']) !!}
                                            @error('amount')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label('name','Name') !!}
                                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                                            @error('name')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label('rank','Rank') !!}
                                            {!! Form::text('rank',null,['class'=>'form-control']) !!}
                                            @error('rank')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::label('image','Image') !!}
                                            {!! Form::file('image',['class'=>'form-control']) !!}
                                            @error('image')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-4 pt-2">
                                            {!! Form::submit('Save Reward',['class'=>'btn btn-primary']) !!}
                                        </div>
                                    </div>
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
                    <div class="card-body">
                        <a href="javascript:void(0)" class="btn btn-primary" onclick='printDiv();'>Print Now</a>
                        <div id="print-div">
                            <table class="table table-bordered" id="rewards-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Pairs</th>
                                    <th>Amount</th>
                                    <th>Name</th>
                                    <th>Rank</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rewards as $k => $reward)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td><img alt="{{ $reward->name }}" src="{{ asset('rewards/'.$reward->image) }}" width="50" /> </td>
                                        <td>{{ $reward->pairs }}</td>
                                        <td>{{ $reward->amount }}</td>
                                        <td>{{ $reward->name }}</td>
                                        <td>{{ $reward->rank }}</td>
                                        <td>
                                            <a href="{{ route('rewards.delete',$reward->id) }}" onclick="return confirm('Are you sure to delete this reward?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script>
        // $(document).ready(function(){
        //     $('#rewards-table').DataTable();
        // });

        function printDiv()
        {

            var divToPrint=document.getElementById('print-div');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><link href="{{ asset('concept/theme/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);

        }
    </script>
@endsection
