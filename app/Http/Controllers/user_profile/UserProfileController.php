<?php

namespace App\Http\Controllers\user_profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\user_profile\UserProfile;
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
        $user_profiles = UserProfile::where('rel_id', '!=', auth()->user()->id)->latest()->get();

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
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'country' => 'required',
        ]);
        $data = $request->only(['fname', 'lname', 'phone', 'email', 'address', 'country']);

        DB::beginTransaction();

        try {            
            $data['name'] = "{$data['fname']} {$data['lname']}";
            unset($data['fname'], $data['lname']);
            $pswd = explode('@', $data['email'])[0];
            $user_inpt = ['name' => $data['name'], 'email' => $data['email'], 'password' => $pswd, 'ins' => auth()->user()->ins];
            $user = User::create($user_inpt);

            $data['rel_id'] = $user->id;
            UserProfile::create($data);

            DB::commit();
            return redirect(route('user_profiles.index'))->with(['success' => 'User created successfully']);
        } catch (\Throwable $th) { dd($th);
            return errorHandler('Error creating user!', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $user_profile)
    {
        return view('user_profiles.view', compact('user_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $user_profile)
    {
        $names = explode(' ', $user_profile->name);
        $user_profile->fname = @$names[0] ?: '';
        $user_profile->lname = @$names[1] ?: '';

        return view('user_profiles.edit', compact('user_profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $user_profile)
    {
        // dd($request->all());
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'country' => 'required',
        ]);
        $data = $request->only(['fname', 'lname', 'phone', 'email', 'address', 'country']);

        try {            
            $data['name'] = "{$data['fname']} {$data['lname']}";
            unset($data['fname'], $data['lname']);
            $user_profile->update($data);

            return redirect(route('user_profiles.index'))->with(['success' => 'User created successfully']);
        } catch (\Throwable $th) { dd($th);
            return errorHandler('Error creating user!', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $user_profile)
    {
        return redirect(route('user_profiles.index'))->with(['success' => 'User deleted successfully']);
    }

    /**
     * Display active user profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active_profile()
    {
        $user_profile = UserProfile::where('rel_id', auth()->user()->id)->first();

        return view('user_profiles.active_profile', compact('user_profile'));
    }
}
