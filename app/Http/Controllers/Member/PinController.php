<?php

namespace App\Http\Controllers\Member;

use App\DataTables\PinHistoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Epin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AdminCharge;
use App\Helpers\RewardHelper;
use App\Models\JoiningKit;
use App\Models\UserKit;
use Illuminate\Support\Facades\DB;
use App\Models\WalletTransaction;

class PinController extends Controller
{
    public function joiningPins(Request $request){
        return view('pins.joining-pins');
    }

    public function transferPins(){
        return view('pins.transfer-pin');
    }

    public function transferPinsNow(Request $request){
        $pinsCount = Epin::whereJoiningKit($request->joining_kit)
            ->whereTransferTo(\Auth::guard('member')->user()->id)->whereNull('used_by')->get();
        if($request->number_of_pins > $pinsCount->count() ){
            \Session::flash('error','Error|Number of pins should not more than available pins!');
            return back();
        }
        $trasnferTo = User::whereMemberId($request->transfer_to)->first();
        Epin::whereJoiningKit($request->joining_kit)->whereTransferTo(\Auth::guard('member')->user()->id)
            ->whereNull('used_by')
            ->limit($request->number_of_pins)->update([
                'transfer_to' => $trasnferTo->id
            ]);
        \Session::flash('success','Success|Pins transfer successfully!');
        return back();
    }

    public function pinsHistory(PinHistoryDataTable $dataTable, Request $request){
        if($request->has('from_date') || $request->has('to_date') || $request->has('joining_kit')){
            $dataTable->with([
                'from_date' => Carbon::parse($request->from_date)->format('Y-m-d'),
                'to_date' => Carbon::parse($request->to_date)->format('Y-m-d'),
                'joining_kit' => $request->joining_kit
            ]);
        }
        $availablePins = Epin::whereTransferTo(\Auth::guard('member')->user()->id)
            ->whereNull('used_by')->get();
        $transferredPin = Epin::whereTransferFrom(\Auth::guard('member')->user()->id)->whereNull('used_by')->get();
        return $dataTable->render('pins.pins-history',compact('availablePins','transferredPin'));
    }

