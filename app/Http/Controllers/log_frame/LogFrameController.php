<?php

namespace App\Http\Controllers\log_frame;

use App\Http\Controllers\Controller;
use App\Models\donor\Donor;
use App\Models\log_frame\LogFrame;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogFrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log_frames = LogFrame::where('context', 'goal')->get();

        return view('log_frames.index', compact('log_frames'));
    }

    // log_frame datatable
    public function datatable()
    {
        $log_frames = LogFrame::all();

        return view('log_frames.partial.proposal_datatable', compact('log_frames'));
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
        $proposals = Proposal::where('status', 'approved')
            ->whereDoesntHave('log_frames')->get(['id', 'title']);
        
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
        $request->validate([
            'proposal_id' => 'required',
        ]);

        $data = $request->only('proposal_id');
        $data_items = $request->only([
            'summary', 'indicator', 'baseline', 'target', 'data_source', 'frequency', 'assign_to', 'context'
        ]);

        DB::beginTransaction();

        try {
            $data_items = fillArrayRecurse(databaseArray($data_items), [
                'tid' => (new LogFrame)->next_tid,
                'proposal_id' => $data['proposal_id'],
                'user_id' => auth()->user()->id,
                'ins' => auth()->user()->ins,
            ]);
            LogFrame::insert($data_items);

            DB::commit();
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
        $log_frame_rows = LogFrame::where('tid', $log_frame->tid)->get();

        return view('log_frames.view', compact('log_frame', 'log_frame_rows'));
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

        $outcome_row = LogFrame::where('proposal_id', $log_frame->proposal_id)
            ->where('context', 'outcome')->first();
        $result_row = LogFrame::where('proposal_id', $log_frame->proposal_id)
            ->where('context', 'result')->first();
        
        return view('log_frames.edit', compact('log_frame', 'outcome_row', 'result_row', 'donors', 'regions', 'proposals'));
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
        if ($request->status) {
            // update log_frame status
            $data = $request->only('status', 'status_note');
            if (empty($data['status_note'])) unset($data['status_note']);
            if ($log_frame->update($data)) return redirect()->back()->with('success', 'Status updated successfully');
            else errorHandler('Error updating status!');
        } else {
            $request->validate([
                'proposal_id' => 'required',
            ]);
    
            $data = $request->only('proposal_id');
            $data_items = $request->only([
                'item_id', 'summary', 'indicator', 'baseline', 'target', 'data_source', 'frequency', 'assign_to', 'context'
            ]);

            DB::beginTransaction();

            try {
                $data_items = fillArrayRecurse(databaseArray($data_items), [
                    'proposal_id' => $data['proposal_id'],
                ]);
                foreach ($data_items as $item) {
                    $item['id'] = $item['item_id'];
                    unset($item['item_id']);
                    $log_frame = LogFrame::findOrFail($item['id']);
                    $log_frame->fill($item);
                    $log_frame->save();
                }

                DB::commit();
                return redirect(route('log_frames.index'))->with(['success' => 'Log Frame updated successfully']);
            } catch (\Throwable $th) {
                errorHandler('Error updating Log Frame!');
            }   
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
        if (LogFrame::where('tid', $log_frame->tid)->delete())
            return redirect(route('log_frames.index'))->with(['success' => 'Log Frame deleted successfully']);
        else errorHandler('Error deleting Log Frame!');
    }
}
