@extends('frontend.layouts.pages')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url(assets/images/22187.jpg)">
        <div class="auto-container">
            <h2>Products</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('web.home') }}">Home</a></li>
                <li>Products</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Project Page Section -->
    <section class="project-page-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="title style-two">Our Products</div>
                <h2>Our <span>Grocery</span> Products</h2>
            </div>
            <div class="row clearfix">

                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p7.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">Farm Fresh, Never Processed</a></h3>
                        </div>
                    </div>
                </div>
                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p8.jpg') }}" alt="" style="height: 262px;" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">Good for You, Good for the Planet</a></h3>
                        </div>
                    </div>
                </div>
                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p9.jpg') }}" style="height: 262px;" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">Simply. Naturally. Organic</a></h3>
                        </div>
                    </div>
                </div>

                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p1.jpg') }}" style="height: 262px;" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">Natural or Nothing</a></h3>
                        </div>
                    </div>
                </div>

                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p2.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">Fresh not Fake</a></h3>
                        </div>
                    </div>
                </div>

                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p3.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">You Deserve Better</a></h3>
                        </div>
                    </div>
                </div>

                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p4.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">Good Food Grows</a></h3>
                        </div>
                    </div>
                </div>

                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p5.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">The Honest Choice</a></h3>
                        </div>
                    </div>
                </div>

                <!-- Project Block Two -->
                <div class="project-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="javascript:void(0)"><img src="{{ asset('images/p6.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <div class="category">Product</div>
                            <h3><a href="projects-detail.html">Real Ingredients, Real Flavor</a></h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Project Page Section -->


@endsection
