@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Pancard Reports</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open() !!}
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h4>Filter</h4>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('select_option','Select Option') !!}
                                    {!! Form::select('select_option',\App\Models\User::$panCardOption,request()->select_option,['class'=>'form-control','placeholder'=>'Select Option']) !!}
                                </div>
                                <div class="col-md-4 pt-2">
                                    {!! Form::submit('View Records',['class'=>'btn btn-primary mt-4']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-striped static-datatable static-datatable">
                                    <thead>
                                        <tr>
                                            <th>
                                                {!! Form::checkbox('select_all',null,null,['class'=>'select-all-checkbox']) !!}
                                            </th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Pan No.</th>
                                            <th>Mobile No.</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th>Pan Card Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($userModel as $key => $user)
                                            <tr>
                                                <td>
                                                    @if($user->profile_rel && $user->profile_rel->is_pancard_approve != 1)
                                                        {!! Form::checkbox('select_user[]',$user->id,null,['class'=>'user-select']) !!}
                                                    @endif
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->member_id }}</td>
                                                <td>{{ $user->father_name }}</td>
                                                <td>{{ $user->profile_rel ? $user->profile_rel->pan_card_number : '--' }}</td>
                                                <td>{{ $user->mobile }}</td>
                                                <td>{{ $user->profile_rel ? $user->profile_rel->city: '--' }}</td>
                                                <td>
                                                    {!! $user->profile_rel ? (($user->profile_rel->is_pancard_approve == 1) ? '<span class="badge badge-success">Approved</span>':'<span class="badge badge-danger">Not Approved</span>'):'--'   !!}
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    @if($user->profile_rel && $user->profile_rel->is_pancard_approve == 1)
                                                        --
                                                    @elseif($user->profile_rel && $user->profile_rel->pan_card_number != '')
                                                        <a href="javascript:void(0)" class="btn btn-success btn-sm approve_single_pancard" data-id="{{ $user->id  }}">Approve</a>
                                                    @else
                                                        <small class="text-info"><i>No Pancard avail</i></small>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="row approve_bulk" style="display: none">
                                <div class="col-md-5 pl-4">
                                    {!! Form::submit('Approve Selected',['class'=>'btn btn-success ml-3 approve_selected']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
@endsection
