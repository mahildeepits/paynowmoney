<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JoiningKit;
use App\Models\User;

class ShoppingApiController extends Controller
{
    public function purchaseKit(Request $request){
        $kit = JoiningKit::find($request->kit_id);
        $user = User::where('email',$request->email)->first();
        if($kit != null && $user != null){
            $user->kit_id = $kit->id;
            $user->save();
            return ['success' => true];
        }
        return ['success' => false];
    }
    public function getKits(Request $request){
        $kits = JoiningKit::with('unUsedPins')->get();
        if($kis->count() > 0){
            return ['success' => true,'kits' => $kits];
        }
        return ['success' => false];
    }
}
