<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\RolesDataTable;
use App\Models\Role;
use App\Models\User;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'level' => 'required|unique:roles,level',
        ]);
        try {
            $role = Role::create([
                'name' => $request->name,
                'level' => $request->level
            ]);
            if($role){
                return ['status' => true,'message' => 'Role Saved success fully'];
            }
        } catch (\Throwable $th) {
            return ['status' => false,'message' => $th->getMessage()];
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
        $role = Role::find($id);
        return view('admin.roles.form',compact('role','id'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'level' => 'required|unique:roles,level,'.$id,
        ]);
        try {
            $role = Role::find($id);
            if($role == null){
                return ['status' => false,'message' => 'Role Not Found'];
            }
            $data = $request->only('name','level');
            if($role->update($data)){
                return ['status' => true,'message' => 'Role Saved success fully'];
            }
            throw new Exception("Error Processing Request", 1);

        } catch (\Throwable $th) {
            return ['status' => false,'message' => $th->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteRole($id){
        $role = Role::find($id);
        if($role->delete()){
            return ['status' => true,'message' => 'Role Saved success fully'];
        }
        return ['status' => false,'message' => $th->getMessage()];
    }
}
