<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleEntry;
use App\Models\User;
use Illuminate\Http\Request;

class SaleEntryController extends Controller
{
        public function index(Request $request) {

            if(isset($request->member) && isset($request->from_date) && isset($request->to_date)) {

                $userInfo = User::where('member_id', $request->member);
                if($userInfo->exists()) {
                    $user = $userInfo->first();

                    $saleInfo = SaleEntry::where('user_id', $user->id)->whereBetween('created_on',[$request->from_date, $request->to_date])->orderBy('created_on')->paginate(10)->withQueryString();

                    return view('admin.sale-entry.index', compact('saleInfo'));

                }else{
                    \Session::flash('error', 'Error|User not found!');
                    return redirect()->route('admin.sale.entries',['member'=>'','from_date'=>$request->from_date,'to_date'=>$request->to_date]);
                }

            }

            return view('admin.sale-entry.index');
        }
}
