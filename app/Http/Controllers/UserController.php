<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email= $request->get('email');
        $user->role_id= $request->get('role');
        $user->password = Hash::make('password');
        $user->save();
        return redirect()->route('users.index')->with('success','User Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email= $request->get('email');
        $user->role_id= $request->get('role');
        $user->password = Hash::make('password');
        $user->save();
        return redirect()->route('users.index')->with('success','User Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return redirect()->route('users.index')->with('success','User Deleted Successfully');
        }catch(QueryException $e){
            Log::error($e);
            return redirect()->route('users.index')->with('error','Cannot delete Users who have items claimed');
        }
    }
    /**
     * Update the user password
     */
    public function reset_password(User $user){
        $user->password = Hash::make(env('DEFAULT_PASSWORD','password'));
        $user->save();
        return redirect()->route('users.index')->with('success','Password Reset Successfully');
    }
    /**
     * Make a user inactive
     */
    public function deactivate(User $user){
        if($user->active==1){
            $user->active = 0;
        }
        else if($user->active==0){
            $user->active = 1;
        }
        $user->save();
        return redirect()->route('users.index')->with('success','User Status Changed Successfully.');
    }
}
