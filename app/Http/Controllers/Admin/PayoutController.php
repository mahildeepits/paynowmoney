<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\PayoutSummary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PayoutController extends Controller
{
    public function index(Request $request){
        $payoutDetails = null;
        $userDetails = null;
        if($request->has('member_id')){
            $userDetails = User::where('member_id',$request->member_id)->first();
            $payoutDetails = Payout::where('username',$request->member_id)->get();
            if($payoutDetails->isEmpty()){
                \Session::flash('error','Error|No payout summary generated yet!');
                return back();
            }
        }
        return view('admin.payout.payout-report',compact('payoutDetails','userDetails'));
    }

    public function payoutDetails(Request $request){
        $details = [];
        if($request->has('from_date') && $request->has('to_date')){
            $details = $this->generatePayoutDetails($request);
        }
        return view('admin.payout.payout-details',compact('details'));
    }

    public function setPayoutAsPaid($id){
        $payout = Payout::find($id);
        $unpaidPayout = Payout::where('username',$payout->username)->where('credit_or_cut',null)->get();
        foreach($unpaidPayout as $unpaid){
            $unpaid->credit_or_cut = 'cut';
            $unpaid->save();
        }
        \Session::flash('success','Success|Payout paid successfully!');
        return back();
    }

    private function generatePayoutDetails($request):LengthAwarePaginator
    {
        return Payout::whereBetween(\DB::raw('date(created_at)'),[$request->from_date,$request->to_date])
            ->where('net_amount','!=',0)->paginate(10);

    }

    public function setPayoutAsUnPaid($id){
        $payout = Payout::find($id);
        $payout->credit_or_cut = null;
        $payout->save();
        \Session::flash('success','Success|Payout reversed successfully!');
        return back();
    }
}
