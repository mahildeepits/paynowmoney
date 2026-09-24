<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PinHistoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Epin;
use App\Models\JoiningKit;
use Illuminate\Http\Request;

class JoiningKitsController extends Controller
{
    public function joiningKits(){
        $joiningKits = JoiningKit::get();
        return view('admin.joining-kits.joining-kits',['kits'=>$joiningKits]);
    }

    public function saveJoiningKits(Request $request){
        $rules = [
            'kit_name' => 'required',
            'kit_pv' => 'required',
            'amount' => 'required',
            'is_red' => 'required'
        ];
        $fileName = '';
        if($request->has('kit_image')){
            $fileName = 'IMG_JOINING_KIT_'.rand(11111,99999).'.'.$request->file('kit_image')->getClientOriginalExtension();
            $request->file('kit_image')->move('kit_images/',$fileName);
        }
        $request->validate($rules);
        $joiningKitModel = new JoiningKit;
        $joiningKitModel->fill($request->except('kit_image'));
        $joiningKitModel->kit_image = $fileName;
        $joiningKitModel->is_red = $request->is_red;
        $joiningKitModel->direct_income = $request->direct_income ?? 0;
        $joiningKitModel->bonus_amount = $request->bonus_amount ?? 0;
        $joiningKitModel->level2_5 = $request->level2_5 ?? 0;
        $joiningKitModel->level6_15 = $request->level6_15 ?? 0;
        $joiningKitModel->level16_25 = $request->level16_25 ?? 0;
        $joiningKitModel->autopool_id = $request->autopool_id ?? null;
        $joiningKitModel->save();
        \Session::flash('success','Success|Joining Kit Saved Successfully!');
        return back();
    }

    public function deleteJoiningKit($id){
        $joiningKitModel = JoiningKit::find($id);
        $joiningKitModel->pins()->delete();
        $joiningKitModel->delete();
        \Session::flash('success','Success|Joining kit deleted successfully!');
        return back();
    }

    public function joiningPins(){
        $joiningPins = Epin::with(['joining_kit_rel','transfer_rel'])->get();
        return view('admin.joining-kits.joining-pins',['pins'=>$joiningPins]);
    }

    public function generatePins(Request $request){
        $rules = [
            'joining_kit' => 'required',
            'number_of_pins' => 'required|digits_between:1,10|numeric'
        ];
        $request->validate($rules);
        for($i = 1; $i <= $request->number_of_pins; $i++){
            $pinModel = new Epin;
            $pinModel->joining_kit = $request->joining_kit;
            $pinModel->pin_no = (double)random_int(1111111111,9999999999);
            $pinModel->save();
        }
        \Session::flash('success','Success|Pin\'s generated successfully!');
        return back();
    }

    public function pinStatus(Request $request){
        $epinModel = null;
        if($request->isMethod('post')){
            $epinModel = Epin::where('pin_no',$request->pin_no)->first();
        }
        return view('admin.joining-kits.joining-pins-status',compact('epinModel'));
    }

    public function pinHistory(PinHistoryDataTable $dataTable, Request $request){
        $availablePins = Epin::whereNull('used_by')->get();
        $transferredPin = Epin::whereNotNull('transfer_to')->get();
        return $dataTable->render('admin.joining-kits.pins-history',compact('availablePins','transferredPin'));
    }
}
