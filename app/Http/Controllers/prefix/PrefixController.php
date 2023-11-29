<?php

namespace App\Http\Controllers\prefix;

use App\Http\Controllers\Controller;
use App\Models\item\ProposalItem;
use App\Models\prefix\Prefix;
use Illuminate\Http\Request;

class PrefixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prefixes = Prefix::latest()->get();

        return view('prefixes.index', compact('prefixes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prefixes.create');
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
            if (Prefix::create($data))
            return redirect(route('prefixes.index'))->with(['success' => 'Prefix created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating prefix!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Prefix $prefix)
    {
        $proposal_items = ProposalItem::whereHas('participant_lists', function ($q) use($prefix) {
            $q->where('prefix_id', $prefix->id)->where('total_count', '>', 0);
        })
        ->with(['participant_lists' => fn($q) => $q->where('prefix_id', $prefix->id)->where('total_count', '>', 0)])
        ->with('participant_prefixes')
        ->get();
        // append prefixes and dates 
        foreach ($proposal_items as $item) {
            $item->prefixes = $item->participant_prefixes->pluck('name')->toArray();
            $item->dates = $item->participant_lists->pluck('date')->toArray();
            $item->dates = array_map(fn($v) => dateFormat($v), $item->dates);
        }

        return view('prefixes.view', compact('prefix', 'proposal_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Prefix $prefix)
    {
        return view('prefixes.edit', compact('prefix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prefix $prefix)
    {
        $request->validate(['code' => 'required']);
        try {            
            $prefix->update(['code' => $request->input('code')]);
            return redirect(route('prefixes.index'))->with(['success' => 'Prefix updated successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error updating prefix!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prefix $prefix)
    {
        try {            
            $prefix->delete();
            return redirect(route('prefixes.index'))->with(['success' => 'Prefix deleted successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error deleting prefix!');
        }
    }
}
