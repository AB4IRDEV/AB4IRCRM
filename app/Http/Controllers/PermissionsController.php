<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::get();
        return view('role-permissions.permission.index', ['permissions'=> $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name'=>[
                'required',
                'unique:permissions,name',
                'string'
            ]
            ]);

        Permission::create([

            'name'=>$request->name

        ]);

        return redirect('permissions')->with('status', 'permission-saved');

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
    public function edit(Permission $permission)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'=>[
                'string',
                'unique:permissions,name',
                'required'
            ]
            ]);
            
            $permission->update([
                'name'=> $request->name
            ]);

            return redirect('permissions')->with('status', 'permission-saved');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect('permissions')->with('status', 'Permission deleted successfully!');
    
    }
}
