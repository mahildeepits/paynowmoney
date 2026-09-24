<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanType;

class LoanTypeController extends Controller
{
    public function index()
    {
        $loanTypes = LoanType::orderBy('id', 'desc')->get();
        // Return view (Assuming an admin.loan_types.index view will be created)
        // return view('admin.loan_types.index', compact('loanTypes'));
        
        // For now, if views aren't built, we can just return a basic response or we assume standard setup.
        // The prompt says "admin vich ik master banega". Let's provide standard resource methods.
        return view('admin.loan_types.index', compact('loanTypes'));
    }

    public function create()
    {
        return view('admin.loan_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'loan_amount' => 'required|numeric|min:0',
            'emi_amount' => 'required|numeric|min:0',
            'total_emis' => 'required|integer|min:1',
            'required_direct_users' => 'required|integer|min:0',
        ]);

        $payable_amount = $request->emi_amount * $request->total_emis;

        LoanType::create([
            'name' => $request->name,
            'loan_amount' => $request->loan_amount,
            'emi_amount' => $request->emi_amount,
            'total_emis' => $request->total_emis,
            'payable_amount' => $payable_amount,
            'required_direct_users' => $request->required_direct_users,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.loan_types.index')->with('success', 'Loan Type created successfully.');
    }

    public function edit(LoanType $loanType)
    {
        return view('admin.loan_types.edit', compact('loanType'));
    }

    public function update(Request $request, LoanType $loanType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'loan_amount' => 'required|numeric|min:0',
            'emi_amount' => 'required|numeric|min:0',
            'total_emis' => 'required|integer|min:1',
            'required_direct_users' => 'required|integer|min:0',
        ]);

        $payable_amount = $request->emi_amount * $request->total_emis;

        $loanType->update([
            'name' => $request->name,
            'loan_amount' => $request->loan_amount,
            'emi_amount' => $request->emi_amount,
            'total_emis' => $request->total_emis,
            'payable_amount' => $payable_amount,
            'required_direct_users' => $request->required_direct_users,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.loan_types.index')->with('success', 'Loan Type updated successfully.');
    }

    public function destroy(LoanType $loanType)
    {
        $loanType->delete();
        return redirect()->route('admin.loan_types.index')->with('success', 'Loan Type deleted successfully.');
    }
}
