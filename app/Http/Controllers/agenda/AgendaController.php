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
        $agenda = Agenda::get();

        return view('agenda.index', compact('agenda'));
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
        $request->validate([
            'proposal_id' => 'required',
            'action_plan_id' => 'required',
            'proposal_item_id' => 'required',
            'date' => 'required',
            'title' => 'required',
        ]);

        $data = $request->only(['proposal_id', 'action_plan_id', 'proposal_item_id', 'date', 'title']);
        $data_items = $request->only(['time_from', 'time_to', 'topic', 'assigned_to', 'row_index']);
        // dd($data, $data_items);

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
            dd($th);
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
        $proposal_items = [];

        return view('agenda.view', compact('agenda', 'proposal_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
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
        dd($request->all());
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $data = $request->only(['name', 'phone', 'email', 'contact_person', 'alternative_phone', 'alternative_email']);

        try {
            $agenda->update($data);
            return redirect(route('agenda.index'))->with(['success' => 'Agenda updated successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error updating agenda!', $th);
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
