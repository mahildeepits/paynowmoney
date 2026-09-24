<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PayoutController extends Controller
{
    public function index(){
        $payoutDetails = Payout::where('username',auth()->guard('member')->user()->member_id)->get();
        return view('payout.index',compact('payoutDetails'));
    }

}
