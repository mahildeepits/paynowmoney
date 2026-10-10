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
        
        $activation_deposit = $this->getActivationDeposit($user);
        
        return response()->json([
            'status' => true,
            'message' => 'Dashboard Summary',
            'data' => [
                'user' => $user,
                'activation_deposit' => $activation_deposit,
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
        
        $walletHistory = WalletTransaction::where('user_id', $user->member_id)
                            ->orderBy('id', 'desc')->get()
                            ->map(function ($item) {
                                return [
                                    'id' => 'wt_' . $item->id,
                                    'keyword' => $item->keyword,
                                    'slug' => $item->slug,
                                    'created_at' => $item->created_at,
                                    'amount' => $item->amount,
                                ];
                            })->toArray();

        $paymentRequests = \App\Models\PaymentRequest::where('user_id', $user->member_id)
                            ->orderBy('id', 'desc')->get()
                            ->map(function ($pr) {
                                return [
                                    'id' => 'pr_' . $pr->id,
                                    'keyword' => 'payment_request_' . strtolower($pr->status),
                                    'slug' => 'Activation Deposit (' . ucfirst($pr->status) . ')',
                                    'created_at' => $pr->created_at,
                                    'amount' => $pr->amount,
                                ];
                            })->toArray();
                            
        $history = collect(array_merge($walletHistory, $paymentRequests))->sortByDesc('created_at')->values()->all();
        
        $locked_amount = $this->getActivationDeposit($user);
        $available_balance = $user->walletIncomesByKey('totalIncome');
        $total_balance = $available_balance + $locked_amount;

        return response()->json([
            'status' => true,
            'data' => [
                'total_balance' => $total_balance,
                'available_balance' => $available_balance,
                'locked_amount' => $locked_amount,
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

    private function getActivationDeposit($user)
    {
        $activation_deposit = \App\Models\PaymentRequest::where('user_id', $user->member_id)
            ->where('status', 'approved')
            ->sum('amount');
            
        if ($activation_deposit == 0 && $user->is_paid == 1) {
            $latestKit = $user->latestJoiningKit;
            if ($latestKit) {
                $activation_deposit = $latestKit->amount;
            } elseif ($user->used_pin_rel && $user->used_pin_rel->joining_kit_rel) {
                $activation_deposit = $user->used_pin_rel->joining_kit_rel->amount;
            }
        }
        
        return $activation_deposit;
    }
}
