<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function myReceipt()
    {
        return view('record.receipt');
    }

    public function myInvoice(){
        return view('record.invoice');
    }

    public function idCard(){
        return view('record.idcard');
    }
}
