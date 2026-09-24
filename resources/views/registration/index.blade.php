@extends('layout.auth')

@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-1">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <h3>{{ config('app.name') }}</h3>
                            {{--                            <img src="{{ asset('images/54.png') }}" width="180" alt="" />--}}
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Registration</h3>
                                        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                                        </p>
                                    </div>
                                    {!! Form::open(['route' => 'register.student', 'method' => 'POST']) !!}
                                    <div class="form-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('pin_no', 'Pin no') !!}
                                                {!! Form::text('pin_no', null, ['class' => 'form-control', 'placeholder' => 'Pin no']) !!}
                                                @error('pin_no')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('sponsor_id', 'Service Consultacy ID') !!}
                                                {!! Form::text('sponsor_id', null, ['class' => 'form-control', 'placeholder' => 'Sponsor Id']) !!}
                                                @error('sponsor_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('name', 'Name') !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('email', 'Email') !!}
                                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                                @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('password', 'Password') !!}
                                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                                @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('class_type', 'Class Type') !!}
                                                {!! Form::select('class_type', (new \App\Models\StudentDetail())->getClassTypes(), null, ['class' => 'form-control', 'placeholder' => 'Select Class Type', 'id' => 'class_type']) !!}
                                                @error('class_type')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2" id="class_center_container" style="display: none;">
                                                {!! Form::label('class_center', 'Class Center') !!}
                                                {!! Form::select('class_center', (new \App\Models\StudentDetail())->getTempCenters(), null, ['class' => 'form-control', 'placeholder' => 'Select Class Center', 'id' => 'class_center']) !!}
                                                @error('class_center')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('course_id', 'Course') !!}
                                                {!! Form::select('course_id', \App\Models\Course::pluck('name', 'id'), null, ['class' => 'form-control', 'Placeholder' => 'Select Course']) !!}
                                                @error('course_id')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('father_name', 'Father Name') !!}
                                                {!! Form::text('father_name', null, ['class' => 'form-control', 'placeholder' => 'Enter father name']) !!}
                                                @error('father_name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('mother_name', 'Mother Name') !!}
                                                {!! Form::text('mother_name', null, ['class' => 'form-control', 'placeholder' => 'Enter mother name']) !!}
                                                @error('mother_name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('phone', 'Phone') !!}
                                                {!! Form::number('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter phone']) !!}
                                                @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('aadhaar_no', 'Aadhaar No') !!}
                                                {!! Form::number('aadhaar_no', null, ['class' => 'form-control', 'placeholder' => 'Enter aadhaar no']) !!}
                                                @error('aadhaar_no')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('language', 'Language') !!}
                                                {!! Form::select('language', ['hindi' => 'Hindi', 'english' => 'English'], null, ['class' => 'form-control', 'placeholder' => 'Select Language']) !!}
                                                @error('language')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('qualification', 'Qualification') !!}
                                                {!! Form::text('qualification', null, ['class' => 'form-control', 'placeholder' => 'Enter qualification']) !!}
                                                @error('qualification')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('country', 'Country') !!}
                                                {!! Form::select('country', ['1' => 'India'], null, ['class' => 'form-control', 'placeholder' => 'Enter country']) !!}
                                                @error('country')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('district', 'District') !!}
                                                {!! Form::text('district', null, ['class' => 'form-control', 'placeholder' => 'Enter district']) !!}
                                                @error('district')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                {!! Form::label('address', 'Address') !!}
                                                {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Enter address', 'rows' => 3]) !!}
                                                @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-main"><i class='bx bx-user'></i>Sign up</button>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('js/student-register.js?ref='.rand(1111,9999)) }}"></script>
@endsection
