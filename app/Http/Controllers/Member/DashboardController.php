<?php

namespace App\Http\Controllers\Member;

use App\Helpers\RewardHelper;
use App\Http\Controllers\Controller;
use App\Models\AdminCharge;
use App\Models\Epin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        $announcement = \App\Models\Announcement::where('status', 1)->latest()->first();
        return view('dashboard.index', compact('announcement'));
    }

    public function topupPage(){
        return view('dashboard.topup');
    }

    public function topupNow(Request $request){
        $user = \Auth::guard('member')->user();
        if($request->has('from_existing_pins')){
            $epins = Epin::where('transfer_to',$user->id)->whereNull('used_by')->get();
            if($epins->count() > 0){
                $epin = $epins->first();
                $epin->update(['used_by' => $user->id]);
                $user->update(['is_paid' => 1,'user_icon'=>'userpaid.png','epin'=>$epin->pin_no]);
                $this->generateUsersPayout($user);
                Session::flash('success','Success|Pins topup successfully!');
                return back();
            }else{
                Session::flash('error','Error|No pins found to topup!');
            }
        }
        if($request->isMethod('post')){
            if(!$request->has('pin_no')){
                Session::flash('error','Error|Please enter pin number!');
                return back();
            }
            $epin = Epin::wherePinNo($request->pin_no)->whereNull('used_by')->first();
            if($epin === null){
                Session::flash('error','Error|Invalid pin number!');
                return back();
            }
            $epin->update(['used_by' => $user->id]);
            $user->update(['is_paid' => 1,'user_icon'=>'userpaid.png','epin'=>$epin->pin_no]);
            $this->generateUsersPayout($user);
            Session::flash('success','Success|Pins topup successfully!');
            return back();
        }
    }

    public function generateUsersPayout($userModel){
        $authController = new AuthController;
        $chargesModel = AdminCharge::first();
        $authController->generatePayoutForSingleUser($userModel,$chargesModel);
        RewardHelper::giveRewards();
    }
}
