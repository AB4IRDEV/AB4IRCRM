<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission=Permission::get();
        $roles=Role::get();
       
        return view('role-permissions.roles.index', [ 'roles'=> $roles, 'permission'=> $permission] );
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

                'string',
                'unique:roles,name',
                'required'
            ]
            ]);

        Role::create([
            'name'=>$request->name
        ]);

        return redirect('roles')->with('status', 'role created sucessfully');
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
    public function edit(Request $request)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)  // Use singular variable
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],
        ]);
    
        $role->update([
            'name' => $request->name
        ]);
    
        return redirect()->route('roles.index')->with('status', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect('roles')->with('status', 'role deleted successfully!');
    
    }

    public function  addPermissionToRole($roleId){

        $permissions = Permission::get();
        $roles = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id',$roles->id)
                                ->pluck('role_has_permissions.permission_id', 
                                    'role_has_permissions.permission_id')
                            ->all();
        return view('role-permissions.roles.add-permissions', 
        ['roles'=>$roles,
                'permissions'=>$permissions,
                'rolePermissions'=>$rolePermissions
                ]);

    }


    public function givePermissionToRole(Request $request, $roleId )
        {
         
            $request->validate([
                'permission'=>'required']);


            $role=Role::findOrFail($roleId);
            $role->syncPermissions($request->permission);
            
            return redirect('roles')->with('status','permissions assigned successfully');
        }

}
