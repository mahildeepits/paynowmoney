<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function index(){
        $user = \Auth::guard('member')->user();
        return view('rewards.index',['rewards'=>$user->achievedRewards]);
    }
}
