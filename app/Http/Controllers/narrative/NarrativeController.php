<?php

namespace App\Http\Controllers\narrative;

use App\Http\Controllers\Controller;
use App\Models\item\NarrativeItem;
use App\Models\narrative\Narrative;
use App\Models\narrative_pointer\NarrativePointer;
use App\Models\proposal\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NarrativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $narratives = Narrative::all();

        return view('narratives.index', compact('narratives'));
    }

    // narrative datatable
    public function datatable()
    {
        $narratives = Narrative::all();

        return view('narratives.partial.narrative_datatable', compact('narratives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proposals = Proposal::all();
        $narrative_pointers = NarrativePointer::all();

        return view('narratives.create', compact('proposals', 'narrative_pointers'));
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
            'proposal_item_id' => 'required', 
        ]);
        $data = $request->only(['proposal_id', 'proposal_item_id', 'note']);
        $data_items = $request->only(['narrative_pointer_id', 'response']);

        DB::beginTransaction();

        try {
            $narrative = Narrative::create($data);

            $data_items = databaseArray($data_items);
            $data_items = fillArrayRecurse($data_items, [
                'narrative_id' => $narrative->id, 
                'proposal_id' => $narrative->proposal_id,
                'proposal_item_id' => $narrative->proposal_item_id,
            ]);
            NarrativeItem::insert($data_items);

            if ($narrative) {
                DB::commit();
                return redirect(route('narratives.index'))->with(['success' => 'Narrative created successfully']);
            }
        } catch (\Throwable $th) {
            errorHandler('Error creating narrative!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Narrative $narrative)
    {
        return view('narratives.view', compact('narrative'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Narrative $narrative)
    {
        $proposals = Proposal::all();
        $narrative_pointers = NarrativePointer::all();

        return view('narratives.edit', compact('narrative', 'narrative_pointers', 'proposals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Narrative $narrative)
    {
        // dd($request->all());
        if (request('status')) {
            // update narrative status
            if ($narrative->update(['status' => request('status')]))
                return redirect()->back()->with('success', 'Status updated successfully');
            else errorHandler('Error updating status!');
        } else {
            // update narrative
            $request->validate([
                'proposal_id' => 'required', 
                'proposal_item_id' => 'required', 
            ]);
            $data = $request->only(['proposal_id', 'proposal_item_id', 'note']);
            $data_items = $request->only(['item_id', 'narrative_pointer_id', 'response']);

            DB::beginTransaction();

            try {
                if ($narrative->update($data)) {
                    $data_items = databaseArray($data_items);
                    $data_items = fillArrayRecurse($data_items, [
                        'narrative_id' => $narrative->id, 
                        'proposal_id' => $narrative->proposal_id,
                        'proposal_item_id' => $narrative->proposal_item_id,
                    ]);
                    foreach ($data_items as $item) {
                        $narrative_item = NarrativeItem::firstOrNew(['id' => $item['item_id']]);
                        $narrative_item->fill($item);
                        unset($narrative_item->item_id);
                        $narrative_item->save();
                    }

                    DB::commit();
                    return redirect(route('narratives.index'))->with(['success' => 'Narrative updated successfully']);
                }
            } catch (\Throwable $th) {
                errorHandler('Error updating narrative!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Narrative $narrative)
    {
        if ($narrative->delete()) 
            return redirect(route('narratives.index'))->with(['success' => 'Narrative deleted successfully']);
        else errorHandler('Error deleting narrative!');
    }

    // narrative items
    public function narrative_items()
    {
        $narrative_items = NarrativeItem::where('narrative_id', request('narrative_id'))
            ->orderBy('row_index', 'asc')
            ->get();
    
        return view('action_plans.partials.narrative_items', compact('narrative_items'));
    }
}
