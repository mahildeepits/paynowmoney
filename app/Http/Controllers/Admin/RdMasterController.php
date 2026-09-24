<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RdMaster;
use App\Models\RdDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RdMasterController extends Controller
{
    public function index()
    {
        $rds = RdMaster::with('details')->latest()->get();
        return view('admin.rds.index', compact('rds'));
    }

    public function create()
    {
        return view('admin.rds.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'emi_amount' => 'required|array|min:1',
            'emi_amount.*' => 'required|numeric|min:0',
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|min:1',
            'return_percentage' => 'required|array|min:1',
            'return_percentage.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $rdMaster = RdMaster::create([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            foreach ($request->emi_amount as $key => $amount) {
                RdDetail::create([
                    'rd_master_id' => $rdMaster->id,
                    'emi_amount' => $amount,
                    'months' => $request->months[$key],
                    'return_percentage' => $request->return_percentage[$key],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.rds.index')->with('success', 'RD Plan created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function edit(RdMaster $rd)
    {
        $rd->load('details');
        return view('admin.rds.edit', compact('rd'));
    }

    public function update(Request $request, RdMaster $rd)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'emi_amount' => 'required|array|min:1',
            'emi_amount.*' => 'required|numeric|min:0',
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|min:1',
            'return_percentage' => 'required|array|min:1',
            'return_percentage.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $rd->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            $rd->details()->delete();

            foreach ($request->emi_amount as $key => $amount) {
                RdDetail::create([
                    'rd_master_id' => $rd->id,
                    'emi_amount' => $amount,
                    'months' => $request->months[$key],
                    'return_percentage' => $request->return_percentage[$key],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.rds.index')->with('success', 'RD Plan updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function destroy(RdMaster $rd)
    {
        try {
            $rd->delete();
            return redirect()->route('admin.rds.index')->with('success', 'RD Plan deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
