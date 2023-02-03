<?php

namespace App\Http\Controllers\proposal;

use App\Http\Controllers\Controller;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = Proposal::all();

        return view('proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proposals.create');
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
        $data = $request->only(['title', 'region', 'sector', 'donor', 'start_date', 'end_date', 'budget',]);
        $data_items = $request->only(['name', 'is_obj', 'row_num', 'row_index',]);

        DB::beginTransaction();

        try {
            $data = inputClean($data);
            $data_items = databaseArray($data_items);
            // dd($data, $data_items);
            
            $proposal = Proposal::create($data);

            $data_items = fillArrayRecurse($data_items, ['proposal_id' => $proposal->id]);
            ProposalItem::insert($data_items);

            if ($proposal) {
                DB::commit();
                return redirect(route('proposals.index'))->with(['success' => 'Proposal created successfully']);
            }
        } catch (\Throwable $th) {
            throw GeneralException('Error creating proposal!');
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
        return view('proposals.edit', compact('proposal'));
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

    // proposal items
    public function proposal_items()
    {
        $proposal_items = ProposalItem::where('proposal_id', request('proposal_id'))
            ->orderBy('row_index', 'asc')->get();
    
        return view('action_plans.partials.proposal_items', compact('proposal_items'));
    }
}
