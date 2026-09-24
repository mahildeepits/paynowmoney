<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Emi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmiController extends Controller
{
    public function index()
    {
        $user = Auth::guard('member')->user();
        // Auto-generation logic moved to Console Command: MakeMonthlyEmi
        // $joinDate = Carbon::parse($user->created_at);
        // ... loop removed ...
        
        $emis = Emi::where('user_id', $user->id)->orderBy('id', 'asc')->get();
        
        // Hardcoded bank details for now, or fetch from settings if implemented
        $bankDetails = [
            'account_holder' => 'Sonax Digital',
            'bank_name' => 'HDFC Bank',
            'account_number' => '50200012345678',
            'ifsc_code' => 'HDFC0001234',
            'upi_id' => 'sonax@hdfcbank'
        ];

        return view('member.emis.index', compact('emis', 'bankDetails'));
    }

    public function pay(Request $request)
    {
        $emi = Emi::where('id', $request->emi_id)
                  ->where('user_id', Auth::guard('member')->id())
                  ->firstOrFail();

        if ($emi->status == 'approved') {
             return response()->json(['success' => false, 'message' => 'Installment already approved.']);
        }

        $rules = [
            'emi_id' => 'required|exists:emis,id',
        ];

        // Only require screenshot if it's NOT a resit (status is not rejected)
        if ($emi->status != 'rejected' && $emi->status != 'Rejected') {
            $rules['screenshot'] = 'required|image|max:5120';
        } else {
            $rules['screenshot'] = 'nullable|image|max:5120';
        }

        $request->validate($rules);

        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('emi_screenshots', 'public');
            $emi->screenshot = $path;
        }

        $emi->status = 'submitted'; // Status: submitted for verification
        $emi->paid_at = now();
        $emi->save();

        return response()->json(['success' => true, 'message' => 'Payment submitted for verification.']);
    }
}
