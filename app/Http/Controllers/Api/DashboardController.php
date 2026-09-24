<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use App\Models\UserWallet;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboardSummary(Request $request)
    {
        $user = $request->user();
        
        return response()->json([
            'status' => true,
            'message' => 'Dashboard Summary',
            'data' => [
                'total_balance' => $user->walletIncomesByKey('totalIncome'),
                'active_loan' => \App\Models\Emi::where('user_id', $user->id)->where('status', 'unpaid')->sum('amount'),
                'total_income' => $user->walletIncomesByKey('total'),
                'total_withdrawals' => $user->walletIncomesByKey('withdrawls'),
                'recent_transactions' => WalletTransaction::where('user_id', $user->member_id)
                                        ->orderBy('id', 'desc')
                                        ->take(5)
                                        ->get()
            ]
        ]);
    }

    public function transactions(Request $request)
    {
        $user = $request->user();
        $transactions = WalletTransaction::where('user_id', $user->member_id)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $transactions
        ]);
    }

    public function wallet(Request $request)
    {
        $user = $request->user();
        
        $history = WalletTransaction::where('user_id', $user->member_id)->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => [
                'total_balance' => $user->walletIncomesByKey('totalIncome'),
                'available_balance' => $user->walletIncomesByKey('totalIncome'),
                'locked_amount' => 0,
                'history' => $history
            ]
        ]);
    }

    public function team(Request $request)
    {
        $user = $request->user();
        $team = User::where('sponsor_id', $user->member_id)
                    ->select('id', 'member_id', 'name', 'sponsor_id', 'created_at')
                    ->get();

        return response()->json([
            'status' => true,
            'data' => $team
        ]);
    }

    public function tree(Request $request)
    {
        $user = $request->user();
        
        $tree = $this->buildTree($user->member_id);

        return response()->json([
            'status' => true,
            'data' => $tree
        ]);
    }

    private function buildTree($memberId)
    {
        $user = User::where('member_id', $memberId)->select('id', 'member_id', 'name', 'left_child_id', 'right_child_id')->first();
        
        if (!$user) return null;

        $left = null;
        $right = null;

        if ($user->left_child_id) {
            $leftChildUser = User::find($user->left_child_id);
            if ($leftChildUser) {
                $left = $this->buildTree($leftChildUser->member_id);
            }
        }

        if ($user->right_child_id) {
            $rightChildUser = User::find($user->right_child_id);
            if ($rightChildUser) {
                $right = $this->buildTree($rightChildUser->member_id);
            }
        }

        return [
            'id' => $user->id,
            'member_id' => $user->member_id,
            'name' => $user->name,
            'left' => $left,
            'right' => $right
        ];
    }
}
