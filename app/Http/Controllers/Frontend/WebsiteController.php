<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        return view('frontend.layouts.home');
    }

    public function aboutus(){
        return view('frontend.about-us');
    }

    public function business(){
        return view('frontend.business');
    }

    public function products(){
        return view('frontend.products');
    }

    public function contactUs(){
        $contactDetails = Setting::get();
        return view('frontend.contact',compact('contactDetails'));
    }
}
