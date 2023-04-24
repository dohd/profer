<?php

namespace App\Http\Controllers\user_profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\user_profile\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_profiles = UserProfile::get();

        return view('user_profiles.index', compact('user_profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_profiles.create');
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
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'country' => 'required',
        ]);
        $data = $request->only(['name', 'role', 'phone', 'email', 'address', 'country']);

        DB::beginTransaction();

        try {            
            User::create($data);

            return redirect(route('donors.index'))->with(['success' => 'Donor created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating donor!', $th);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display active user profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active_profile()
    {
        return view('user_profiles.active_profile');
    }
}
