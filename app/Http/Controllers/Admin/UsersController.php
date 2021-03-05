<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search =  \Request::get('search'); 
        $users = User::where('first_name','like','%'.$search.'%')
                        ->orWhere('last_name','like','%'.$search.'%')
                        ->orWhere('email','like','%'.$search.'%')
                        ->paginate(10);

        return view('Admin.users.index',compact('users','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.users.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string','min:2', 'max:255'],
            'last_name'  => ['required', 'string','min:2', 'max:255'],
            'user_name'  => ['required', 'string','min:5', 'max:255', 'unique:users'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'user_name'  => $request->user_name,
            'email'      => $request->email,
            'role'      => '',
            'password'   => Hash::make($request->password),
            ]);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-user')){
            return $this->index();
        }
        $roles = Role::all();
        return view('Admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

       $request->validate([
            'first_name' => ['required', 'string','min:2', 'max:255'],
            'last_name'  => ['required', 'string','min:2', 'max:255'],
            'user_name'  => ['required', 'string','min:5', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255'],
            ]);


        $user->roles()->sync($request->roles);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;

        if(!empty($request->password)){
          $user->password = Hash::make($request->password);

        }
    
        $user->save();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

        if(Gate::denies('destroy-user')){
            return $this->index();
        }
    }
}
