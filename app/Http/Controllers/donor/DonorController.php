<?php

namespace App\Http\Controllers\donor;

use App\Http\Controllers\Controller;
use App\Models\donor\Donor;
use App\Models\item\ProposalItem;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donors = Donor::all();

        return view('donors.index', compact('donors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donors.create');
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $data = $request->only(['name', 'phone', 'email', 'contact_person', 'alternative_phone', 'alternative_email']);

        try {            
            Donor::create($data);
            return redirect(route('donors.index'))->with(['success' => 'Donor created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating donor!', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Donor $donor)
    {
        $proposal_items = ProposalItem::whereHas('proposal', fn($q) => $q->where('donor_id', $donor->id))
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

        return view('donors.view', compact('donor', 'proposal_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donor $donor)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $data = $request->only(['name', 'phone', 'email', 'contact_person', 'alternative_phone', 'alternative_email']);

        try {   
            $donor->update($data);
            return redirect(route('donors.index'))->with(['success' => 'Donor updated successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error updating donor!', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donor $donor)
    {
        try {
            $donor->delete();
            return redirect(route('donors.index'))->with(['success' => 'Donor deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting donor!', $th);
        }
    }
}
