@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Joining Kits</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route'=>'joining.kits','files'=>true]) !!}
                            <h5>Create Joining Kit</h5>
                            <div class="row mt-4">
                                <div class="col-md-3 @error('kit_name') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('kit_name','Kit Name') !!} <span class="text-danger">*</span>
                                        {!! Form::text('kit_name',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                        @error('kit_name')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 @error('kit_pv') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('kit_pv','Kit PV') !!} <span class="text-danger">*</span>
                                        {!! Form::number('kit_pv',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                        @error('kit_pv')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 @error('amount') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('amount','Amount ₹') !!} <span class="text-danger">*</span>
                                        {!! Form::number('amount',null,['class'=>'form-control','autocomplete'=>'off']) !!}
                                        @error('amount')
                                            <span class="help-block text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('direct_income','Direct Income ₹') !!}
                                        {!! Form::text('direct_income',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('bonus_amount','To Charity ₹') !!}
                                        {!! Form::text('bonus_amount',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('level2_5','To Sponsor ( Upto 6 levels ) ₹ ') !!}
                                        {!! Form::text('level2_5',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('upgrade_require_user_count','TopUp user count') !!}
                                        {!! Form::text('upgrade_require_user_count',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('autopool_id','Auto pool') !!}
                                        {!! Form::select('autopool_id',autopoolPluck() ?? [],null,['class'=>'form-control','placeholder' => 'Select An Autopool']) !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('level6_15','Level 6-15') !!}
                                        {!! Form::text('level6_15',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('level16_25','Level 16-25') !!}
                                        {!! Form::text('level16_25',null,['class'=>'form-control']) !!}
                                    </div>
                                </div> --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('kit_image','Kit Image') !!}
                                        {!! Form::file('kit_image',['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <div class="form-group pt-4 mt-2">
                                        <label class="toggle">
                                            <input type="hidden" name="is_red" value="0"/>
                                            <input class="toggle-checkbox" name="is_red" type="checkbox" value="1">
                                            <div class="toggle-switch"></div>
                                            <span class="toggle-label">Is Red?</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2 pt-1">
                                    {!! Form::submit('Save Kit',['class'=>'btn btn-primary mt-4']) !!}
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
                                            <th>Kit Name</th>
                                            <th>Kit PV</th>
                                            <th>Image</th>
                                            <th>Amount</th>
                                            <th>Direct Income</th>
                                            <th>Is Red</th>
                                            {{-- <th>Incomes</th> --}}
                                            <th width="100">Created At</th>
                                            <th width="100">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kits as $key => $kit)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $kit->kit_name }}</td>
                                                <td>{{ $kit->kit_pv }}</td>
                                                <td>
                                                    @if($kit->kit_image  == null)
                                                        <img src="{{ asset('images/no-image.jpg') }}" width="100" />
                                                    @else
                                                        <img src="{{ asset('kit_images/'.$kit->kit_image) }}" width="100" />
                                                    @endif
                                                </td>
                                                <td>₹{{ $kit->amount }}</td>
                                                <td>₹{{ $kit->direct_income }}</td>
                                                <td>{!! $kit->is_red ? '<span class="badge badge-danger">Yes</span>':'<span class="badge badge-light text-dark">No</span>' !!}</td>
                                                {{-- <td>
                                                    <ul>
                                                        <li>Direct Income: <b><i class="fas fa-rupee-sign" style="font-size: 10px;"></i> {{ $kit->direct_income }}</b></li>
                                                        <li>Bonus: <b><i class="fas fa-rupee-sign" style="font-size: 10px;"></i> {{ $kit->bonus_amount }}</b></li>
                                                        <li>Level 2-5: <b><i class="fas fa-rupee-sign" style="font-size: 10px;"></i> {{ $kit->level2_5 }}</b></li>
                                                        <li>Level 6-15: <b><i class="fas fa-rupee-sign" style="font-size: 10px;"></i> {{ $kit->level6_15 }}</b></li>
                                                        <li>Level 16-25: <b><i class="fas fa-rupee-sign" style="font-size: 10px;"></i> {{ $kit->level16_25 }}</b></li>
                                                    </ul>
                                                </td> --}}
                                                <td>{{ $kit->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('delete.joining-kit',$kit->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-xs">Delete</a>
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
        </div>
    </div><!-- Main Wrapper -->
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/treeview.js?ref='.rand(1111,9999)) }}" type="text/javascript"></script>
@endsection
