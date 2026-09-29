<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RdMaster;

class RdController extends Controller
{
    public function index()
    {
        $rds = RdMaster::with('details')->where('status', 1)->latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'RD Plans fetched successfully',
            'data' => $rds
        ], 200);
    }
    
    public function checkEligibility(Request $request)
    {
        $user = $request->user();

        if ($user->is_blocked || $user->is_paid != 1) {
            return response()->json([
                'status' => false,
                'message' => 'Action Required: Please activate your account first to explore and invest in RD plans.'
            ], 403);
        }

        if (!$user->isKycApproved()) {
            return response()->json([
                'status' => false,
                'message' => 'KYC Pending: Please complete your KYC verification and wait for approval to start your RD investment.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'User is eligible for RD application.',
        ], 200);
    }

    public function apply(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'plan_id' => 'required|exists:rd_masters,id',
            'monthly_deposit' => 'required|numeric',
            'duration' => 'required|integer',
            'total_expected_return' => 'required|numeric',
            'payment_method' => 'required|string',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'transaction_id' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        if ($user->is_blocked || $user->is_paid != 1 || !$user->isKycApproved()) {
             return response()->json([
                'status' => false,
                'message' => 'You are not eligible to apply for RD.'
            ], 403);
        }

        $screenshotPath = null;
        if ($request->hasFile('payment_screenshot')) {
            $file = $request->file('payment_screenshot');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/rd_screenshots'), $filename);
            $screenshotPath = 'uploads/rd_screenshots/' . $filename;
        }

        $userRd = \App\Models\UserRd::create([
            'user_id' => $user->id,
            'rd_master_id' => $request->plan_id,
            'monthly_deposit' => $request->monthly_deposit,
            'duration_months' => $request->duration,
            'total_expected_return' => $request->total_expected_return,
            'status' => 'pending_approval',
            'payment_screenshot' => $screenshotPath,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'RD Application submitted successfully. Awaiting admin approval.',
            'data' => $userRd
        ], 200);
    }

    public function myRds(Request $request)
    {
        $user = $request->user();
        $rds = \App\Models\UserRd::with(['plan', 'emis'])->where('user_id', $user->id)->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'My RDs fetched successfully',
            'data' => $rds
        ], 200);
    }
}
