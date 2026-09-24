<!-- Main Header -->
<header class="main-header">

    <!-- Header Top -->
    <div class="header-top">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <!-- Top Left -->
                <div class="top-left clearfix">
                    <div class="text">Welcome to Gold Grocery Shop</div>
                </div>

                <!-- Top Right -->
                <div class="top-right pull-right clearfix">
                    <!-- Social Box -->
                    <ul class="social-box">
                        <li><a href="https://www.facebook.com/" class="fa fa-facebook"></a></li>
                        <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    @if(request()->route()->getName() == 'web.home')
        <!-- Header Upper -->
        <div class="header-upper">
            <div class="auto-container">
                <div class="clearfix">

                    <div class="logo pull-left">
                        <div class="logo"><a href="{{ route('web.home') }}"><img src="assets/images/logo.png" alt="" title=""></a></div>
                    </div>

                    <div class="pull-right upper-right clearfix">

                        <!--Info Box-->
{{--                        <div class="upper-column info-box">--}}
{{--                            <div class="icon-box fas fa-envelope-open-text"></div>--}}
{{--                            <ul>--}}
{{--                                <li><strong>Mail Address</strong> <a href="mailto:martgrocery6@gmail.com">martgrocery6@gmail.com</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}

                    </div>

                </div>
            </div>
        </div>
        <!-- End Header Upper -->
    @endif
    <!-- Header Lower -->
    <div class="header-lower">
        <div class="auto-container">
            <div class="inner-container d-flex justify-content-between align-items-center">

                @if(request()->route()->getName() != 'web.home')
                    <!-- Logo -->
                    <div class="logo pull-left" style="width: 400px;">
                        <div class="logo"><a href="index.html"><img src="assets/images/logo.png" alt="" title=""></a></div>
                    </div>
                @endif

                <!-- Nav Outer -->
                <div class="nav-outer clearfix">
                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="{{ route('web.home') }}">Home</a>
                                </li>
                                <li><a href="{{ route('web.aboutus') }}">About Us</a>
                                </li>
                                <li><a href="{{ route('web.business') }}">Business</a>
                                </li>
                                <li><a href="{{ route('web.products') }}">Products</a>
                                </li>
                                <li><a href="javascript:void(0)">Rewards</a>
                                </li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Join Us</a></li>
                                <li><a href="{{ route('web.contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </nav>

                </div>
{{--                @if(request()->route()->getName() == 'web.home')--}}
{{--                    <!-- Main Menu End-->--}}
{{--                    <div class="outer-box clearfix">--}}

{{--                        <!-- Button Box -->--}}
{{--                        <div class="button-box">--}}
{{--                            <a href="mailto:martgrocery6@gmail.com" class="theme-btn btn-style-one"><span class="txt"><i class="fas fa-envelope-open-text"></i> martgrocery6@gmail.com</span></a>--}}
{{--                        </div>--}}
{{--                        <!-- End Button Box -->--}}

{{--                    </div>--}}
{{--                @endif--}}

            </div>
        </div>
    </div>
    <!-- End Header Lower -->

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <!--Logo-->
            <div class="logo pull-left" style="width: 300px;">
                <a href="index.html"><img src="assets/images/logo.png" alt="" title=""></a>
            </div>
            <!--Right Col-->
            <div class="pull-right">

                <!-- Main Menu -->
                <nav class="main-menu">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
                <!-- Main Menu End-->

                <!-- Mobile Navigation Toggler -->
                <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

            </div>
        </div>
    </div><!-- End Sticky Menu -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="index.html"><img src="assets/images/logo.png" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        </nav>
    </div><!-- End Mobile Menu -->

</header>
<!-- End Main Header -->

<style>
    .main-header .main-menu .navigation > li{
        margin-right: 85px !important;
    }
</style>
