<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionsService;
use App\Models\AdminCharge;

class TransactionsController extends Controller
{
    public function withdrawlCreate(Request $request){
        $adminCharge = AdminCharge::first();
        $transaction_fees_percentage = ($adminCharge->admin_charges ?? 5) / 100;
        
        if($request->isMethod('post')){
            return (new TransactionsService)->addTransaction($request);
        }
        return view('wallet.withdrawl',compact('transaction_fees_percentage'));
    }

    public function setTransactionPin(Request $request){
        if($request->isMethod('post')){
            return (new TransactionsService)->setTransactionPin($request);
        }
        return view('wallet.set-pin');
    }
}
