<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserRd;
use App\Models\UserRdEmi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRdController extends Controller
{
    public function index()
    {
        // For admin panel view
        $rds = UserRd::with('user', 'plan')->latest()->paginate(20);
        return view('admin.user_rds.index', compact('rds')); // We will need to create this view later
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,rejected',
            'admin_remarks' => 'nullable|string'
        ]);

        $rd = UserRd::findOrFail($id);

        if ($rd->status != 'pending_approval') {
            return back()->with('error', 'RD is not in pending state.');
        }

        DB::beginTransaction();
        try {
            if ($request->status == 'active') {
                $rd->status = 'active';
                $rd->start_date = now()->format('Y-m-d');
                $rd->maturity_date = now()->addMonths($rd->duration_months)->format('Y-m-d');
                $rd->admin_remarks = $request->admin_remarks;
                $rd->save();

                $setting = DB::table('settings')->where('key', 'payable_monthly_emi_date')->first();
                $payableDay = $setting ? (int) $setting->value : 5;

                for ($i = 1; $i <= $rd->duration_months; $i++) {
                    $dueDate = Carbon::now()->addMonths($i - 1)->day($payableDay)->format('Y-m-d');
                    
                    $status = ($i == 1) ? 'paid' : 'pending';
                    $paymentDate = ($i == 1) ? now()->format('Y-m-d') : null;

                    UserRdEmi::create([
                        'user_rd_id' => $rd->id,
                        'user_id' => $rd->user_id,
                        'installment_number' => $i,
                        'amount' => $rd->monthly_deposit,
                        'due_date' => $dueDate,
                        'status' => $status,
                        'payment_date' => $paymentDate,
                        'payment_method' => ($i == 1) ? $rd->payment_method : null,
                        'transaction_id' => ($i == 1) ? $rd->transaction_id : null,
                        'payment_screenshot' => ($i == 1) ? $rd->payment_screenshot : null,
                    ]);
                }
                $message = 'RD Approved and EMIs generated successfully.';
            } else {
                $rd->status = 'rejected';
                $rd->admin_remarks = $request->admin_remarks;
                $rd->save();
                $message = 'RD Rejected successfully.';
            }

            DB::commit();
            return back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
