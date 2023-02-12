<?php

namespace App\Http\Controllers\action_plan;

use App\Http\Controllers\Controller;
use App\Models\action_plan\ActionPlan;
use App\Models\cohort\Cohort;
use App\Models\item\ActionPlanItem;
use App\Models\item\ProposalItem;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\ActionPlanItemRegion;
use App\Models\region\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $action_plans = ActionPlan::all();

        return view('action_plans.index', compact('action_plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proposals = Proposal::get(['id', 'title']);
        $programmes = Programme::get(['id', 'name']);
            
        return view('action_plans.create', compact('proposals', 'programmes'));
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
            'programme_id' => 'required', 
            'main_assigned_to' => 'required'
        ]);
        $data = $request->only(['proposal_id', 'programme_id', 'main_assigned_to']);
        $data_items = $request->only(['proposal_item_id', 'start_date', 'end_date', 'resources', 'assigned_to', 'cohort_id']);
        $data_item_regions = $request->region_id;

        DB::beginTransaction();

        try {
            $data = inputClean($data);
            $data_items = databaseArray($data_items);
            $data_item_regions = explodeArray('-', $data_item_regions);
            foreach ($data_item_regions as $key => $value) {
                $data_item_regions[] = ['region_id' => $value[0], 'proposal_item_id' => $value[1]];
                unset($data_item_regions[$key]);
            }

            $action_plan = ActionPlan::create($data);

            // action plan items
            $data_items = fillArrayRecurse($data_items, ['action_plan_id' => $action_plan->id]);
            ActionPlanItem::insert($data_items);

            // item regions
            foreach ($data_item_regions as $i => $item_region) {
                foreach ($action_plan->items as $item) {
                    if ($item['proposal_item_id'] == $item_region['proposal_item_id']) {
                        $data_item_regions[$i]['action_plan_item_id'] = $item['id'];
                    }
                }
            }
            ActionPlanItemRegion::insert($data_item_regions);

            DB::commit();
            return redirect(route('action_plans.index'))->with(['success' => 'Action Plan created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating Action Plan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ActionPlan $action_plan)
    {
        return view('action_plans.view', compact('action_plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ActionPlan $action_plan)
    {
        $proposals = Proposal::get(['id', 'title']);
        $programmes = Programme::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);

        return view('action_plans.edit', compact('action_plan', 'proposals', 'programmes', 'cohorts', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActionPlan $action_plan)
    {
        // dd($request->all());
        $request->validate([
            'proposal_id' => 'required', 
            'programme_id' => 'required', 
            'main_assigned_to' => 'required'
        ]);
        $data = $request->only(['proposal_id', 'programme_id', 'main_assigned_to']);
        $data_items = $request->only(['proposal_item_id', 'start_date', 'end_date', 'resources', 'assigned_to', 'cohort_id', 'item_id']);
        $data_item_regions = $request->region_id;

        DB::beginTransaction();

        try {
            $data = inputClean($data);
            $data_items = databaseArray($data_items);
            $data_item_regions = explodeArray('-', $data_item_regions);
            foreach ($data_item_regions as $key => $value) {
                $data_item_regions[] = ['region_id' => $value[0], 'proposal_item_id' => $value[1]];
                unset($data_item_regions[$key]);
            }
            
            if ($action_plan->update($data)) {
                // action plan items
                $action_plan->items()->whereNotIn('id', array_map(fn($v) => $v['item_id'], $data_items))->delete();
                $data_items = fillArrayRecurse($data_items, ['action_plan_id' => $action_plan->id]);
                foreach ($data_items as $value) {
                    $action_plan_item = ActionPlanItem::firstOrNew(['id' => $value['item_id']]);
                    $action_plan_item->fill($value);
                    unset($action_plan_item->item_id);
                    $action_plan_item->save();
                }

                // item regions
                foreach ($data_item_regions as $i => $item_region) {
                    foreach ($data_items as $item) {
                        if ($item['proposal_item_id'] == $item_region['proposal_item_id']) {
                            $data_item_regions[$i]['action_plan_item_id'] = $item['item_id'];
                        }
                    }
                }
                ActionPlanItemRegion::whereIn('action_plan_item_id', array_map(fn($v) => $v['item_id'], $data_items))->delete();
                ActionPlanItemRegion::insert($data_item_regions);
                
                DB::commit();
                return redirect(route('action_plans.index'))->with(['success' => 'Action Plan updated successfully']);
            }
        } catch (\Throwable $th) { 
            errorHandler('Error updating Action Plan!');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActionPlan $action_plan)
    {
        if ($action_plan->delete())
            return redirect(route('action_plans.index'))->with(['success' => 'Action Plan deleted successfully']);
        else errorHandler('Error deleting Action Plan!');
    }

    /**
     * Proposal items
     */
    public function proposal_items()
    {
        $cohorts = Cohort::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $proposal_items = ProposalItem::where('proposal_id', request('proposal_id'))
            ->orderBy('row_index', 'asc')
            ->get();

        return view('action_plans.partials.proposal_items', compact('proposal_items', 'cohorts', 'regions'));
    }
}
