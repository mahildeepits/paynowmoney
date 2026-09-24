<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="{{ asset('concept/theme') }}/">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>@yield('title')</title>
        <style>
            .select2-container{
                border: 1px solid #ced4da;
                border-radius: 3px
            }
            .select2-selection{
                padding: .375rem .75rem!important;
            }
        </style>
        @include('admin.partial.head')
    </head>
    <body>

        <!-- Page Container -->
        <div class="page-container">
            <div class="page-sidebar">
                <div class="profile-menu">
                    <a href="app-profile.html">
                        <img src="{{ asset('concept/theme/assets/images/avatars/avatar1.png') }}" alt="">
                    </a>
                </div>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">

                    </div>
                </div>
{{--                <div class="settings-menu-btn">--}}
{{--                    <a href="#" class="settings-menu-link"><i class="fas fa-wrench"></i></a>--}}
{{--                </div>--}}
            </div>
            <!-- Page Content -->
            <div class="page-content">
                @include('admin.partial.mini-sidebar')
                <!-- Page Header -->
                @include('admin.partial.page-header')

                <!-- Page Inner -->
                <div class="page-inner no-page-title">
                    @yield('content')
                    <div class="page-footer">
                        <p>{{ date('Y',strtotime('+1 year')) }} &copy; MLM Software</p>
                    </div>
                </div><!-- /Page Inner -->

                @include('admin.partial.chat')
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
        <div class="modal fade" id="comman-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Top Up</h5>
                        <button type="button" class="close close-topup-modal closeModel" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route'=>'member.topup.now']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::label('pin_no','Pin No') !!}
                                    {!! Form::text('pin_no',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @section('scripts')
            <script>
                function route(){
                    return '{{ url('/') }}';
                }
            </script>
            <!-- Javascripts -->
            <script src="assets/plugins/jquery/jquery-3.1.0.min.js"></script>
            <script src="assets/plugins/bootstrap/popper.min.js"></script>
            <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <script src="assets/plugins/switchery/switchery.min.js"></script>
            <script src="assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
            <script src="assets/js/concept.js"></script>
            <script src="assets/js/pages/dashboard.js"></script>
            <script src="{{ asset('js/easyTooltip.js') }}"></script>
            <script src="{{ asset('plugins/dataTables/js/datatables.min.js') }}"></script>
            <script src="{{ asset('plugins/dataTables/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
            <script src="{{ asset('plugins/toast/jquery.toast.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
            <script src="{{ asset('js/adminjs.js?ref='.rand(11111,99999)) }}" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('.static-datatable').dataTable({
                        bSort: false,
                    });
                    $('.static-datatable-users').dataTable({
                        bSort: false,
                    });
                    toastr.options = {
                        closeButton: true,
                        debug: false,
                        progressBar: true,
                        preventDuplicates: true,
                        hideDuration: 800,
                        showDuration: 300,
                        extendedTimeOut: 4000,
                        positionClass: 'toast-top-right',
                    };
                    @if(session()->has('success'))
                    @php
                        $message = explode('|',session('success'));
                    @endphp
                    @if(count($message) > 1)
                        toastr.success('{{ $message[1] }}','{{ $message[0] }}')
                    @else
                        toastr.success('{{ $message[0] }}','Success')
                    @endif
                    @elseif(session()->has('error'))
                    @php
                        $message = explode('|',session('error'));
                    @endphp
                    @if(count($message) > 1)
                        toastr.error('{{ $message[1] }}','{{ $message[0] }}')
                    @else
                        toastr.error('{{ $message[0] }}','Error')
                    @endif
                    @endif
                });
            </script>
            <script>
                const toasterMessage = toastr;
                toasterMessage.options = {
                        closeButton: true,
                        debug: false,
                        progressBar: true,
                        preventDuplicates: true,
                        hideDuration: 800,
                        showDuration: 300,
                        extendedTimeOut: 4000,
                        positionClass: 'toast-top-right',
                    };
                function ajaxOnClick(route,method,data = {}){
                    $.ajax({
                        url:route,
                        type:method,
                        data:data,
                        success:function(res){
                            if(res.status){
                                toasterMessage.success('Success',res.message);
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            }
                            console.log(res);
                        },
                        error:function(xhr, status, error){
                            console.log(error);
                        }
                    });
                }
                function commanModel(route,title){
                    var commanModal = $('#comman-modal');
                    $.ajax({
                        url:route,
                        type:'get',
                        success:function(res){
                            if(res.status){
                                commanModal.modal('show');
                                commanModal.find('.modal-title').text(title);
                                commanModal.find('.modal-body').html(res.html);
                            }
                            console.log(res);
                        },
                        error:function(xhr, status, error){
                            console.log(error);
                        }
                    });
                }
                function ajaxFormSubmit(form){
                    event.preventDefault();
                    $('.invalid-feedback').removeClass('d-block text-danger').text('');
                    var formData = new FormData(form[0]);
                    var route = form.attr('action');
                    var method = form.attr('method');
                    $.ajax({
                        url:route,
                        type:method,
                        data:formData,
                        processData:false,
                        contentType:false,
                        cache:false,
                        success:function(res){
                            if(res.status){
                                toasterMessage.success('Success',res.message);
                                if(res.modal){
                                    form.trigger('reset');
                                    setTimeout(() => {
                                        $(document).find('.closeModel').trigger('click');
                                        $(document).find('table').DataTable().ajax.reload();
                                    }, 700);
                                }else{
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                }
                            }else{
                                toasterMessage.error('Error',res.message);
                            }
                        },
                        error:function(error){
                            $.each(error.responseJSON.errors,function(key,message){
                                $('input[name="'+key+'"]').parents('.form-group').find('.invalid-feedback').text(message[0]).addClass('text-danger d-block');
                            });
                        }
                    })
                }
                function deleteRecord(route,title){
                    if(confirm('Are you sure you want to delete this '+title+'?')){
                        $.ajax({
                            url:route,
                            type:'Delete',
                            data:{
                                _token:'{{ csrf_token() }}'
                            },
                            success:function(res){
                                if(res.status){
                                    toasterMessage.success('Success',res.message);
                                    $(document).find('table').DataTable().ajax.reload();
                                }else{
                                    toasterMessage.error('Error',res.message);
                                }
                            },
                            error:function(error){
                                toasterMessage.error('Error',error.responseJSON.message);
                            }
                        })
                    }
                }
                $('.close-topup-modal').click(function(){
                    $('#comman-modal').modal('hide');
                });
            </script>
        @show
    </body>
</html>
