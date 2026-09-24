<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentRequest;
use App\Models\User;

class PaymentRequestController extends Controller
{
    public function index()
    {
        $requests = PaymentRequest::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.payment_requests.index', compact('requests'));
    }

    public function updateStatus(Request $request, $id)
    {
        $paymentRequest = PaymentRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'remarks' => 'nullable|string'
        ]);

        $paymentRequest->status = $request->status;
        $paymentRequest->remarks = $request->remarks;
        $paymentRequest->save();

        if ($request->status == 'approved') {
            $user = User::where('member_id', $paymentRequest->user_id)->first();
            if ($user) {
                $user->is_paid = 1;
                $user->user_icon = 'userpaid.png';
                $user->save();
            }
        }

        return redirect()->route('admin.payment-requests.index')->with('success', 'Payment request status updated to ' . $request->status);
    }
}
