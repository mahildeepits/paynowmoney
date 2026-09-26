<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLoan;
use App\Models\Emi;
use Carbon\Carbon;

class UserLoanController extends Controller
{
    public function index(Request $request)
    {
        $query = UserLoan::with(['user', 'loanType']);
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $userLoans = $query->orderBy('id', 'desc')->paginate(20);

        return view('admin.user_loans.index', compact('userLoans'));
    }

    public function approve(Request $request, $id)
    {
        $userLoan = UserLoan::with('loanType')->findOrFail($id);
        
        if ($userLoan->status !== 'pending') {
            return redirect()->back()->with('error', 'Loan is not in pending status.');
        }

        $userLoan->status = 'approved';
        $userLoan->approved_at = now();
        $userLoan->save();

        // Generate EMIs automatically
        $loanType = $userLoan->loanType;
        $totalEmis = $loanType->total_emis;
        $emiAmount = $loanType->emi_amount;

        $dueDate = Carbon::now()->addMonth(); // First EMI due next month

        for ($i = 1; $i <= $totalEmis; $i++) {
            Emi::create([
                'user_id' => $userLoan->user_id,
                'user_loan_id' => $userLoan->id,
                'emi_number' => $i,
                'amount' => $emiAmount,
                'due_date' => $dueDate->format('Y-m-d'),
                'month' => $dueDate->format('F Y'), // e.g. "October 2026"
                'status' => 'pending',
            ]);
            $dueDate->addMonth(); // Increment by 1 month for next EMI
        }

        // Change status to active after generating EMIs
        $userLoan->status = 'active';
        $userLoan->save();

        return redirect()->back()->with('success', 'Loan approved and EMIs generated successfully.');
    }

    public function reject(Request $request, $id)
    {
        $userLoan = UserLoan::findOrFail($id);
        
        if ($userLoan->status !== 'pending') {
            return redirect()->back()->with('error', 'Loan is not in pending status.');
        }

        $userLoan->status = 'rejected';
        if ($request->has('rejection_reason')) {
            $userLoan->rejection_reason = $request->rejection_reason;
        }
        $userLoan->save();

        return redirect()->back()->with('success', 'Loan request rejected.');
    }
}
