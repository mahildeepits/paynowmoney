@extends('admin.layouts.admin')
@section('title','MLM Software - Admin Panel')
@section('content')
    <div id="main-wrapper">
        <div class="content-header">
            <h1 class="page-title">Roles</h1>
            <button class="btn btn-primary float-end" onclick="roleForm(`{{route('roles.create')}}`)">Add Role</button>
        </div>
        <div class="card" id="roles-form">

        </div>
       <div class="card">
            <div class="card-body" >
                <div class="row">
                    <div class="col-md-12">
                        {!! $dataTable->table(['class' => 'table table-bordered']) !!}
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
@section('scripts')
    @parent
    {!! $dataTable->scripts() !!}
    <script>
        function roleForm(route){
            $.ajax({
                url: route,
                type: 'get',
                success:function(res){
                    $('#roles-form').html(res);
                }
            })
        }
        function deleteRole(route){
            $.ajax({
                url: route,
                type: 'get',
                success:function(res){
                    message(res);
                }
            });
        }
        function message(res){
            if(res.status){
                toastr.success('success',res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }else{
                toastr.error('error',res.message);
            }
        }
        $(document).on('submit','#form',function(){
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            var route = $(this).attr('action');
            var method = $(this).attr('method');
            // console.log(formData.values());
            $(document).find('.invalid-feedback').html('');
            $.ajax({
                url: route,
                type: method,
                data: formData,
                processData:false,
                contentType:false,
                success:function(res){
                    message(res);
                },
                error:function(errors){
                    $.each(errors.responseJSON.errors, function(index, error) {
                        $(document).find('input[name='+index+']').parents('.form-group').find('.invalid-feedback').html('<span class="text-danger">'+error[0]+'</span>');
                    });
                }
            });
        });
    </script>
@endsection
