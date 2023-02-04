<?php

namespace App\Http\Controllers\age_group;

use App\Http\Controllers\Controller;
use App\Models\age_group\AgeGroup;
use Illuminate\Http\Request;

class AgeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $age_groups = AgeGroup::all();

        return view('age_groups.index', compact('age_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('age_groups.create');
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
        $data = $request->only(['name']);

        try {            
            $age_group = AgeGroup::create($data);
            if ($age_group) {
                return redirect(route('age_groups.index'))->with(['success' => 'Age group created successfully']);
            }
        } catch (\Throwable $th) {
            throw GeneralException('Error creating age group!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AgeGroup $age_group)
    {
        return view('age_groups.view', compact('age_group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AgeGroup $age_group)
    {
        return view('age_groups.edit', compact('age_group'));
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
}
