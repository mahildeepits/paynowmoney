<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LevelIncomeDataTable;
use App\Http\Controllers\Controller;
use App\Models\LevelIncome;
use Illuminate\Http\Request;

class LevelIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LevelIncomeDataTable $dataTable)
    {
        return $dataTable->render('admin.level-income.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.level-income.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|numeric|unique:level_incomes,level',
            'amount' => 'required|numeric',
            'months' => 'required|numeric',
        ]);

        try {
            $data = $request->only('level', 'amount', 'months');
            $levelIncome = LevelIncome::create($data);
            if ($levelIncome) {
                if ($request->ajax()) {
                    return response()->json(['status' => true, 'message' => 'Level income created successfully']);
                }
                \Session::flash('success', 'Success|Level income successfully created');
                return redirect()->route('level-income.index');
            }
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $th->getMessage()]);
            }
            \Session::flash('error', 'Error|' . $th->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $levelIncome = LevelIncome::findOrFail(decrypt($id));
        return view('admin.level-income.form', compact('levelIncome'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level' => 'required|numeric|unique:level_incomes,level,' . $id,
            'amount' => 'required|numeric',
            'months' => 'required|numeric',
        ]);

        try {
            $data = $request->only('level', 'amount', 'months');
            $levelIncome = LevelIncome::findOrFail($id);
            if ($levelIncome->update($data)) {
                if ($request->ajax()) {
                    return response()->json(['status' => true, 'message' => 'Level income updated successfully']);
                }
                \Session::flash('success', 'Success|Level income successfully updated');
                return redirect()->route('level-income.index');
            }
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $th->getMessage()]);
            }
            \Session::flash('error', 'Error|' . $th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $levelIncome = LevelIncome::findOrFail(decrypt($id));
            $levelIncome->delete();
            return ['status' => true, 'message' => 'Record deleted successfully', 'code' => 200];
        } catch (\Throwable $th) {
            return ['status' => false, 'message' => $th->getMessage(), 'code' => 500];
        }
    }
}
