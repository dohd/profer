<?php

namespace App\Http\Controllers\disability;

use App\Http\Controllers\Controller;
use App\Models\disability\Disability;
use App\Models\item\ProposalItem;
use Illuminate\Http\Request;

class DisabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disabilities = Disability::latest()->get();

        return view('disabilities.index', compact('disabilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('disabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $data = $request->only(['name']);

        try {            
            Disability::create($data); 
            return redirect(route('disabilities.index'))->with(['success' => 'Disability created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating disability!', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Disability $disability)
    {
        $proposal_items = ProposalItem::whereHas('participants', fn($q) => $q->where('disability_id', $disability->id))
        ->with(['participants' => fn($q) => $q->where('disability_id', $disability->id)])
        ->with('participant_regions')
        ->get();
        // append regions and dates 
        foreach ($proposal_items as $item) {
            $item->regions = $item->participant_regions->pluck('name')->toArray();
            $item->dates = $item->participants->pluck('date')->toArray();
            $item->dates = array_map(fn($v) => dateFormat($v), $item->dates);
        }

        return view('disabilities.view', compact('disability', 'proposal_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Disability $disability)
    {
        return view('disabilities.edit', compact('disability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disability $disability)
    {
        $request->validate(['name' => 'required']);
        $data = $request->only(['name']);

        try {            
            $disability->update($data);
            return redirect(route('disabilities.index'))->with(['success' => 'Disability updated successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error updating disability!', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disability $disability)
    {
        try {            
            $disability->delete();
            return redirect(route('disabilities.index'))->with(['success' => 'Disability deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting disability!', $th);
        }
    }
}
