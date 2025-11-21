<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\IdReplacement;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(env('DEFAULT_PAGINATE_NUMBER',10));
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Authorise that it can be done
        $this->authorize('create',User::class);

        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Authorise that it can be done
        $this->authorize('create',User::class);

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
        // Authorise that it can be done
        $this->authorize('update',User::class);
        
        $roles = Role::all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Authorise that it can be done
        $this->authorize('update',User::class);

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
        // Authorise that it can be done
        $this->authorize('delete',[Auth::user(),User::class]);

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

    /**
     * Show the login page
     */
    public function login(){
        // Return the logoin view
        return view('auth.login');
    }


    /**
     * Authenticate the user
     */
    public function authenticate(Request $request){
        // Validate the email and the name
        // Attempt the authentication
        request()->validate([
            'email'=>['required','email'],
            'password' => ['required']
        ]);

        // Get the email and the password
        $credentials = $request->only(['email','password']);

        // Try to  and if it works go to the previous intended page
        if(Auth::attempt($credentials)){
            return redirect()->intended('/users');
        }
        else{
            return redirect()->route('login')->withErrors('general','Could not Log In, Wrong Username or Password');
        }
    }

    /**
     * Logout the user
     */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Show the table for approving ID replacement
     */    
    public function request_id_replacement(User $user){
        $replacements = IdReplacement::all();
        return view('id-approvers.approver',compact('replacements'));
    }

    public function approve_id_replacement(IdReplacement $idReplacement){
        //idReplacement approval logic
        $idReplacement->approved = 1;
        $idReplacement->save();
        return redirect()->back()->with('success','ID Replacement Approved Successfully');
    }

    public function reject_id_replacement(IdReplacement $idReplacement){
        //idReplacement rejection logic
        $idReplacement->approved = 0;
        $idReplacement->save();
        return redirect()->back()->with('success','ID Replacement Rejected Successfully');
    }
}
