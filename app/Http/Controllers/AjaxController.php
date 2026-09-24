<?php

namespace App\Http\Controllers;

use App\Models\Epin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\WalletOtp;
use App\Mail\OtpEmail;
use Illuminate\Support\Facades\Mail;

class AjaxController extends Controller
{
    public function validateSponsor(Request $request){
        if($request->sponsor == 'Company' || $request->sponsor == 'company'){
            if($request->has('is_for') && $request->is_for == 'transfer_money'){
                return ['status' => true,'sponsor' => 'Company','message' => 'Sponsor is valid'];
            }
            $res = ['sponsor'=>'Company','error_code'=>0];
        }else{
            $user = User::where(['member_id'=>$request->sponsor])->where('role','!=',1)->first();
            $res = ['sponsor'=> $user?->name ?? '','error_code'=>0];
            if($request->has('is_for') && $request->is_for == 'transfer_money'){
                $res = ['message' => ($user?->name ?? ''),'status' => true];
            }
            if($user == null){
                if($request->has('is_for') && $request->is_for == 'transfer_money'){
                    return ['status' => false,'message' => 'Sponsor not found'];
                }else{
                    $res = ['error'=>'Sponsor not found!','error_code'=> 403];
                }
            }else if($user->is_paid == 0){
                if($request->has('is_for') && $request->is_for == 'transfer_money'){
                    return ['status' => false,'message' => 'Sponsor is not paid'];
                }
            }
            
            // return response()->json($res);
        }
        return response()->json($res);
    }

    public function availablePins(Request $request){
        $pinsCount = Epin::whereJoiningKit($request->kit_id)
            ->whereTransferTo(Auth::guard('member')->user()->id)->whereNull('used_by')->count();
        return $pinsCount;
    }

    public function joiningPins(Request $request){
        $pinsCount = Epin::whereJoiningKit($request->kit_id)
            ->whereTransferTo(\Auth::guard('member')->user()->id)->whereNull('used_by')->get();
        if($pinsCount->isEmpty()){
            return response()->json(['status'=>false]);
        }else{
            return response()->json(['status'=>true,'record'=>$pinsCount->first(),'count'=>$pinsCount->count()]);
        }
    }
    public function sendOtp(Request $request){
        $user = authUser('member');
        $otps = WalletOtp::where('user_id',$user->id)->where('is_expired',0)->where('is_used',0)->get();
        $otp_array  = ($otps->count() > 0)? $otps->pluck('otp')->toArray() : [];
        if($otps->count() > 0){
            foreach($otps as $otp){
                $expire_at = \Carbon\Carbon::parse($otp->created_at)->addMinutes(2);
                if($expire_at <= now()){
                    $otp->update(['is_expired',1]);
                    $otp_array = array_diff($otp_array,[$otp->otp]);
                }
            }
        }
        if(count($otp_array) > 0){
            return ['status'=>true,'message'=> 'OTP sent successfully'];
        }
        $otp_code = uniqueOtpCode();
        $data = [
            'user_id' => $user->id,
            'otp' => $otp_code,
        ];
        $otp = WalletOtp::create($data);
        if($otp){
            Mail::to($user->email)->send(new OtpEmail($user, $otp_code));
            return ['status' => true,'message' => 'OTP sent successfully'];
        }
        return ['status'=> false,'message'=> 'Something went wrong'];
    }
}
