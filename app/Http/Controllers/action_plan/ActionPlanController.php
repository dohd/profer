<?php

namespace App\Http\Controllers\action_plan;

use App\Http\Controllers\Controller;
use App\Models\action_plan\ActionPlan;
use App\Models\cohort\Cohort;
use App\Models\item\ActionPlanItem;
use App\Models\item\ProposalItem;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\ProposalItemRegion;
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
            // dd($data, $data_items, $data_item_regions);

            $action_plan = ActionPlan::create($data);

            $data_item_regions = fillArrayRecurse($data_items, ['action_plan_id' => $action_plan->id]);
            ActionPlanItem::insert($data_items);

            ProposalItemRegion::insert($data_item_regions);

            if ($action_plan) {
                DB::commit();
                return redirect(route('action_plans.index'))->with(['success' => 'Action Plan created successfully']);
            }
        } catch (\Throwable $th) {
            throw GeneralException('Error creating Action Plan!');
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
        return view('action_plans.edit', compact('action_plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Proposal items
     */
    public function proposal_items()
    {
        $proposal_items = ProposalItem::where('proposal_id', request('proposal_id'))
            ->orderBy('row_index', 'asc')->get();

        $cohorts = Cohort::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
    
        return view('action_plans.partials.proposal_items', compact('proposal_items', 'cohorts', 'regions'));
    }
}
