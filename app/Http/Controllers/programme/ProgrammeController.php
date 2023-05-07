<?php

namespace App\Http\Controllers\programme;

use App\Http\Controllers\Controller;
use App\Models\item\ProposalItem;
use App\Models\programme\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::all();

        return view('programmes.index', compact('programmes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programmes.create');
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
            Programme::create($data);
            return redirect(route('programmes.index'))->with(['success' => 'Programme created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating programme!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        $proposal_items = ProposalItem::whereHas('proposal', function ($q) use($programme) {
            $q->whereHas('action_plans', fn($q) => $q->where('programme_id', $programme->id));
        })
        ->whereHas('participant_lists', fn($q) => $q->where('total_count', '>', 0))
        ->with(['participant_lists' => fn($q) => $q->where('total_count', '>', 0)])
        ->with('participant_regions')
        ->get();
        // append regions and dates 
        foreach ($proposal_items as $item) {
            $item->regions = $item->participant_regions->pluck('name')->toArray();
            $item->dates = $item->participant_lists->pluck('date')->toArray();
            $item->dates = array_map(fn($v) => dateFormat($v), $item->dates);
        }
        
        return view('programmes.view', compact('programme', 'proposal_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        return view('programmes.edit', compact('programme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        // dd($request->all());
        $request->validate(['name' => 'required']);
        $data = $request->only(['name']);

        try {            
            if ($programme->update($data)) 
            return redirect(route('programmes.index'))->with(['success' => 'Programme updated successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error updating programme!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        try {            
            if ($programme->delete()) 
            return redirect(route('programmes.index'))->with(['success' => 'Programme deleted successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error deleting programme!');
        }
    }
}
