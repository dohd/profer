<?php

namespace App\Http\Controllers\narrative;

use App\Http\Controllers\Controller;
use App\Models\agenda\Agenda;
use App\Models\item\NarrativeItem;
use App\Models\narrative\Narrative;
use App\Models\narrative_pointer\NarrativePointer;
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
        $narratives = Narrative::latest()->get();
        $status_grp = Narrative::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status');

        return view('narratives.index', compact('narratives', 'status_grp'));
    }

    /**
     * Narratives Datatable
     */
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
        $agenda = Agenda::doesntHave('narrative')->get();
        $narrative_pointers = NarrativePointer::all();
        
        return view('narratives.create', compact('agenda', 'narrative_pointers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'agenda_id' => 'required', 
            'date' => 'required',
        ]);

        $data = $request->only(['agenda_id', 'date']);
        $data_items = $request->only(['agenda_item_id', 'narrative_pointer_id', 'response']);

        DB::beginTransaction();

        try {
            $agenda = Agenda::find($data['agenda_id'], ['proposal_id', 'proposal_item_id', 'action_plan_id']);
            $data = $agenda->toArray() + $data;
            $narrative = Narrative::create($data);

            $data_items = databaseArray($data_items);
            $data_items = fillArrayRecurse($data_items, [
                'narrative_id' => $narrative->id, 
            ]);
            NarrativeItem::insert($data_items);

            DB::commit();
            return redirect(route('narratives.index'))->with(['success' => 'Narrative created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating narrative!', $th);
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
        $narrative_pointers = NarrativePointer::all();
        $narr_agenda = Agenda::find($narrative->agenda_id);
        $agenda = Agenda::doesntHave('narrative')->get();
        $agenda->add($narr_agenda);

        return view('narratives.edit', compact('agenda', 'narrative', 'narrative_pointers'));
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
        if (request('status')) {
            try {
                $narrative->update(['status' => request('status')]);
                return redirect()->back()->with('success', 'Status updated successfully');
            } catch (\Throwable $th) {
                return errorHandler('Error updating status!', $th);
            }
        } else {
            $request->validate([
                'agenda_id' => 'required', 
                'date' => 'required',
            ]);
    
            $data = $request->only(['agenda_id', 'date']);
            $data_items = $request->only(['item_id', 'agenda_item_id', 'narrative_pointer_id', 'response']);
    
            DB::beginTransaction();
    
            try {
                $agenda = Agenda::find($data['agenda_id'], ['proposal_id', 'proposal_item_id', 'action_plan_id']);
                $data = $agenda->toArray() + $data;
                $narrative->update($data);
    
                $data_items = databaseArray($data_items);
                foreach ($data_items as $item) {
                    $narr_item = NarrativeItem::find($item['item_id']);
                    unset($item['item_id']);
                    $narr_item->update($item);
                }
                
                DB::commit();
                return redirect(route('narratives.index'))->with(['success' => 'Narrative updated successfully']);
            } catch (\Throwable $th) {
                return errorHandler('Error updated narrative!', $th);
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
        try {
            $narrative->delete();
            return redirect(route('narratives.index'))->with(['success' => 'Narrative deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting narrative!', $th);
        }
    }

    /**
     * Narrative select options
     */
    public function narrative_items()
    {
        $narrative_items = NarrativeItem::where('narrative_id', request('narrative_id'))
            ->orderBy('row_index', 'asc')
            ->get();
    
        return view('action_plans.partials.narrative_items', compact('narrative_items'));
    }

    /**
     * Narrative Form Table
     */
    public function narrative_table(Request $request)
    {
        $agenda = Agenda::find($request->agenda_id);
        $narrative = Narrative::find($request->narrative_id);
        $narrative_pointers = NarrativePointer::all();

        return view('narratives.partial.narrative_table', compact('agenda', 'narrative', 'narrative_pointers'));
    }
}
