@extends('frontend.layouts.pages')

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image: url(assets/images/22187.jpg)">
        <div class="auto-container">
            <h2>Contact</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('web.home') }}">Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Contact Page Section -->
    <section class="contact-page-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="title style-two">Contact Us</div>
                <h2>Our <span>Contact</span> Details</h2>
            </div>
            <div class="row clearfix mt-none-30">
                @php
                    $email = $contactDetails->where('key','email')->first();
                    $address = $contactDetails->where('key','office_address')->first();
                    $mobile = $contactDetails->where('key','mobile')->first();
                    $whatsAppNumber = $contactDetails->where('key','whats_app_number')->first();
                @endphp
                <!-- Contact Info Block -->
                <div class="contact-info-block col-lg-4 col-md-5 col-sm-12">
                    @if($email != null && $email->value != null)
                        <div class="inner-box mt-30">
                            <div class="content">
                                <span class="icon flaticon-email-3"></span>
                                <h4>Mail address</h4>
                                <a href="javascript:void(0)">{{ $email->value }}</a> <br/>
                            </div>
                        </div>
                    @endif
                    @if($address != null && $address->value != null)
                        <div class="inner-box mt-30">
                            <div class="content">
                                <span class="icon flaticon-map"></span>
                                <h4>Office address</h4>
                                <div class="text">{{ $address->value }}</div>
                            </div>
                        </div>
                    @endif
                    @if($whatsAppNumber != null && $whatsAppNumber->value !== null)
                        <div class="inner-box mt-30">
                            <div class="content">
                                <span class="icon flaticon-telephone"></span>
                                <h4>Phone Number</h4>
                                <a href="javascript:void(0)">{{ $whatsAppNumber->value }}</a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="contact-map-section col-lg-8 col-md-7 col-sm-12">
                    <div class="map-boxed mt-30">
                        <!--Map Outer-->
                        <div class="map-outer">
                            <iframe src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Amritsar, Punjab 143001&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Page Section -->



@endsection
