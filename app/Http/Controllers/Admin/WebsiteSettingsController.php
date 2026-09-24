<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteSettingsController extends Controller
{

    public function index(Request $request)
    {
//        if($request->isMethod('post')){
//            $settingsModel = WebsiteSettings::firstOrNew();
//            $settingsModel->office_address = $request->office_address;
//            $settingsModel->email = $request->email;
//            $settingsModel->mobile = $request->mobile;
//            $settingsModel->whats_app_number = $request->whats_app_number;
//            $settingsModel->save();
//            Session::flash('success','Success|Website settings updated successfully!');
//            $details = $settingsModel;
//        }
//        $details = WebsiteSettings::first();
//        if($details == null){
//            $details = [];
//        }
//        return view('admin::website-settings.index',compact('details'));
    }
}
