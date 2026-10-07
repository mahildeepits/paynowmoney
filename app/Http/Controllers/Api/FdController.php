<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FdMaster;
use App\Models\UserFd;
use Illuminate\Support\Facades\Validator;

class FdController extends Controller
{
    public function index()
    {
        $fds = FdMaster::with('details')->where('status', 1)->latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'FD Plans fetched successfully',
            'data' => $fds
        ], 200);
    }
    
    public function checkEligibility(Request $request)
    {
        $user = $request->user();

        if ($user->is_blocked || $user->is_paid != 1) {
            return response()->json([
                'status' => false,
                'message' => 'Action Required: Please activate your account first to explore and invest in FD plans.'
            ], 403);
        }

        if (!$user->isKycApproved()) {
            return response()->json([
                'status' => false,
                'message' => 'KYC Pending: Please complete your KYC verification and wait for approval to start your FD investment.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'User is eligible for FD application.',
        ], 200);
    }

    public function apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:fd_masters,id',
            'amount' => 'required|numeric',
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
                'message' => 'You are not eligible to apply for FD.'
            ], 403);
        }

        $screenshotPath = null;
        if ($request->hasFile('payment_screenshot')) {
            $file = $request->file('payment_screenshot');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/fd_screenshots'), $filename);
            $screenshotPath = 'uploads/fd_screenshots/' . $filename;
        }

        $userFd = UserFd::create([
            'user_id' => $user->id,
            'fd_master_id' => $request->plan_id,
            'amount' => $request->amount,
            'duration_months' => $request->duration,
            'total_expected_return' => $request->total_expected_return,
            'status' => 'pending_approval',
            'payment_screenshot' => $screenshotPath,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'FD Application submitted successfully. Awaiting admin approval.',
            'data' => $userFd
        ], 200);
    }

    public function myFds(Request $request)
    {
        $user = $request->user();
        $fds = UserFd::with('plan')->where('user_id', $user->id)->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'My FDs fetched successfully',
            'data' => $fds
        ], 200);
    }
}
