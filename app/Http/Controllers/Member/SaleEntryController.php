<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\SaleEntry;
use App\Models\User;
use Illuminate\Http\Request;

class SaleEntryController extends Controller
{

    public function index(Request $request)
    {
        if(auth()->guard('member')->user()->is_franchise == 0) {
            return back();
        }

        if($request->isMethod('post')) {
            $validator = $request->validate([
                'member_id' => 'required',
                'amount' => 'required|numeric',
                'created_on' => 'required|date',
            ]);
            $purchaseUser = User::where('member_id',$request->member_id)->first();
            if($purchaseUser->isFirstSale() == 0) {
                $amt = (float)$request->amount;
                $initialAmt = (float)getAdminCharges('first_sale_entry_amount');

                if($amt < $initialAmt) {
                    \Session::flash('error', "Error|Amount can't be less than $initialAmt!");
                    return back()->withInput();
                }
            }

            $userReq = User::where('member_id', $request->member_id);

            if($userReq->exists()) {
                $userInfo = $userReq->first();
                $uid=$userInfo->id;
            }else{
                \Session::flash('error', "Error|User not found!");
                return back()->withInput();
            }


            $saleEntry = new SaleEntry();
            $saleEntry->user_id  = $uid;
            $saleEntry->amount  = $request->amount;
            $saleEntry->created_on  = $request->created_on;
            $saleEntry->created_by  = auth()->guard('member')->user()->id;


            if($saleEntry->save()) {
                \Session::flash('success','Success|Sale added successfully!');
            }else{
                \Session::flash('error', 'Error|Something went wrong!');
            }
            return back();
        }

        $startDate = !empty($request->date) ? $request->date : '';
        $endDate = !empty($request->end_date) ? $request->end_date : '';


        $query = SaleEntry::where('created_by', auth()->guard('member')->user()->id)
            ->when(!empty($startDate) && !empty($endDate), function ($q) use($startDate, $endDate) {
                return $q->whereDate('created_on', '>=', $startDate)->whereDate('created_on', '<=', $endDate);
            });

        $saleInfo = $query->orderby('id', 'DESC')->get();

        return view('sale-entry.index', compact('saleInfo'));
    }

    public function myPurchases(){
        $myPurchases = SaleEntry::where('user_id',auth()->guard('member')->user()->id)->orderBy('id','desc')->get();
        return view('purchases.index',compact('myPurchases'));
    }

}
