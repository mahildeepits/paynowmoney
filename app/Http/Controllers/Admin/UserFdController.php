<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserFd;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserFdController extends Controller
{
    public function index()
    {
        $fds = UserFd::with('user', 'plan')->latest()->paginate(20);
        return view('admin.user_fds.index', compact('fds'));
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,rejected',
            'admin_remarks' => 'nullable|string'
        ]);

        $fd = UserFd::findOrFail($id);

        if ($fd->status != 'pending_approval') {
            return back()->with('error', 'FD is not in pending state.');
        }

        DB::beginTransaction();
        try {
            if ($request->status == 'active') {
                $fd->status = 'active';
                $fd->start_date = now()->format('Y-m-d');
                $fd->maturity_date = now()->addMonths($fd->duration_months)->format('Y-m-d');
                $fd->admin_remarks = $request->admin_remarks;
                $fd->save();
                
                \App\Helpers\RewardHelper::distributeInvestmentLevelIncome($fd->user_id, $fd->amount, 'FD');
                
                $message = 'FD Approved successfully.';
            } else {
                $fd->status = 'rejected';
                $fd->admin_remarks = $request->admin_remarks;
                $fd->save();
                $message = 'FD Rejected successfully.';
            }

            DB::commit();
            return back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
