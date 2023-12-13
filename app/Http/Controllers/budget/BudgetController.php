<?php

namespace App\Http\Controllers\budget;

use App\Http\Controllers\Controller;
use App\Models\budget\Budget;
use App\Models\budget\BudgetExpense;
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
        $proposals = Proposal::get();

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
            $data_items = array_filter($data_items, fn($v) => $v['name']);
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
        $item_categories = $budget->items()->whereIn('type', ['objective', 'personnel_cost', 'overhead_cost'])->get();
        
        return view('budgets.view', compact('budget', 'item_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        if ($budget->expenses->count()) 
            return errorHandler('Expended budget cannot be edited!');

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

            DB::beginTransaction();
            
            try {
                $input = inputClean($request->except('_token'));
                $budget->update($input);
                
                // budget items
                $input_items = $request->only('budget', 'name', 'proposal_item_id', 'type');
                $input_items['budget'] = array_map(fn($v) => numberClean($v), $input_items['budget']);
                $data_items = databaseArray($input_items);
                $data_items = fillArrayRecurse($data_items, ['budget_id' => $budget->id]);
                $data_items = array_filter($data_items, fn($v) => $v['name']);
                $budget->items()->delete();
                BudgetItem::insert($data_items);
                
                DB::commit();
                return redirect(route('budgets.index'))->with(['success' => 'Budget updated successfully']);
            } catch (\Throwable $th) {
                errorHandler('Error updating budget!');
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
            $budget->items()->delete();
            $budget->delete();
            return redirect(route('budgets.index'))->with(['success' => 'Case Study deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting case study!', $th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_expenses(BudgetExpense $budget_expense)
    {
        $budget_expense['cost_item'] = $budget_expense->cost_item;
        
        return response()->json($budget_expense);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_expenses(Request $request)
    {   
        $request->validate([
            'budget_id' => 'required',
            'item_category_id' => 'required',
            'cost_item_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        try {
            $input = inputClean($request->except('_token'));
            BudgetExpense::create($input);
            return redirect()->back()->with(['success' => 'Expense created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating expense!', $th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_expenses(Request $request, BudgetExpense $budget_expense)
    {
        $request->validate([
            'budget_id' => 'required',
            'item_category_id' => 'required',
            'cost_item_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        try {
            $input = inputClean($request->except('_token'));
            $budget_expense->update($input);
            return redirect()->back()->with(['success' => 'Expense updated successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error updating expense!', $th);
        }
    }  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_expenses(BudgetExpense $budget_expense)
    { 
        try {
            $budget_expense->delete();
            return redirect()->back()->with(['success' => 'Expense deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting expense!', $th);
        }
    }

    /**
     * Proposal Items
     */
    public function proposal_items(Request $request)
    {
        $proposal_items = ProposalItem::where('proposal_id', $request->proposal_id)
        ->orderBy('row_index')->get();
        $budget_items = BudgetItem::whereHas('budget', fn($q) => $q->where('proposal_id', $request->proposal_id))
        ->get();
        
        return view('budgets.partial.proposal_items', compact('proposal_items', 'budget_items'));
    }

    /**
     * Expense Activities
     */
    public function cost_items(Request $request)
    {
        $category_id = $request->category_id;
        $budget_id = $request->budget_id;

        $proposal_items = BudgetItem::where('budget_id', $budget_id)
        ->get(['id', 'name', 'type']);

        $cost_items = [];
        $is_item = false;
        foreach ($proposal_items as $i => $item) {
            if ($is_item) {
                if ($cost_items && end($cost_items)['type'] != $item->type) {
                    break;
                } elseif ($item->name == 'Subtotal') {
                    continue;
                }
                $cost_items[] = $item;
            } elseif ($item->id == $category_id) {
                $is_item = true;
            }
        }

        return response()->json($cost_items);
    }

    /**
     * Budget Tracker
     */
    function budget_tracker(Budget $budget)
    {
        $expense_totals = BudgetExpense::when(request('query_month'), function($q) {
            $params = explode('-', request('query_month'));
            $q->whereMonth('date', $params[0])->whereYear('date', $params[1]);
        })
        ->selectRaw('cost_item_id, SUM(amount) as total')
        ->groupBy('cost_item_id')->get();

        $budget_items = $budget->items;
        foreach ($budget_items as $i => $item) {
            foreach ($expense_totals as $group) {
                if ($item->id == $group->cost_item_id) {
                    $budget_items[$i]['total_cost'] = $group->total;
                    $budget_items[$i]['burn_rate'] = round(($group->total/$item->budget) * 100); 
                }
            }
        }
        $budget->items = $budget_items;
        
        return view('budgets.partial.budget_tracker', compact('budget', 'expense_totals'));
    }
}