    public function joiningPackages(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'joining_kit_id' => 'required',
                'userid'         => 'required',
                'username'       => 'required',
            ]);
            $previous_autopool_id = null;
            $is_upgrade = false;
            /* Auth User */
            $authUser = authUser('member');
            /* Get topup User */
            $topupUser = User::where('member_id', $request->userid)->first();
            /* Get joining kit */
            $joiningKit = JoiningKit::find($request->joining_kit_id);
            /* Check if User have enough money for Topup */
            $walletIncome = $authUser?->walletIncomesByKey() ?? 0;
            // dd($isPinsAvailable->count() >= 1);
            if($walletIncome >= $joiningKit->amount) {
                /* Check if any pin is Available which is not used */
                $isPinsAvailable =  Epin::whereJoiningKit($request->joining_kit_id)
                                    ->where('pin_no', '!=', 1231231)
                                    // ->where('transfer_to',$authUser?->id)
                                    ->whereNull('used_by')
                                    ->get();
                /* Generate Pin if Not available */
                if ($isPinsAvailable->count() < 1) {
                    $pinNo = random_int(1111111111,9999999999);
                    $availablePin = Epin::create([
                        'joining_kit' => $request->joining_kit_id,
                        'transfer_to' => $authUser?->id,
                        'pin_no' => $pinNo,
                    ]);
                } else {
                    $availablePin = $isPinsAvailable->where('pin_no', '!=', 1231231)->first();
                }
                $joining_kit = $availablePin->joining_kit_rel ?? null;
                $pinNo       = $availablePin->pin_no;
                /* If User Upgrade */
                if($request->has('is_upgrade') && $request->is_upgrade == 1){
                    $is_upgrade = true;
                    if($topupUser?->latestJoiningKit == null){
                        return back()->with('error','Error|This user is not eligible for upgrade');
                    }
                    if($topupUser?->latestJoiningKit?->amount >= $joining_kit?->amount){
                        return back()->with('error','Error|You can`t upgrade to same/lower level');
                    }
                    $upgrade_users = $topupUser->allChildMembers->map(function($user)use($joining_kit){
                        return $joining_kit?->amount > $user->latestJoiningKit?->amount;
                    })->filter();
                    if($joining_kit->upgrade_require_user_count > $upgrade_users->count() ){
                        return back()->with('error','Error|You are not qualify to upgrade');
                    }
                    $previous_autopool_id = $topupUser?->latestJoiningKit?->autopool_id ?? null;
                }else{
                    if($topupUser->is_paid != 0){
                        return back()->with('error','Error|User is already paid!');
                    }
                    if($joining_kit->amount > 27){
                        return back()->with('error','Error|You have top up with basic kit first');
                    }
                }
                /* Save User Kit and Update the User and Epin */
                $data = [
                    'kit_id'  => $request->joining_kit_id,
                    'user_id' => $topupUser->id,
                    'epin_id' => $availablePin->id
                ];
                $res = $this->savePinData($topupUser,$data,$availablePin);

                if($res['status']){
                    RewardHelper::directIncome($topupUser->id);
                    RewardHelper::charityIncome($topupUser->id);
                    RewardHelper::sponsorIncome($topupUser->id);
                    RewardHelper::autopoolIncome($topupUser->id);
                    if($is_upgrade){
                        RewardHelper::settlePreviousAutopool($topupUser, $previous_autopool_id);
                    }
                    /* Wallet Transaction */
                    WalletTransaction::create([
                        'user_id' => $authUser?->member_id,
                        'keyword' => ($topupUser->id == $authUser?->id) ? 'self_topup' : 'user_topup',
                        'amount'  => $joiningKit->amount,
                        'pin_no'  => $pinNo,
                    ]);
                    return back()->with('success','Success|'.$res['message']);
                }else{
                    return back()->with('error','Error|'.$res['message']);
                }
            }else{
                return back()->with('error', 'Error|Insufficient wallet income!');
            }
        }
        return view('joining-packages.joining-pins');
    }
    public function selfUpgradeView(){
        return view('joining-packages.self-upgrade');
    }
    public function selfUpgrade(Request $request){
        $request->validate([
            'joining_kit' => 'required',
        ]);
        $user = authUser('member');
        $isPinsAvailable = Epin::whereJoiningKit($request->joining_kit)->where('transfer_to',$user->id)->whereNull('used_by')->get();
        if($isPinsAvailable->count() == 0){
            return back()->with('error','Error|Pins not available!');
        }
        if($user->is_paid == 0){
            return back()->with('error','Error|User is not paid!');
        }
        $firstAvailablePin = $isPinsAvailable->first();
        if($firstAvailablePin->joining_kit_rel != null && $firstAvailablePin->joining_kit_rel->amount > $user->latestJoiningKit->amount){
            $data = [
                'kit_id' => $request->joining_kit,
                'user_id' => $user->id,
                'epin_id' => $firstAvailablePin->id
            ];
            $res = $this->savePinData($user,$data,$firstAvailablePin);
            if($res['status']){
                // RewardHelper::AutopoolIncome($user);
                return back()->with('success','Success|'.$res['message']);
            }else{
                return back()->with('error','Error|'.$res['message']);
            }
        }
        return back()->with('error','Error|You are not eligible fo this upgrade');
        
    }
    public function savePinData($isUserRed,$data,$firstAvailablePin){
        DB::beginTransaction();
        try {
            UserKit::create($data);

            $isUserRed->is_paid = 1;
            $isUserRed->epin = $firstAvailablePin->pin_no;
            $isUserRed->user_icon = 'userpaid.png';
            $isUserRed->save();

            $firstAvailablePin->used_by = $isUserRed->id;
            $firstAvailablePin->used_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $firstAvailablePin->save();
            
            // $res = $authController->addCouponToEcommerce($isUserRed,$firstAvailablePin->joining_kit_rel);
            // if($res['status'] == true){
                // $code = $res['code'];
                // $isUserRed->last_coupon_date = Carbon::now()->format('Y-m-d');
                // $isUserRed->total_months = $isUserRed->total_months ? $isUserRed->total_months + 1 : 1;
                // $isUserRed->save();
                // $this->sendEmail($user->email,$user,$code);
            // }
            // $authController->generatePayoutForSingleUser($isUserRed,$chargesModel);
            // RewardHelper::giveRewards();

            DB::commit();
            return ['status' => true,'message' => 'Pin Purchased Successfully'];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => false,'message' => $th->getMessage()];
        }
    }
    public function upgradeKit($request){

    }
}
