<!DOCTYPE html>
<html>
@include('frontend.components._head')

<body>

<div class="page-wrapper">

    @include('frontend.components._loader')

    @include('frontend.components._header')

    @yield('content')

    @include('frontend.components.footer')

    <!-- Search Popup -->
    <div class="search-popup">
        <button class="close-search style-two"><span class="flaticon-cancel-1"></span></button>
        <button class="close-search"><span class="flaticon-up-arrow"></span></button>
        <form method="post" action="blog.html">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here" required="">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- End Header Search -->

</div>
<!-- End PageWrapper -->

@include('frontend.components._scripts')
</body>
</html>
