<?php

namespace App\Http\Controllers\proposal;

use App\Http\Controllers\Controller;
use App\Models\donor\Donor;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grp_status_count = Proposal::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status');

        return view('proposals.index', compact('grp_status_count'));
    }

    /**
     * Display list of proposals using datatable
     */
    public function datatable(Request $request)
    {
        $q = Proposal::query();

        // filter approved proposals
        $q->when(request('status'), function($q) {
            $q->where('status', 'approved');
            switch (request('status')) {
                case 'wo_logframe': $q->doesntHave('log_frame'); break;
                case 'wo_action_plan': $q->doesntHave('action_plans'); break;
            }
        });
        
        return view('proposals.partial.proposal_datatable', ['proposals' => $q->latest()->get()]);
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
        
        return view('proposals.create', compact('donors','regions'));
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
            'title' => 'required', 
            'date' => 'required',
            'donor_id' => 'required', 
            'start_date' => 'required', 
            'end_date' => 'required', 
            'budget' => 'required',
        ]); 
        $data = $request->only(['title', 'date', 'region_id', 'sector', 'donor_id', 'start_date', 'end_date', 'budget',]);
        $data_items = $request->only(['name', 'is_obj', 'row_num', 'row_index',]);

        DB::beginTransaction();

        try {
            $data = inputClean($data);
            $proposal = Proposal::create($data);

            // create proposal items
            $data_items = databaseArray($data_items);
            $data_items = fillArrayRecurse($data_items, ['proposal_id' => $proposal->id]);
            ProposalItem::insert($data_items);

            DB::commit();
            return redirect(route('proposals.index'))->with(['success' => 'Proposal created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating proposal!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        return view('proposals.view', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        $donors = Donor::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        
        return view('proposals.edit', compact('proposal', 'donors','regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        // dd($request->all());
        if ($request->status) {
            // update proposal status
            $data = $request->only('status', 'status_note');
            if (empty($data['status_note'])) unset($data['status_note']);
            try {
                $proposal->update($data);
                return redirect()->back()->with('success', 'Status updated successfully');
            } catch (\Throwable $th) {
                errorHandler('Error updating status!');
            }
        } else {
            // update proposal
            $request->validate([
                'title' => 'required', 
                'date' => 'required', 
                'donor_id' => 'required', 
                'start_date' => 'required', 
                'end_date' => 'required', 
                'budget' => 'required',
            ]);

            $data = $request->only(['title', 'date', 'region_id', 'sector', 'donor_id', 'start_date', 'end_date', 'budget',]);
            $data_items = $request->only(['name', 'is_obj', 'row_num', 'row_index', 'item_id']);

            DB::beginTransaction();

            try {
                $data = inputClean($data);
                $data_items = fillArrayRecurse(databaseArray($data_items), [
                    'proposal_id' => $proposal->id
                ]);

                // delete omitted line items
                $proposal->items()->whereNotIn('id', array_map(fn($v) => $v['item_id'], $data_items))->delete();
                // update or create line items
                foreach ($data_items as $value) {
                    $proposal_item = ProposalItem::firstOrNew(['id' => $value['item_id']]);
                    $proposal_item->fill($value);
                    unset($proposal->item_id);
                    $proposal_item->save();
                }

                DB::commit();
                return redirect(route('proposals.index'))->with(['success' => 'Proposal updated successfully']);
            } catch (\Throwable $th) {
                errorHandler('Error updating proposal!');
            }   
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        if ($proposal->delete())
            return redirect(route('proposals.index'))->with(['success' => 'Proposal deleted successfully']);
        else errorHandler('Error deleting proposal!');
    }

    // proposal items
    public function proposal_items(Request $request)
    {
        $proposal_items = ProposalItem::when(request('is_participant_list'), function ($q) {
            $q->whereHas('plan_activities');
        })->where('proposal_id', request('proposal_id'))->get();
        
        return response()->json($proposal_items);
    }
}
