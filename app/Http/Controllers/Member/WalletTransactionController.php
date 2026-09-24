<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Epin;
use App\Models\User;
use App\Models\JoiningKit;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use App\Http\Controllers\Controller;
use App\Models\WalletOtp;
use DB;

class WalletTransactionController extends Controller
{
    public function walletIndex(){
        $adminCharge    = \App\Models\AdminCharge::first();
        $user = authUser('member');
        if($user == null){
            abort(403,'User Not Found');
        }
        $userTransations =  WalletTransaction::where('user_id', authUser('member')->member_id)
                            ->orWhere('transfered_to', authUser('member')->member_id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        // return view('rewards.bonus',compact('user',
        return view('wallet.index',compact('user', 'userTransations'));
    }
    public function transferToWallet(Request $request) {
        $user = authUser();
        $id = decrypt($request->id);
        $payout = \App\Models\UserPayout::where('user_id', $user->id)
            ->where('id', $id)
            ->whereNull('is_requested')
            ->where('income_type', '!=', 'withdrawal')
            ->first();
        
        if ($payout) {
            $amount = $payout->amount;
            if ($amount >= 10) {
                WalletTransaction::create([
                    'user_id'  => authUser()->member_id,
                    'keyword'  => 'self_transfer_'.$payout->income_type,
                    'amount'   => $amount,
                ]);
                $payout->is_requested = Carbon::now();
                $payout->save();
                \Session::flash('success','Success|Income transfer to Wallet successfully!');
                return back();
            }
            \Session::flash('error','Error|Minimum amount to transfer should be ₹10!');
            return redirect()->back();
        }
        \Session::flash('error','Error|Income record not found or already transferred!');
        return redirect()->back();
    }

    public function bulkTransferToWallet(Request $request) {
        $user = authUser();
        $ids = $request->ids;
        
        DB::beginTransaction();
        try {
            $query = \App\Models\UserPayout::where('user_id', $user->id)
                    ->whereNull('is_requested')
                    ->where('income_type', '!=', 'withdrawal');

            if ($ids === 'all') {
                $payouts = $query->get();
            } else {
                $payouts = $query->whereIn('id', $ids)->get();
            }

            if ($payouts->isEmpty()) {
                return response()->json(['status' => false, 'message' => 'No eligible payout records found!']);
            }

            foreach ($payouts as $payout) {
                $amount = $payout->amount;
                if ($amount > 0) {
                    WalletTransaction::create([
                        'user_id'  => $user->member_id,
                        'keyword'  => 'self_transfer_'.$payout->income_type,
                        'amount'   => $amount,
                    ]);
                    $payout->is_requested = Carbon::now();
                    $payout->save();
                }
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Payouts transferred to Wallet successfully!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Error: ' . $th->getMessage()]);
        }
    }

    public function walletTransaction(Request $request) {
        $type = $request->type ?? null;
        $amount = $request->amount ?? 0;
        if ($type == 'transfer') {
            $request->validate([
                'to_user' => 'required',
                'amount' => 'required',
            ]);
            $skip_otp = ($request->has('skip_otp') && $request->skip_otp == 1) ? true : false;
            if((!$request->has('skip_otp') || $request->skip_otp != 1) && $request->otp == null){
                return response()->json(['errors' => ['otp' => ['OTP is required']]], 422);
            }
            DB::beginTransaction();
            try {
                if($skip_otp == false){
                    $varifiedResponse = checkOtp($request->otp);
                    if ($varifiedResponse['status'] == false) {
                        return response()->json(['errors' => ['otp' => [$varifiedResponse['message']]]], 422);
                    }
                }
                $to_user = $request->to_user ?? null;
                $transferedUser = User::where('member_id', $to_user)->first();
                if ($transferedUser != null) {
                    $transfered = WalletTransaction::create([
                        'user_id'       => authUser()->member_id,
                        'keyword'       => 'transfer',
                        'transfered_to' => $transferedUser->member_id,
                        'amount'        => $amount,
                    ]);
                    if($skip_otp == false){
                        $otp = WalletOtp::where('otp', $request->otp)->first();
                        if($otp){
                            $otp->update(['is_used' => 1]);
                        }
                    }
                    DB::commit();
                    return ['status' => true,'modal' => true,'refresh' => true,'message' => 'Transfer successfully','code' => 200];
                }
                throw new \Exception("Error Processing Request", 1);
            } catch (\Throwable $th) {
                DB::rollBack();
                return ['status' => false,'message' => $th->getMessage(),'code' => 400];
            }
        } else if ($type == 'buy_pin') {
            $joiningKit = JoiningKit::find(decrypt($request->joining_kit_id));
            if ($joiningKit != null) {
                $pin = random_int(1111111111,9999999999);
                $kitAmount = $joiningKit->amount ?? 0;
                $pinModel = new Epin;
                $pinModel->joining_kit    = $joiningKit->id;
                $pinModel->pin_no         = $pin;
                $pinModel->transfer_to    = authUser()->id;
                $pinModel->transferred_at = Carbon::now();
                $pinModel->save();
    
                WalletTransaction::create([
                    'user_id'  => authUser()->member_id,
                    'keyword'  => 'buy_pin',
                    'pin_no'   => $pin,
                    'amount'   => $kitAmount,
                ]);
                \Session::flash('success', 'Success|Pin Purchased Sucessfully ');
                return redirect()->back();
            }
            \Session::flash('error', 'Error|Kit not Found!');
            return redirect()->back();
        }
        return redirect()->back();
    }
}
