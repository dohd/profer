<?php

namespace App\Http\Controllers\log_frame;

use App\Http\Controllers\Controller;
use App\Models\donor\Donor;
use App\Models\item\ProposalItem;
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

        return redirect()->back()->with('error', 'Maintenance Mode! Please try again later');
        
        return view('log_frames.edit', compact('log_frame', 'donors','regions'));
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
        dd($request->all());
        
        if (request('status')) {
            // update log_frame status
            if ($log_frame->update(['status' => request('status')]))
                return redirect()->back()->with('success', 'Status updated successfully');
            else errorHandler('Error updating status!');
        } else {
            // update log_frame
            $request->validate([
                'title' => 'required', 
                'region_id' => 'required', 
                'sector' => 'required', 
                'donor_id' => 'required', 
                'start_date' => 'required', 
                'end_date' => 'required', 
                'budget' => 'required',
            ]);

            $data = $request->only(['title', 'region_id', 'sector', 'donor_id', 'start_date', 'end_date', 'budget',]);
            $data_items = $request->only(['name', 'is_obj', 'row_num', 'row_index', 'item_id']);

            DB::beginTransaction();

            try {
                $data = inputClean($data);
                if ($log_frame->update($data)) {
                    $data_items = databaseArray($data_items);
                    $data_items = fillArrayRecurse($data_items, ['proposal_id' => $log_frame->id]);

                    $log_frame->items()->whereNotIn('id', array_map(fn($v) => $v['item_id'], $data_items))->delete();
                    foreach ($data_items as $value) {
                        $proposal_item = ProposalItem::firstOrNew(['id' => $value['item_id']]);
                        $proposal_item->fill($value);
                        unset($log_frame->item_id);
                        $proposal_item->save();
                    }

                    DB::commit();
                    return redirect(route('log_frames.index'))->with(['success' => 'LogFrame updated successfully']);
                }
            } catch (\Throwable $th) {
                errorHandler('Error updating log_frame!');
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
