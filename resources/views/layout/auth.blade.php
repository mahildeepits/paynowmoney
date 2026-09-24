<!doctype html>
<html lang="en">

<head>
    <base href="{{ asset('template') }}/">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
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
    <link href="{{ asset('plugins/toast/jquery.toast.min.css') }}" rel="stylesheet">
    <title>Login:: {{ config('app.name') }}</title>
    <style>
        .btn-main{
            background: #51355d;
            color: white;

        }
    </style>
</head>

<body class="bg-lock-screen">
@yield('content')
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{ asset('plugins/toast/jquery.toast.min.js') }}" type="text/javascript"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<!--app JS-->
<script src="assets/js/app.js"></script>

@section('scripts')
    <script type="text/javascript">
        function route(){
            return '{{ url('/') }}';
        }
        $(document).ready(function(){
            @if(session()->has('success'))
                @php
                    $sessionData = explode('|',session('success'));
                @endphp
                $.toast({
                    heading: '{{ $sessionData[0] }}',
                    text: '{{ $sessionData[1] }}',
                    icon: 'info',
                    showHideTransition: 'slide',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#9EC600'  // To change the background
                });
            @endif
            @if(session()->has('error'))
                @dd('here')
                @php
                    $sessionData = explode('|',session('error'));
                @endphp
                $.toast({
                    heading: '{{ $sessionData[0] }}',
                    text: '{{ $sessionData[1] }}',
                    icon: 'error',
                    showHideTransition: 'slide',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#c6001e'  // To change the background
                });
            @endif
        })
    </script>
@show
</body>

</html>
