<?php

namespace App\Http\Controllers\region;

use App\Http\Controllers\Controller;
use App\Models\item\ProposalItem;
use App\Models\region\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();

        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regions.create');
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
            if (Region::create($data))
            return redirect(route('regions.index'))->with(['success' => 'Region created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating region!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        $proposal_items = ProposalItem::whereHas('participant_lists', function ($q) use($region) {
            $q->where('region_id', $region->id)->where('total_count', '>', 0);
        })
        ->with(['participant_lists' => fn($q) => $q->where('region_id', $region->id)->where('total_count', '>', 0)])
        ->get();

        return view('regions.view', compact('region', 'proposal_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        // dd($request->all());
        $request->validate(['name' => 'required']);
        $data = $request->only(['name']);

        try {            
            if ($region->update($data))
            return redirect(route('regions.index'))->with(['success' => 'Region updated successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error updating region!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        try {            
            if ($region->delete())
            return redirect(route('regions.index'))->with(['success' => 'Region deleted successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error deleting region!');
        }
    }
}
