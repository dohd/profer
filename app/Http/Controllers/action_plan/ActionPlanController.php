<?php

namespace App\Http\Controllers\action_plan;

use App\Http\Controllers\Controller;
use App\Models\action_plan\ActionPlan;
use App\Models\action_plan\ActionPlanActivity;
use App\Models\action_plan\ActionPlanCohort;
use App\Models\action_plan\ActionPlanRegion;
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
    use ActionPlanActivityTrait;

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
        $proposals = Proposal::where('status', 'approved')->get(['id', 'title']);
        $programmes = Programme::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);
            
        return view('action_plans.create', compact('proposals', 'programmes', 'regions', 'cohorts'));
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
            'main_assigned_to' => 'required',
            'activity_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'assigned_to' => 'required',
            'cohort_id' => 'required',
            'target_no' => 'required',
            'region_id' => 'required',
            'resources' => 'required',
        ]); 

        $data = $request->only(['proposal_id', 'programme_id', 'main_assigned_to']);
        $data_activity = $request->only(['activity_id', 'start_date', 'end_date', 'assigned_to', 'resources']);
        $data_regions = $request->only(['region_id']);
        $data_cohort = $request->only(['cohort_id', 'target_no']);

        DB::beginTransaction();

        try {
            $action_plan = ActionPlan::create($data);

            $data_activity = inputClean($data_activity);
            $data_activity['action_plan_id'] = $action_plan->id;
            $plan_activity = ActionPlanActivity::create($data_activity);

            $add_params = [
                'action_plan_id' => $action_plan->id,
                'activity_id' => $plan_activity->id,
            ];

            $data_regions = databaseArray($data_regions);
            $data_regions = fillArrayRecurse($data_regions, $add_params);
            ActionPlanRegion::insert($data_regions);

            $data_cohort = fillArray($data_cohort, $add_params);
            ActionPlanCohort::insert($data_cohort);

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
        $activities = ProposalItem::where(['proposal_id' => $action_plan->proposal_id, 'is_obj' => 0])->get(['id', 'name']);
        $cohort_activities = ProposalItem::whereHas('plan_activities')->get(['id', 'name']);
        $regions = Region::get(['id', 'name']);

        return view('action_plans.view', compact('action_plan', 'activities', 'cohort_activities', 'regions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ActionPlan $action_plan)
    {
        $proposals = Proposal::where('status', 'approved')->get(['id', 'title']);
        $programmes = Programme::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);

        $plan_activity = $action_plan->plan_activity;
        if ($plan_activity) {
            $action_plan = fillArray($action_plan, [
                'start_date' => $plan_activity->start_date,
                'end_date' => $plan_activity->end_date,
                'assigned_to' => $plan_activity->assigned_to,
                'resources' => $plan_activity->resources,
            ]);
            if ($plan_activity->cohort) {
                $action_plan['cohort_id'] = $plan_activity->cohort->id;
                $action_plan['target_no'] = $plan_activity->activity_cohort->target_no;
            }
            if ($plan_activity->regions->count()) {
                $action_plan['regions'] = $plan_activity->regions->pluck('id')->toArray();
            }
        }
            
        return view('action_plans.edit', compact('action_plan', 'proposals', 'programmes', 'regions', 'cohorts'));
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
        dd($request->all());
        if (request('status')) {
            // update action plan status
            if ($action_plan->update(['status' => request('status')]))
                return redirect()->back()->with('success', 'Status updated successfully');
            else errorHandler('Error updating status!');
        } else {
            $request->validate([
                'proposal_id' => 'required', 
                'programme_id' => 'required', 
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActionPlan $action_plan)
    {
        dd($action_plan->id);
        if ($action_plan->delete())
            return redirect(route('action_plans.index'))->with(['success' => 'Action Plan deleted successfully']);
        else errorHandler('Error deleting Action Plan!');
    }

    /**
     * Proposal items
     */
    public function proposal_items()
    {
        $proposal_items = ProposalItem::where(['proposal_id' => request('proposal_id'), 'is_obj' => 0])->get(['id', 'name']);
            
        return response()->json($proposal_items);
    }
}
