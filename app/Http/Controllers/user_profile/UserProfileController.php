<?php

namespace App\Http\Controllers\user_profile;

use App\Http\Controllers\Controller;
use App\Models\role\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotNull('created_by')->get();

        return view('user_profiles.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('user_profiles.create', compact('roles'));
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
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'phone' => 'required',
            'email' => 'required|unique:users,username',
            'role_id' => 'required',
        ]);

        DB::beginTransaction();

        try {            
            $input = array_replace($request->except('_token'), [
                'password' => $request->phone,
                'created_by' => auth()->user()->id,
                'ins' => auth()->user()->ins,
            ]);
            $user = User::create($input);
            $role = Role::find($input['role_id']);
            $user->assignRole($role->name);

            DB::commit();
            return redirect(route('user_profiles.index'))->with(['success' => 'User created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating user!', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user_profile)
    {
        return view('user_profiles.view', compact('user_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_profile)
    {
        $roles = Role::get();
        return view('user_profiles.edit', compact('user_profile', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user_profile)
    {
        if ($request->status != null) {
            try {
                $user_profile->update(['is_active' => $request->input('status')]);
                return redirect()->back()->with('success', 'Status updated successfully');
            } catch (\Throwable $th) {
                return errorHandler('Error updating status!', $th);
            }
        } else {
            $request->validate([
                'name' => 'required',
                'username' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'role_id' => 'required',
            ]);
    
            DB::beginTransaction();
    
            try {            
                
                $input = $request->only(['name', 'username', 'phone', 'email', 'role_id']);
                $role = Role::find($input['role_id']);
                $user_profile->syncRoles([$role->name]);
                $user_profile->update($input);
                
                DB::commit();
                return redirect(route('user_profiles.index'))->with(['success' => 'User updated successfully']);
            } catch (\Throwable $th) {
                return errorHandler('Error updating User!', $th);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user_profile)
    {
        try {     
            $role = Role::find($user_profile->role_id);
            $user_profile->removeRole($role->name);       
            $user_profile->delete();

            return redirect(route('user_profiles.index'))->with(['success' => 'User deleted successfully']);
        } catch (\Throwable $th) { 
            return errorHandler('Error deleting User!', $th);
        }
    }

    /**
     * Display active user profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active_profile()
    {
        $user_profile = auth()->user();

        return view('user_profiles.active_profile', compact('user_profile'));
    }
}
