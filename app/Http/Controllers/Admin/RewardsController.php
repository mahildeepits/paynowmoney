<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function index(){
        $rewards = Reward::get();
        return view('admin.rewards.index',compact('rewards'));
    }

    public function save(Request $request){
        $request->validate([
            'pairs' => 'required',
            'amount' => 'required',
            'name' => 'required',
            'rank' => 'required',
            'image' => 'required'
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('rewards'), $imageName);

        Reward::create([
            'pairs' => $request->pairs,
            'amount' => $request->amount,
            'name' => $request->name,
            'rank' => $request->rank,
            'image' => $imageName,
        ]);
        \Session::flash('success','Success|Reward added successfully');
        return back();
    }

    public function delete($id){
        $reward = Reward::find($id);
        if($reward){
            $reward->delete();
            \Session::flash('success','Success|Reward deleted successfully');
        }else{
            \Session::flash('error','Error|Reward not found');
        }
        return back();
    }
}
