<?php
namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserPayout;
use App\Models\AdminCharge;
use App\Models\Transaction;
use App\Models\WalletOtp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TransactionsService {
    
    public function addTransaction($request) {
        $validator = Validator::make($request->all(),[
            'amount' => 'required|numeric|min:1000',
        ]);
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = authUser();
        
        if ($user->is_paid == 0) {
            return response()->json(['status' => false,'message' => 'Please activate your ID before withdrawal','code' => 400]);
        }
        
        if(!$request->has('withdrawal_pin') || $request->withdrawal_pin == null){
            return response()->json(['status' => false,'message' => 'Withdrawal Pin is required to withdraw','code' => 400]);
        }
        
        if(Hash::check($request->withdrawal_pin, $user->wallet_pin) == false){
            return response()->json(['status' => false,'message' => 'Withdrawal Pin does not match','code' => 400]);
        }

        $transaction = Transaction::where('user_id', $user->id)->where('type', 'withdrawl')->where('status', 'pending')->first();
        if ($transaction != null) {
            return response()->json(['status' => false,'message' => 'Your last withdrawal request is not approved yet!','code' => 400]);
        }
        // check 5 directs
        $directCount = $user->allChildMembers()->where('is_paid',1)->count();
        if ($directCount < 5) {
            return response()->json(['status' => false,'message' => 'You have to sponsor atleat 5 users','code' => 400]);
        }
        $requestAmt = (float)$request->amount;
        $totalBalance = $user->walletIncomesByKey('totalIncome');

        // Check for Reward Income Lock
        $rewardIncomeCredit = $user->reward_income_credit;
        $daysSinceCreation = $user->created_at->diffInDays(now());
        
        if ($daysSinceCreation < 90 && $rewardIncomeCredit > 0) {
            $withdrawableBalance = $totalBalance - $rewardIncomeCredit;
            if ($withdrawableBalance < 0) {
                $withdrawableBalance = 0;
            }

            if ($requestAmt > $withdrawableBalance) {
                return response()->json([
                    'status' => false,
                    'message' => "You can withdrawal only ₹ {$withdrawableBalance}",
                    'code' => 400
                ]);
            }
        }
        
        if($totalBalance < $requestAmt){
            return response()->json(['status' => false,'message' => 'Insufficient Balance','code' => 400]);
        }

        // Apply admin charges/transaction fees
        $adminCharge = AdminCharge::first();
        $feePercentage = ($adminCharge->admin_charges ?? 5) / 100;
        $fees = round($requestAmt * $feePercentage);
        $netAmount = round($requestAmt - $fees);

        $data = [
            'user_id' => $user->id,
            'amount' => $requestAmt,
            'transaction_fees' => $fees,
            'net_amount' => $netAmount,
            'status' => 'pending',
            'type' => 'withdrawl',
            'wallet_address' => $request->wallet_address ?? 'Bank/UPI',
        ];

        DB::beginTransaction();
        try {
            // Create UserPayout record for the withdrawal
            UserPayout::create([
                'user_id'       => $user->id,
                'income_type'   => 'withdrawal',
                'amount'        => $requestAmt,
                'tds'           => 0,
                'admin_charges' => $fees,
                'net_amount'    => $netAmount,
                'status'        => 'pending',
                'is_requested'  => now(),
            ]);

            $transaction = Transaction::create($data);

            // Create WalletTransaction to deduct amount from wallet
            \App\Models\WalletTransaction::create([
                'user_id' => $user->member_id,
                'keyword' => 'withdrawal',
                'amount' => $requestAmt,
                'admin_charges' => $fees,
                'net_amount' => $netAmount,
                'status' => 0, // 0 for pending withdrawal
                'transaction_id' => $transaction->id,
            ]);
            
            DB::commit();
            return response()->json(['status' => true,'message' => 'Withdrawal request submitted successfully','refresh' => true,'code' => 200], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => false,'message' => $th->getMessage(),'code' => 400]);
        }
    }

    public function setTransactionPin($request) {
        $validator = Validator::make($request->all(),[
            'current_password' => 'required',
            'wallet_pin' => 'required|digits:4',
            'confirm_pin' => 'required|same:wallet_pin',
        ]);
        
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors() ], 422);
        }

        $user = authUser();
        if(!Hash::check($request->current_password, $user->password)){
            return response()->json(['status' => false,'message' => 'Incorrect Login Password','code' => 400]);
        }

        try {
            if($user->update(['wallet_pin' => Hash::make($request->wallet_pin)])){
                return response()->json(['status' => true,'message' => 'Withdrawal Pin set successfully','refresh' => true,'code' => 200], 200);
            }
            throw new \Exception("Error Processing Request", 1);
        } catch (\Throwable $th) {
            return response()->json(['status' => false,'message' => $th->getMessage(),'code' => 400]);
        }
    }
}
