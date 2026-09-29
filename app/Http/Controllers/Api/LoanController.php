<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emi;
use App\Models\LoanType;
use App\Models\UserLoan;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function getPublicLoans()
    {
        $loans = LoanType::where('status', 1)->get();

        return response()->json([
            'status' => true,
            'message' => 'Available Loans',
            'data' => $loans
        ]);
    }

    public function getAvailableLoans(Request $request)
    {
        $user = $request->user();
        
        // Count direct active users
        $directActiveUsersCount = $user->allChildMembers()->where('is_paid', 1)->count();

        $loans = LoanType::where('status', 1)->get()->map(function ($loan) use ($directActiveUsersCount) {
            $loan->is_eligible = $directActiveUsersCount >= $loan->required_direct_users;
            $loan->user_directs_count = $directActiveUsersCount;
            return $loan;
        });

        return response()->json([
            'status' => true,
            'message' => 'Available Loans',
            'data' => $loans
        ]);
    }

    public function requestLoan(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'loan_type_id' => 'required|exists:loan_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        if (!$user->isKycApproved()) {
            return response()->json([
                'status' => false,
                'message' => 'Please complete your KYC to apply for a loan.'
            ], 403);
        }

        $loanType = LoanType::find($request->loan_type_id);

        $directActiveUsersCount = $user->allChildMembers()->where('is_paid', 1)->count();
        if ($directActiveUsersCount < $loanType->required_direct_users) {
            return response()->json([
                'status' => false,
                'message' => 'You do not meet the direct active users requirement for this loan.'
            ], 400);
        }

        // Check if user already requested this loan and it's not completed/rejected
        $existing = UserLoan::where('user_id', $user->id)
            ->where('loan_type_id', $loanType->id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->first();

        if ($existing) {
            return response()->json([
                'status' => false,
                'message' => 'You already have a pending or active loan of this type.'
            ], 400);
        }

        $userLoan = UserLoan::create([
            'user_id' => $user->id,
            'loan_type_id' => $loanType->id,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Loan requested successfully. Please wait for admin approval.',
            'data' => $userLoan
        ]);
    }

    public function getMyLoans(Request $request)
    {
        $user = $request->user();
        $loans = UserLoan::with('loanType')->where('user_id', $user->id)->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'message' => 'My Loans',
            'data' => $loans
        ]);
    }

    public function emis(Request $request)
    {
        $user = $request->user();
        
        $validator = Validator::make($request->all(), [
            'user_loan_id' => 'nullable|exists:user_loans,id',
        ]);

        $query = Emi::with('userLoan.loanType')->where('user_id', $user->id);
        
        if ($request->has('user_loan_id') && $request->user_loan_id) {
            $query->where('user_loan_id', $request->user_loan_id);
        }

        $emis = $query->orderBy('emi_number', 'asc')->get();

        return response()->json([
            'status' => true,
            'message' => 'My EMIs',
            'data' => $emis
        ]);
    }

    public function payEmi(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'emi_id' => 'required|exists:emis,id',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $emi = Emi::where('id', $request->emi_id)->where('user_id', $user->id)->first();
        if (!$emi) {
            return response()->json([
                'status' => false,
                'message' => 'EMI not found or not belongs to you.'
            ], 404);
        }

        if ($emi->status === 'paid' || $emi->status === 'pending_approval') {
            return response()->json([
                'status' => false,
                'message' => 'EMI is already paid or pending approval.'
            ], 400);
        }

        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('emi_screenshots', 'public');
            $emi->screenshot = $path;
        }

        $emi->status = 'pending_approval';
        $emi->save();

        return response()->json([
            'status' => true,
            'message' => 'EMI payment submitted successfully. Waiting for admin approval.',
            'data' => $emi
        ]);
    }
}
