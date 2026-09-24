<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor4">

<head>
    <base href="{{ asset('template') }}/">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="assets/css/dark-theme.css" />
    <link rel="stylesheet" href="assets/css/semi-dark.css" />
    <link rel="stylesheet" href="assets/css/header-colors.css" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css?ref='.rand(1111,9999)) }}">
    <link rel="stylesheet" href="{{ asset('css/treeview.css?ref='.rand(1111,9999)) }}">
    <link rel="stylesheet" href="{{asset('plugins/dataTables/css/datatables.min.css')}}">
    <link href="{{ asset('plugins/toast/jquery.toast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet" >

    @section('css')
    @show
    <style>
        .btn-main{
            background: #51355d;
            color: white;
        }
    </style>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('components._sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    <header>
        @php
            $authMember = auth('member')->user();
        @endphp
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                {{-- @if($authMember->is_paid == 0)
                    <div class="top-menu ms-auto text-left d-none d-lg-block">
                        <a href="javascript:void(0)" class="btn btn-main topupNow">Top Up Now</a>
                    </div>
                @endif --}}
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                </div>
                <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                        <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                    </div>
                </div>
                <div class="top-menu ms-auto" style="text-align: center; padding-left: 19px;">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item pt-3" style="margin-right: 15px;">
                            <p>Member ID: <b>{{ $authMember->member_id }}</b></p>
                        </li>
                        @if(!isStudent())
                            <li class="nav-item pt-3">
                                <p>Wallet Amount: <b>₹ {{ authUser()->walletIncomesByKey() ?? 0 }}</b></p>
                                {{-- @if($authMember->is_paid == 1)
                                @else
                                    <p>Wallet Amount: <b>0</b></p>
                                @endif --}}
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ $authMember->profile_image_url }}" class="user-img" alt="user avatar">
                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ $authMember->name }}</p>
                            <p class="designattion mb-0">Member</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('account.profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        @yield('content')
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2021. All right reserved.</p>
    </footer>
</div>

<div class="modal fade" id="topupModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Top Up</h5>
                <button type="button" class="close close-topup-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route'=>'member.topup.now']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('pin_no','Pin No') !!}
                            {!! Form::text('pin_no',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submits" class="btn btn-main">Top Up Now</button>
                    <button type="button" class="btn btn-secondary close-topup-modal" data-dismiss="modal">Close</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="assets/plugins/jquery-knob/excanvas.js"></script>
<script src="assets/plugins/jquery-knob/jquery.knob.js"></script>
<script src="{{ asset('plugins/toast/jquery.toast.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/easyTooltip.js') }}"></script>
<script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/dataTables/js/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/dataTables/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        $(".knob").knob();
    });
</script>
<script src="assets/js/index.js"></script>
<!--app JS-->
<script src="assets/js/app.js"></script>
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
@section('scripts')
    <script type="text/javascript">
        const toasterMessanger = toastr;
        toasterMessanger.options = {
                closeButton: true,
                debug: false,
                progressBar: true,
                preventDuplicates: true,
                hideDuration: 800,
                showDuration: 300,
                extendedTimeOut: 4000,
                positionClass: 'toast-top-right',
            };
        function route(){
            return '{{ url('/') }}';
        }
        function toasterMessage(type,message){
            $.toast({
                heading: type,
                text: message,
                icon: type,
                showHideTransition: 'fade',
                loader: false,        // Change it to false to disable loader
                loaderBg: '#9EC600', // To change the background
                hideAfter: 5000,
                stack: 2,
                position: 'top-right',
                allowToastClose:true,
                className: 'custom-toast',
            });
        }
        function toastrMessage(heading, message, type = 'info') {
            $.toast({
                heading: heading,
                text: message,
                icon: type, // success | error | info | warning
                showHideTransition: 'slide',
                loader: true,
                loaderBg: type === 'error' ? '#c6001e' : '#9EC600'
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
                            toasterMessanger.success('Success',res.message);
                            if(res.modal){
                                form.trigger('reset');
                                setTimeout(() => {
                                    $(document).find('.closeModel').trigger('click');
                                    $(document).find('table').DataTable().ajax.reload();
                                }, 700);
                            }
                            if (res.refresh) {
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            }
                            if(res.redirect){
                                setTimeout(() => {
                                    window.location.href = res.redirect;
                                }, 1000);
                            }
                        }else{
                            toasterMessanger.error('Error',res.message);
                        }
                    },
                    error:function(error){
                        $.each(error.responseJSON.errors,function(key,message){
                            if($(document).find('input[name="'+key+'"]').length > 0){
                                $(document).find('input[name="'+key+'"]').parents('.form-group').find('.invalid-feedback').text(message[0]).addClass('text-danger d-block');
                            }else{
                                $(document).find('#'+key).parents('.form-group').find('.invalid-feedback').text(message[0]).addClass('text-danger d-block');
                            }
                        });
                    }
                })
            }
        $(document).ready(function(){
            @if(session()->has('success'))
            @php
                $sessionData = explode('|',session('success'));
            @endphp
            @if(count($sessionData) > 1)
                $.toast({
                    heading: '{{ $sessionData[0] }}',
                    text: '{{ $sessionData[1] }}',
                    icon: 'info',
                    showHideTransition: 'slide',
                    loader: true,
                    loaderBg: '#9EC600'
                });
            @else
                $.toast({
                    heading: 'Success',
                    text: '{{ $sessionData[0] }}',
                    icon: 'info',
                    showHideTransition: 'slide',
                    loader: true,
                    loaderBg: '#9EC600'
                });
            @endif
            @endif
            @if(session()->has('error'))
                @php
                    $sessionData = explode('|',session('error'));
                @endphp
                @if(count($sessionData) > 1)
                    $.toast({
                        heading: '{{ $sessionData[0] }}',
                        text: '{{ $sessionData[1] }}',
                        icon: 'error',
                        showHideTransition: 'slide',
                        loader: true,
                        loaderBg: '#c6001e'
                    });
                @else
                    $.toast({
                        heading: 'Error',
                        text: '{{ $sessionData[0] }}',
                        icon: 'error',
                        showHideTransition: 'slide',
                        loader: true,
                        loaderBg: '#c6001e'
                    });
                @endif
            @endif
            try{
                $('.static-datatable').dataTable({
                    bSort: false
                });
            }catch(e) {

            }

            $('.topupNow').click(function(){
                $('#topupModal').modal('show');
            });

            $('.close-topup-modal').click(function(){
                $('#topupModal').modal('hide');
            });
            
        
        });
    </script>
@show
</body>

</html>
