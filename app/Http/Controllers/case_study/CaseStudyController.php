<?php

namespace App\Http\Controllers\case_study;

use App\Http\Controllers\Controller;
use App\Models\case_study\CaseStudy;
use App\Models\programme\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaseStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $case_studies = CaseStudy::latest()->get();

        return view('case_studies.index', compact('case_studies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programmes = Programme::get();

        return view('case_studies.create', compact('programmes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'programme_id' => 'required',
            'date' => 'required',
            'title' => 'required',
            'situation' => 'required',
            'intervention' => 'required',
            'impact' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Input all required(*) fields'], 400);
        }
        
        try {
            $input = inputClean($request->except('_token')); 
            $case_study = CaseStudy::create($input); 

            return response()->json(['success' => true, 'message' => 'Case Study created successfully', 'redirectTo' => route('case_studies.edit', $case_study)]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CaseStudy $case_study)
    {
        return view('case_studies.view', compact('case_study'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CaseStudy $case_study)
    {
        $programmes = Programme::get();

        return view('case_studies.edit', compact('case_study', 'programmes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseStudy $case_study)
    {
        $validator = Validator::make($request->all(), [
            'programme_id' => 'required',
            'date' => 'required',
            'title' => 'required',
            'situation' => 'required',
            'intervention' => 'required',
            'impact' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Input all required(*) fields'], 400);
        }
        
        try {
            $input = inputClean($request->except('_token')); 
            $case_study->update($input);

            return response()->json(['success' => true, 'message' => 'Case Study updated successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseStudy $case_study)
    { 
        try {
            $case_study->delete();
            return redirect(route('case_studies.index'))->with(['success' => 'Case Study deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting case study!', $th);
        }
    }
}
