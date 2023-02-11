<?php

namespace App\Http\Controllers\cohort;

use App\Http\Controllers\Controller;
use App\Models\cohort\Cohort;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cohorts = Cohort::all();

        return view('cohorts.index', compact('cohorts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cohorts.create');
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
            if (Cohort::create($data)) 
            return redirect(route('cohorts.index'))->with(['success' => 'Cohort created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating cohort!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cohort $cohort)
    {
        return view('cohorts.view', compact('cohort'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cohort $cohort)
    {
        return view('cohorts.edit', compact('cohort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cohort $cohort)
    {
        // dd($request->all());
        $request->validate(['name' => 'required']);
        $data = $request->only(['name']);

        try {            
            if ($cohort->update($data)) 
            return redirect(route('cohorts.index'))->with(['success' => 'Cohort updated successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error updating cohort!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cohort $cohort)
    {
        try {            
            if ($cohort->delete()) 
            return redirect(route('cohorts.index'))->with(['success' => 'Cohort deleted successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error deleting cohort!');
        }
    }
}
