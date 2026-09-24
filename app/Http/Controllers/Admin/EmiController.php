<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Emi;
use App\Models\User;

class EmiController extends Controller
{
    public function index(Request $request)
    {
        $query = Emi::with('user');

        if ($request->has('search') && $request->search) {
             $search = $request->search;
             $query->whereHas('user', function($q) use($search){
                 $q->where('name', 'like', "%{$search}%")
                   ->orWhere('member_id', 'like', "%{$search}%");
             });
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $emis = $query->latest()->paginate(20);

        return view('admin.emis.index', compact('emis'));
    }

    public function userEmis($userId)
    {
        $user = User::findOrFail($userId);
        $emis = Emi::where('user_id', $userId)->orderBy('id', 'asc')->get();

        return view('admin.emis.user_emis_list', compact('emis', 'user'));
    }

    public function verify(Request $request)
    {
        $request->validate(['id' => 'required|exists:emis,id']);
        
        $emi = Emi::findOrFail($request->id);

        if ($emi->status === 'approved') {
            return response()->json(['success' => false, 'message' => 'EMI already verified']);
        }

        $emi->status = 'approved';
        $emi->approved_at = now();
        $emi->save();
        
        $user = $emi->user;
        // Update User is_paid to 1 if not already
        if ($user && $user->is_paid == 0) {
            $user->update([
                'is_paid' => 1,
                'user_icon' => 'userpaid.png'
            ]);
        }

        // Generate Income for Sponsor
        if ($user && $user->sponsor_id) {
            $sponsor = User::where('member_id', $user->sponsor_id)->first();
            if ($sponsor) {
                // Count how many EMIs are ALREADY approved for this user (including the current one)
                $approvedEmisCount = Emi::where('user_id', $user->id)
                    ->where('status', 'approved')
                    ->count();
                
                $incomeAmount = 0;
                if ($approvedEmisCount == 1) {
                    $incomeAmount = 500;
                } elseif ($approvedEmisCount > 1 && $approvedEmisCount <= 16) {
                    $incomeAmount = 100;
                }

                if ($incomeAmount > 0) {
                    $adminCharge = \App\Models\AdminCharge::first();
                    // $tds = round(($incomeAmount * ($adminCharge->tds_charges ?? 0)) / 100);
                    // $admin_charges = round(($incomeAmount * ($adminCharge->admin_charges ?? 0)) / 100);
                    // $net_amount = $incomeAmount - $tds - $admin_charges;
                    $net_amount = $incomeAmount;
                    \App\Helpers\RewardHelper::addWalletIncome($sponsor, $incomeAmount, 'direct');
                }
            }
        }

        // Generate Level Income
        $this->generateLevelIncome($user);
        \App\Helpers\RewardHelper::distributeEmiRewards($user);
        // Check for First EMI for Popup
        $approvedEmisCountGlobal = Emi::where('user_id', $user->id)->where('status', 'approved')->count();

        return response()->json([
            'success' => true, 
            'message' => 'EMI Verified and Income Generated Successfully',
            'first_emi' => ($approvedEmisCountGlobal == 1),
            'user_name' => $user->name,
            'member_id' => $user->member_id
        ]);
    }

    private function generateLevelIncome($user)
    {
        // Get all level income rules
        $levelRules = \App\Models\LevelIncome::orderBy('level', 'asc')->get();
        if ($levelRules->isEmpty()) {
            return;
        }

        // Start from user's sponsor
        $sponsorId = $user->sponsor_id;
        if (!$sponsorId) {
            return;
        }

        $directSponsor = User::where('member_id', $sponsorId)->first();
        if (!$directSponsor) {
            return;
        }

        // The user says "pehlia user de sponsor da sponsor kd lena hai, jisnu pehly level di income jawegi"
        // So we start checking from the sponsor of the direct sponsor (2nd upline)
        $currentAncestorMemberId = $directSponsor->sponsor_id;
        $monthsJoined = 0;
        if ($user->created_at) {
            $monthsJoined = $user->created_at->diffInMonths(now());
        }
        foreach ($levelRules as $rule) {
            if (!$currentAncestorMemberId) {
                break;
            }

            $ancestor = User::where('member_id', $currentAncestorMemberId)->first();
            if (!$ancestor) {
                break;
            }
            

            if ($monthsJoined <= $rule->months) {
                \App\Helpers\RewardHelper::addWalletIncome($ancestor, $rule->amount, 'level_'. $rule->level);
            }

            // Move to next upline for the next level rule
            $currentAncestorMemberId = $ancestor->sponsor_id;
        }
    }
    
    public function reject(Request $request)
    {
        $request->validate(['id' => 'required|exists:emis,id']);
        
        $emi = Emi::findOrFail($request->id);
        $emi->status = 'rejected'; // Set to rejected (User can still re-upload)
        $emi->save();

        return response()->json(['success' => true, 'message' => 'EMI Rejected. User can upload again.']);
    }
}
