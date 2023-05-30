<?php

namespace App\Http\Controllers\agenda;

use App\Http\Controllers\Controller;
use App\Models\agenda\Agenda;
use App\Models\item\AgendaItem;
use App\Models\proposal\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agenda = Agenda::latest()->get();
        $status_grp = Agenda::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status');

        return view('agenda.index', compact('agenda', 'status_grp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proposals = Proposal::whereHas('action_plans')->pluck('title', 'id');

        return view('agenda.create', compact('proposals'));
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
            'action_plan_id' => 'required',
            'proposal_item_id' => 'required',
            'date' => 'required',
            'title' => 'required',
        ]);

        $data = $request->only(['proposal_id', 'action_plan_id', 'proposal_item_id', 'date', 'title']);
        $data_items = $request->only(['time_from', 'time_to', 'topic', 'assigned_to']);

        DB::beginTransaction();

        try {
            $data = inputClean($data); 
            $agenda = Agenda::create($data);

            // items
            $data_items = databaseArray($data_items);
            $data_items = fillArrayRecurse($data_items, ['agenda_id' => $agenda->id]);
            AgendaItem::insert($data_items);

            DB::commit();
            return redirect(route('agenda.index'))->with(['success' => 'Agenda created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating agenda!', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return view('agenda.view', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        $proposals = Proposal::whereHas('action_plans')->pluck('title', 'id');

        return view('agenda.edit', compact('agenda', 'proposals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        // dd($request->all());
        if (request('status')) {
            // update agenda status
            if ($agenda->update(['status' => request('status')]))
                return redirect()->back()->with('success', 'Status updated successfully');
            else errorHandler('Error updating status!');
        } else {
            // update agenda
            $request->validate([
                'proposal_id' => 'required',
                'action_plan_id' => 'required',
                'proposal_item_id' => 'required',
                'date' => 'required',
                'title' => 'required',
            ]);
    
            $data = $request->only(['proposal_id', 'action_plan_id', 'proposal_item_id', 'date', 'title']);
            $data_items = $request->only(['time_from', 'time_to', 'topic', 'assigned_to', 'item_id']);
            
            DB::beginTransaction();
    
            try {
                $data = inputClean($data); 
                $agenda->update($data);
    
                // agenda items
                $agenda->items()->whereNotIn('id', $data_items['item_id'])->delete();
                $data_items = databaseArray($data_items);
                foreach ($data_items as $item) {
                    $item['agenda_id'] = $agenda->id;
                    $agenda_item = AgendaItem::firstOrNew(['id' => $item['item_id']]);
                    $agenda_item->fill($item);
                    unset($agenda_item->item_id);
                    $agenda_item->save();
                }
    
                DB::commit();
                return redirect(route('agenda.index'))->with(['success' => 'Agenda updated successfully']);
            } catch (\Throwable $th) {
                return errorHandler('Error updating agenda!', $th);
            }
        }
        
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        try {
            $agenda->delete();
            return redirect(route('agenda.index'))->with(['success' => 'Agenda deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting agenda!', $th);
        }
    }
}
