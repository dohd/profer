<?php

namespace App\Http\Controllers\budget;

use App\Http\Controllers\Controller;
use App\Models\budget\Budget;
use App\Models\item\BudgetItem;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::latest()->get();

        return view('budgets.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proposals = Proposal::get(['id', 'tid', 'title']);

        return view('budgets.create', compact('proposals'));
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
        ]);

        DB::beginTransaction();

        try {
            $input = inputClean($request->except('_token'));
            $budget = Budget::create($input);

            // budget items
            $input_items = $request->only('budget', 'name', 'proposal_item_id', 'type');
            $input_items['budget'] = array_map(fn($v) => numberClean($v), $input_items['budget']);
            $data_items = databaseArray($input_items);
            $data_items = fillArrayRecurse($data_items, ['budget_id' => $budget->id]);
            BudgetItem::insert($data_items);

            DB::commit();
            return redirect(route('budgets.index'))->with(['success' => 'Budget created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating budget!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        return view('budgets.view', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        $proposals = Proposal::get(['id', 'tid', 'title']);

        return view('budgets.edit', compact('budget', 'proposals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        // dd($request->all());
        if ($request->status) {
            // update budget status
            $data = $request->only('status', 'status_note');
            if (empty($data['status_note'])) unset($data['status_note']);
            try {
                $budget->update($data);
                return redirect()->back()->with('success', 'Status updated successfully');
            } catch (\Throwable $th) {
                errorHandler('Error updating status!');
            }
        } else {
            $request->validate([
                'proposal_id' => 'required',
            ]);
            
            try {
                // $input = inputClean($request->except('_token'));
                // $budget = Budget::create($input);

                // budget items
                // $input_items = $request->only('budget', 'name', 'proposal_item_id', 'type');
                // $input_items['budget'] = array_map(fn($v) => numberClean($v), $input_items['budget']);
                // $data_items = databaseArray($input_items);
                // $data_items = fillArrayRecurse($data_items, ['budget_id' => $budget->id]);
                // BudgetItem::insert($data_items);

                // DB::commit();
                return redirect(route('budgets.index'))->with(['success' => 'Budget updated successfully']);
            } catch (\Throwable $th) {
                errorHandler('Error creating budget!');
            }
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    { 
        try {
            $budget->delete();
            return redirect(route('budgets.index'))->with(['success' => 'Case Study deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting case study!', $th);
        }
    }

    /**
     * Proposal Items
     */
    public function proposal_items(Request $request)
    {
        $proposal_items = ProposalItem::where('proposal_id', $request->proposal_id)
        ->orderBy('row_index')->get();

        return view('budgets.partial.proposal_items', compact('proposal_items'));
    }
}
