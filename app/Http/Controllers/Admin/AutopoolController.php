<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AutoPoolDataTable;
use App\Http\Controllers\Controller;
use App\Models\AutoPool;
use Illuminate\Http\Request;

class AutopoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AutoPoolDataTable $dataTable)
    {
        return $dataTable->render('admin.auto-pool.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.auto-pool.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'count_4' => 'required',
            'count_16' => 'required',
            'count_64' => 'required',
            'count_256' => 'required',
            'count_1024' => 'required',
            'count_4096' => 'required',
            'count_16384' => 'required',
        ]);
        $data = $request->only('name','count_4','count_16','count_64','count_256','count_1024','count_4096','count_16384');
        try {
            $autopool = AutoPool::create($data);
            if($autopool){
                \Session::flash('success', 'Success|Autopool successfully created');
                return redirect()->route('auto-pool.index');
            }
        } catch (\Throwable $th) {
            \Session::flash('error', 'Error|'.$th->getMessage());
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
        $autopool = AutoPool::findOrFail(decrypt($id));
        return view('admin.auto-pool.form',compact('autopool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'count_4' => 'required',
            'count_16' => 'required',
            'count_64' => 'required',
            'count_256' => 'required',
            'count_1024' => 'required',
            'count_4096' => 'required',
            'count_16384' => 'required',
        ]);
        $data = $request->only('name','count_4','count_16','count_64','count_256','count_1024','count_4096','count_16384');
        $autopool = AutoPool::findOrFail($id);
        try {
            if($autopool->update($data)){
                \Session::flash('success', 'Success|Autopool successfully created');
                return redirect()->route('auto-pool.index');
            }
            throw new \Exception("Error Processing Request", 1);
            
        } catch (\Throwable $th) {
            \Session::flash('error', 'Error|'.$th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $autopool = AutoPool::findOrFail(decrypt($id));
        $autopool->delete();
        return ['status' => true,'message' => 'Record deleted successfully','code' => 200];
    }
}
