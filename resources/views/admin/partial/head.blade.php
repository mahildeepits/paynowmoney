<!-- Styles -->
<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/plugins/icomoon/style.css" rel="stylesheet">
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet">
<link href="{{ asset('plugins/dataTables/css/datatables.min.css') }}" rel="stylesheet" >
<link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet" >
<link href="{{  asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">


<!-- Theme Styles -->
<link href="assets/css/concept.min.css" rel="stylesheet">
<link href="assets/css/custom.css?ref={{ rand(1111,9999) }}" rel="stylesheet">
<link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<style>
    .dropdown-menu li {
        position: relative;
    }
    .dropdown-menu .dropdown-submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
    }
    .dropdown-menu .dropdown-submenu-left {
        right: 100%;
        left: auto;
    }
    .dropdown-menu > li:hover > .dropdown-submenu {
        display: block;
    }
    .toast-success {
        background-color: #51a351 !important;
    }
    .toast-error {
        background-color: #bd362f !important;
    }

    .toggle {
        cursor: pointer;
        display: inline-block;
    }

    .toggle-switch {
        display: inline-block;
        background: #ccc;
        border-radius: 16px;
        width: 50px;
        height: 22px;
        position: relative;
        vertical-align: middle;
        transition: background 0.25s;
    }
    .toggle-switch:before, .toggle-switch:after {
        content: "";
    }
    .toggle-switch:before {
        display: block;
        background: linear-gradient(to bottom, #fff 0%, #eee 100%);
        border-radius: 50%;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.25);
        width: 18px;
        height: 18px;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: left 0.25s;
    }
    .toggle:hover .toggle-switch:before {
        background: linear-gradient(to bottom, #fff 0%, #fff 100%);
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.5);
    }
    .toggle-checkbox:checked + .toggle-switch {
        background: #56c080;
    }
    .toggle-checkbox:checked + .toggle-switch:before {
        left: 30px;
    }

    .toggle-checkbox {
        position: absolute;
        visibility: hidden;
    }

    .toggle-label {
        margin-left: 5px;
        position: relative;
        top: 2px;
    }
</style>
@yield('styles')
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
