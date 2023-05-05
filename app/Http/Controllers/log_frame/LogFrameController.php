<?php

namespace App\Http\Controllers\log_frame;

use App\Http\Controllers\Controller;
use App\Models\donor\Donor;
use App\Models\log_frame\LogFrame;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;

class LogFrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log_frames = LogFrame::latest()->get();

        return view('log_frames.index', compact('log_frames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $donors = Donor::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $proposals = Proposal::where('status', 'approved')->doesntHave('log_frame')->get(['id', 'title']);
            
        return view('log_frames.create', compact('donors','regions', 'proposals'));
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
        $request->validate(['proposal_id' => 'required', 'date' => 'required']);

        $data = $request->except('_token'); 

        try {
            LogFrame::create($data);
            return redirect(route('log_frames.index'))->with(['success' => 'Log Frame created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating Log frame!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LogFrame $log_frame)
    {
        return view('log_frames.view', compact('log_frame'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LogFrame $log_frame)
    {   
        $donors = Donor::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $proposals = Proposal::where('status', 'approved')->get(['id', 'title']);
        
        return view('log_frames.edit', compact('log_frame', 'donors', 'regions', 'proposals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogFrame $log_frame)
    {
        // dd($request->all());
        $request->validate(['proposal_id' => 'required', 'date' => 'required']);

        $data = $request->except('_token'); 

        try {
            $log_frame->update($data);
            return redirect(route('log_frames.index'))->with(['success' => 'Log Frame updated successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error updating Log Frame!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogFrame $log_frame)
    {
        if ($log_frame->delete())
            return redirect(route('log_frames.index'))->with(['success' => 'Log Frame deleted successfully']);
        else errorHandler('Error deleting Log Frame!');
    }
}
