<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Epin;
use App\Models\JoiningKit;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function transferPin(Request $request)
    {
        $joiningKits = JoiningKit::whereHas('pins')->get()->pluck('kit_name','id')->toArray();
        $epinsList = collect([]);
        if($request->has('transfer_pins')){
            $request->validate([
                'to_user' => 'required',
                'joining_kit' => 'required',
                'number_of_pins' => 'required',
            ]);
            $user = User::whereMemberId($request->to_user)->first();
            if($user == null){
                Session::flash('error','Error|User not found!');
                return back()->withInput($request->all());
            }
            $joiningKit = JoiningKit::find($request->joining_kit);
            $epins = Epin::where('pin_no','!=','1231231')->whereNull('used_by')
                ->whereNull('transferred_at')
                ->whereIn('joining_kit',[$request->joining_kit])
                ->whereNull('transfer_to')->get();
            if($epins->count() < $request->number_of_pins){
                Session::flash('error','Error|Number of pins not available! Generate the pins first');
                return back()->withInput($request->all());
            }
            $user = User::whereMemberId($request->to_user)->first();
            $pinsToTrasfer = $epins->take($request->number_of_pins)->pluck('id');
            $transferIncome = $joiningKit->amount * $pinsToTrasfer->count();
            WalletTransaction::create([
                'user_id'       => 'admin',
                'amount'        => $transferIncome ?? 0,
                'keyword'       => 'pin_transfer',
                'transfered_to' => $user->member_id,
            ]);
            Epin::whereIn('id',$pinsToTrasfer)->update(['transfer_to'=>$user->id,'transferred_at'=>Carbon::now()]);
            if(!$request->has('joining_kit')){
                $joiningKit = 1;
            }else{
                $joiningKit = $request->joining_kit;
            }
            savePinTransaction($pinsToTrasfer,1, $user->id, $joiningKit);
            Session::flash('success','Success|Pins transfer successfully!');
            $epinsList = $epins->take($request->number_of_pins);
        }
        return view('admin.manage-pins.joining-pins',compact('epinsList','joiningKits'));
    }

    public function pendingPins(Request $request){
        $userModel = null;
        if($request->isMethod('post')){
            $userModel = User::with(['transfer_pin_rel'])->whereMemberId($request->member_id)->first();
        }
        return view('admin.manage-pins.pending-pins',compact('userModel'));
    }
}
