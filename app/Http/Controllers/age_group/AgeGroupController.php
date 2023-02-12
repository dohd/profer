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
        $request->validate(['bracket' => 'required']);
        $data = $request->only(['bracket']);

        try {            
            if (AgeGroup::create($data)) 
            return redirect(route('age_groups.index'))->with(['success' => 'Age Group created successfully']);
        } catch (\Throwable $th) {
            throw GeneralException('Error creating Age Group!');
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
    public function update(Request $request, AgeGroup $age_group)
    {
        // dd($request->all());
        $request->validate(['bracket' => 'required']);
        $data = $request->only(['bracket']);

        try {            
            if ($age_group->update($data)) 
            return redirect(route('age_groups.index'))->with(['success' => 'Age Group updated successfully']);
        } catch (\Throwable $th) {
            throw GeneralException('Error updating Age Group!');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgeGroup $age_group)
    {
        try {            
            if ($age_group->delete()) 
            return redirect(route('age_groups.index'))->with(['success' => 'Age Group deleted successfully']);
        } catch (\Throwable $th) {
            throw GeneralException('Error deleting Age Group!');
        }  
    }
}
