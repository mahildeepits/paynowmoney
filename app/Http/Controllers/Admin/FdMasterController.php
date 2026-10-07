<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FdMaster;
use App\Models\FdDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FdMasterController extends Controller
{
    public function index()
    {
        $fds = FdMaster::with('details')->latest()->get();
        return view('admin.fds.index', compact('fds'));
    }

    public function create()
    {
        return view('admin.fds.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'amount' => 'required|array|min:1',
            'amount.*' => 'required|numeric|min:0',
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|min:1',
            'return_percentage' => 'required|array|min:1',
            'return_percentage.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $fdMaster = FdMaster::create([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            foreach ($request->amount as $key => $amount) {
                FdDetail::create([
                    'fd_master_id' => $fdMaster->id,
                    'amount' => $amount,
                    'months' => $request->months[$key],
                    'return_percentage' => $request->return_percentage[$key],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.fds.index')->with('success', 'FD Plan created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function edit(FdMaster $fd)
    {
        $fd->load('details');
        return view('admin.fds.edit', compact('fd'));
    }

    public function update(Request $request, FdMaster $fd)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'amount' => 'required|array|min:1',
            'amount.*' => 'required|numeric|min:0',
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|min:1',
            'return_percentage' => 'required|array|min:1',
            'return_percentage.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $fd->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            $fd->details()->delete();

            foreach ($request->amount as $key => $amount) {
                FdDetail::create([
                    'fd_master_id' => $fd->id,
                    'amount' => $amount,
                    'months' => $request->months[$key],
                    'return_percentage' => $request->return_percentage[$key],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.fds.index')->with('success', 'FD Plan updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function destroy(FdMaster $fd)
    {
        try {
            $fd->delete();
            return redirect()->route('admin.fds.index')->with('success', 'FD Plan deleted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
