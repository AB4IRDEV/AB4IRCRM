<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::get();
        $iroles=Role::pluck('name','name')->all();
        $users=User::get();
        return view('role-permissions.user.index', ['users'=>$users, 'roles'=>$roles, 'iroles'=>$iroles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|string|max:255',
            "email" => 'required|email|max:255|unique:users,email',
            "password" => 'required|string|min:8|confirmed',
            "roles" => 'required',
        ]);

        $user =User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $user->syncRoles($request->roles);

        return redirect('/user')->with('status', 'user created successfully');
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
    public function edit(User $user)
    {
       $user;
      
       $iroles=Role::pluck('name','name')->all();
       $userRoles=$user->roles->pluck('name','name')->all();   
        return view('role-permissions.user.edit-user', ['iroles' =>$iroles, 'user'=> $user, 'userRoles'=>$userRoles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,User $user)
    {
        $request->validate([

            'name'=>'required|string|max:255',
            'email'=>'nullable|email|max:255|',
            'password'=>'nullable|string|min:8|max:255',
            'roles' => 'required',
        ]);

        $data=[
            'name'=> $request->name,
            'email' =>$request->email,
            'password'=>Hash::make($request->password),
        ];

        if(!empty($request->password))
        
            {
                $data +=[
                'password'=>Hash::make($request->password),
                ];
            }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/user')->with('status', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        
        $user->delete();
        return redirect('/user')->with('status', 'User deleted successfully');
    }
}
