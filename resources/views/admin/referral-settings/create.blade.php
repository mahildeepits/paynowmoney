@extends('admin.layouts.admin')
@section('title','Create Referral Settings - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Create Referral Settings</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route'=>'admin.referral-settings.store']) !!}
                            <div class="row mt-2">
                                <div class="col-md-4 @error('type') has-error @enderror">
                                    <div class="form-group">
                                        {!! Form::label('type','Select Type') !!} <span class="text-danger">*</span>
                                        <select name="type" class="form-control" required>
                                            <option value="">Select Type</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <span class="help-block text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <h5>Levels & Percentages</h5>
                            <div id="dynamic-rows">
                                <div class="row level-row mt-3 align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            {!! Form::label('level[]','Level') !!} <span class="text-danger">*</span>
                                            {!! Form::number('level[]',null,['class'=>'form-control','required'=>'required','min'=>'1']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            {!! Form::label('percentage[]','Percentage (%)') !!} <span class="text-danger">*</span>
                                            {!! Form::number('percentage[]',null,['class'=>'form-control','required'=>'required','step'=>'0.01','min'=>'0']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end mt-4">
                                        <button type="button" class="btn btn-success btn-add-more">Add More</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    {!! Form::submit('Save Settings',['class'=>'btn btn-primary']) !!}
                                    <a href="{{ route('admin.referral-settings.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            // Add More Button Click
            $(document).on('click', '.btn-add-more', function() {
                var newRow = `
                    <div class="row level-row mt-3 align-items-center">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label>Level <span class="text-danger">*</span></label>
                                <input type="number" name="level[]" class="form-control" required min="1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label>Percentage (%) <span class="text-danger">*</span></label>
                                <input type="number" name="percentage[]" class="form-control" required step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end mt-4">
                            <button type="button" class="btn btn-danger btn-remove-row">Remove</button>
                        </div>
                    </div>
                `;
                $('#dynamic-rows').append(newRow);
            });

            // Remove Button Click
            $(document).on('click', '.btn-remove-row', function() {
                $(this).closest('.level-row').remove();
            });
        });
    </script>
@endsection
