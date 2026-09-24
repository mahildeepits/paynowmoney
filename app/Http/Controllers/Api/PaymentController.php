<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentRequest;
use App\Models\AdminCharge;

class PaymentController extends Controller
{
    public function getPaymentDetails(Request $request)
    {
        $adminSettings = AdminCharge::first();
        $activationFee = $adminSettings ? $adminSettings->activation_fee : 2500;
        
        $paymentMethods = PaymentMethod::where('is_active', 1)->get()->map(function($method) {
            if ($method->qr_image) {
                $method->qr_image = asset('storage/payment_qrs/' . $method->qr_image);
            }
            return $method;
        });

        return response()->json([
            'status' => true,
            'message' => 'Payment details fetched successfully',
            'data' => [
                'activation_fee' => $activationFee,
                'payment_methods' => $paymentMethods
            ]
        ], 200);
    }

    public function submitPaymentRequest(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_id' => 'required|string',
            'receipt_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = auth()->user();

        if ($user->is_paid == 1) {
            return response()->json([
                'status' => false,
                'message' => 'Your account is already active.',
                'data' => null
            ], 400);
        }

        $existingRequest = PaymentRequest::where('user_id', $user->member_id)->where('status', 'pending')->first();
        if ($existingRequest) {
            return response()->json([
                'status' => false,
                'message' => 'You already have a pending payment request. Please wait for admin approval.',
                'data' => null
            ], 400);
        }

        $paymentRequest = new PaymentRequest();
        $paymentRequest->user_id = $user->member_id;
        $paymentRequest->amount = $request->amount;
        $paymentRequest->transaction_id = $request->transaction_id;
        $paymentRequest->status = 'pending';

        if ($request->hasFile('receipt_image')) {
            $originalName = $request->receipt_image->getClientOriginalName();
            $sanitizedName = preg_replace('/[^A-Za-z0-9\-.]/', '_', $originalName);
            $imageName = time() . '_' . $sanitizedName;
            $request->receipt_image->storeAs('public/payment_receipts', $imageName);
            $paymentRequest->receipt_image = $imageName;
        }

        $paymentRequest->save();

        return response()->json([
            'status' => true,
            'message' => 'Payment request submitted successfully. Please wait for admin approval.',
            'data' => null
        ], 200);
    }
}
