@extends('layout.main')
@section('content')
@php
    $authMember = auth('member')->user();
@endphp
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Portal</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5>View Profile</h5>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $authMember->name }}</td>
                                </tr>
                                <tr>
                                    <th>E-Mail</th>
                                    <td>{{ $authMember->email }}</td>
                                </tr>
                                <tr>
                                    <th>Member ID</th>
                                    <td>{{ $authMember->member_id }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{ $authMember->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $authMember->created_at->toDayDateTimeString() }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <a href="{{ route('account.profile-edit') }}" class="btn btn-main btn-sm">Edit Profile</a>
                        </div>
                    </div>
                    <div class="col-md-4 offset-1">
                        <h6 class="text-center">Profile Photo</h6>
                        <form method="post" id="profile_image_form">
                            <div class="row">
                                @csrf
                                {!! Form::hidden('user_id', $authMember->id, ['id'=>'user_id']) !!}
                                <div class="col-md-12 text-center">
                                    <img src="{{ $authMember->profile_image_url }}" 
                                        title="Click to change"
                                        style="width:100px;height:100px;border-radius:50%;cursor:pointer;"
                                        class="profile-image-det" onclick="document.getElementById('profile_image').click();" />
                                    <input type="file" name="profile_image" id="profile_image" class="form-control ml-5 pl-5" style="display:none;" />
                                    <br>
                                    {!! Form::submit('Update Profile Photo',['class'=>'btn btn-main btn-sm mt-3']) !!}
                                </div>
                            </div>
                        </form>
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
    // Handle file input change for preview
    $('#profile_image').on('change', function() {
        var file_data = $(this).prop('files')[0];
        if (file_data) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.profile-image-det').attr('src', e.target.result);
            }
            reader.readAsDataURL(file_data);
        }
    });

    // Handle form submission via AJAX
    $('#profile_image_form').on('submit', function(e) {
        e.preventDefault();

        var file_data = $('#profile_image').prop('files')[0];
        // if (!file_data) {
        //     alert('Please select a file to upload.');
        //     return;
        // }

        var form_data = new FormData();
        form_data.append('profile_image', file_data);
        form_data.append('user_id', $('#user_id').val());
        form_data.append('_token', $('input[name="_token"]').val());

        $.ajax({
            url: '{{ route("member.profile.image.update") }}',
            type: 'POST',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status) {
                    $('#profile_image_form').append(`<div class="alert alert-success mt-2">${response.message}</div>`);
                    setTimeout(() => {
                        location.reload();
                    }, 800);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
@endsection

