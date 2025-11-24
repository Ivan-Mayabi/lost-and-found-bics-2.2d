<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\IdReplacement;
use App\Models\Role;
use App\Models\User;
use App\Rules\TwoNames;
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
     * Show the registration form
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:50',new TwoNames()],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // Optionally assign a default role, e.g. Regular
        $user->role_id = Role::where('type', 'Regular User')->value('id');
        $user->save();

    // Do not log in the user automatically. Redirect to login page with success message.
    return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
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
    // Assign role from request or default to 'Regular' if not provided
    $roleId = $request->get('role') ?? Role::where('type', 'Regular')->value('id');
    $user->role_id = $roleId;
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
    // public function authenticate(Request $request){
    //     // Validate the email and the name
    //     // Attempt the authentication
    //     request()->validate([
    //         'email'=>['required','email'],
    //         'password' => ['required']
    //     ]);

    //     // Get the email and the password
    //     $credentials = $request->only(['email','password']);

    //     // Try to  and if it works go to the previous intended page
    //     if(Auth::attempt($credentials)){
    //         return redirect()->intended('/users');
    //     }
    //     else{
    //         return redirect()->route('login')->withErrors('general','Could not Log In, Wrong Username or Password');
    //     }
    // }

    public function authenticate(Request $request){
    request()->validate([
        'email'=>['required','email'],
        'password' => ['required']
    ]);

    $credentials = $request->only(['email','password']);
    $credentials['active'] = 1; // Only allow active users to log in

    if (Auth::attempt($credentials)) {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->isManager()) {
            return redirect()->route('lfm.dashboard'); // send managers to their dashboard
        } else if ($user->isAdmin()) {
            return redirect()->route('users.index'); // admin goes to users page
        } else if ($user->isApprover()) {
            return redirect()->route('users.request-id-replacement'); // approver goes to approvals page
        } else {
            return redirect()->route('user.lost-items.index'); // regular user
        }
    } else {
        // Check if user exists but is inactive
        $user = User::where('email', $request->email)->first();
        if ($user && $user->active != 1) {
            return redirect()->route('login')->withErrors(['general' => 'Your account is not active. You are not allowed to log in.']);
        }
        return redirect()->route('login')->withErrors(['general' => 'Could not Log In, Wrong Username or Password']);
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

    public function approve_id_replacement(IdReplacement $replacement_id){
        //replacement_id approval logic
        $replacement_id->approved = 1;
        $replacement_id->save();
        return redirect()->back()->with('success','ID Replacement Approved Successfully');
    }

    public function reject_id_replacement(IdReplacement $replacement_id){
        //replacement_id rejection logic
        $replacement_id->approved = 0;
        $replacement_id->save();
        return redirect()->back()->with('success','ID Replacement Rejected Successfully');
    }
}
