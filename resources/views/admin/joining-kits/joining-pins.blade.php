@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Joining Pins</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route'=>'generate.pins']) !!}
                            <h5>Create Joining Pins</h5>
                            <div class="row mt-4">
                                <div class="col-md-3 @error('joining_kit') has-error @enderror">
                                    {!! Form::label('joining_kit','Joining Kit') !!}
                                    {!! Form::select('joining_kit',\App\Models\JoiningKit::pluck('kit_name','id'),null,['class'=>'form-control','autocomplete'=>'off','placeholder'=>'Select Joining Kit']) !!}
                                    @error('joining_kit')
                                        <span class="help-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 @error('number_of_pins') has-error @enderror">
                                    {!! Form::label('number_of_pins','Number of pins') !!}
                                    {!! Form::number('number_of_pins',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                    @error('number_of_pins')
                                        <span class="help-block text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 pt-1">
                                    {!! Form::submit('Generate Pins',['class'=>'btn btn-primary btn-lg mt-4']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered static-datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Joining Kit</th>
                                            <th>Pin No</th>
                                            <th>Transferred To</th>
                                            <th>Used By</th>
                                            <th width="160">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pins as $key => $pin)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $pin->joining_kit_rel->kit_name }}</td>
                                                <td>
                                                    @if($pin->used_by != null)
                                                        {{ $pin->pin_no }}
                                                    @else
                                                        <a href="{{ route('register') }}?pin={{ $pin->pin_no }}" target="_blank">{{ $pin->pin_no }}</a>
                                                    @endif
                                                </td>
                                                <td>{{ ($pin->transfer_rel != null)?$pin->transfer_rel->name:'-' }}</td>
                                                <td>{{ ($pin->used_by_rel != null)?$pin->used_by_rel->name:'-' }}</td>
                                                <td>{{ $pin->created_at->format('d-m-Y h:i A') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
