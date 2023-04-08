<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use App\Models\role\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(['name' => 'required']);
        $data = $request->only(['name']);

        try {            
            if (Role::create($data))
            return redirect(route('roles.index'))->with(['success' => 'Role created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating role!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $region)
    {
        return view('roles.view', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $region)
    {
        return view('roles.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $region)
    {
        // dd($request->all());
        $request->validate(['name' => 'required']);
        $data = $request->only(['name']);

        try {            
            if ($region->update($data))
            return redirect(route('roles.index'))->with(['success' => 'Role updated successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error updating role!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $region)
    {
        try {            
            if ($region->delete())
            return redirect(route('roles.index'))->with(['success' => 'Role deleted successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error deleting role!');
        }
    }
}
