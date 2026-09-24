<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class PancardController extends Controller
{

    public function index(Request $request)
    {
        $userModel = collect([]);
        if($request->isMethod('post')){
            if($request->has('select_user') && !empty($request->select_user)){
                UserProfile::whereIn('user_id',$request->select_user)->update(['is_pancard_approve'=>1]);
                \Session::flash('success','Success|Pancard approved successfully!');
            }
            $userModel = User::with(['profile_rel'=>function($query) use ($request){
                if($request->select_option == 'pan_not_exist'){
                    return $query->whereNull('pan_card_number');
                }else {
                    return $query->whereNotNull('pan_card_number');
                }
            }]);
            if($request->select_option == 'pan_exist'){
                $userModel->whereHas('profile_rel');
            }
            $userModel = $userModel->get();
        }
        return view('admin.pancard-report.index',compact('userModel'));
    }
}
