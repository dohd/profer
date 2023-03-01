<?php

namespace App\Http\Controllers\action_plan;

use App\Models\action_plan\ActionPlanActivity;
use App\Models\action_plan\ActionPlanCohort;
use App\Models\action_plan\ActionPlanRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ActionPlanCohortTrait
{
    /**
     * Edit Cohort
     */
    public function edit_cohort()
    {
        $plan_cohort = ActionPlanCohort::findOrFail(request('cohort_id'))
            ->with(['regions' => fn($q) => $q->select('regions.id') ])
            ->first();

        return response()->json($plan_cohort);
    }

    /**
     * Store Activity
     */
    public function store_cohort(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'activity_id' => 'required',
            'cohort_id' => 'required',
            'target_no' => 'required',
        ]); 

        $data = $request->only(['action_plan_id']);
        $data_cohort = $request->only(['cohort_id', 'target_no']); 

        DB::beginTransaction();

        try {
            $plan_activity = ActionPlanActivity::where('action_plan_id', $data['action_plan_id'])->first();
            if (!$plan_activity) return errorHandler('Action Plan activity could not be found!');

            $data['activity_id'] = $plan_activity->id;
            $data_cohort = fillArrayRecurse(databaseArray($data_cohort), $data);
            ActionPlanCohort::insert($data_cohort);

            DB::commit();
            return redirect()->back()->with('success', 'Cohort created successfully');
        } catch (\Throwable $th) { dd($th->getMessage());
            errorHandler('Error creating Cohort!');
        }
    }

    /**
     * Update Activity
     */
    public function update_cohort(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cohort_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'assigned_to' => 'required',
            'region_id' => 'required',
            'resources' => 'required',
        ]); 

        $data = $request->only(['item_id', 'cohort_id', 'start_date', 'end_date', 'assigned_to', 'resources']);
        $data_regions = $request->only(['region_id']);

        DB::beginTransaction();

        try {
            $data = inputClean($data);
            $plan_cohort = ActionPlanCohort::findOrFail($data['item_id']);
            unset($data['item_id']);
            $plan_cohort->update($data);

            ActionPlanRegion::where('cohort_id', $plan_cohort->id)->delete();
            $data_regions = databaseArray($data_regions);
            $data_regions = fillArrayRecurse($data_regions, [
                'cohort_id' => $plan_cohort->id, 
                'action_plan_id' => $plan_cohort->action_plan_id,
            ]);
            ActionPlanRegion::insert($data_regions);

            DB::commit();
            return redirect()->back()->with('success', 'Activity updated successfully');
        } catch (\Throwable $th) {
            errorLog($th->getMessage());
            errorHandler('Error updating Activity!');
        }
    }

    /**
     * Destroy Activity
     */
    public function destroy_cohort()
    {
        dd(request('cohort_id'));
        DB::beginTransaction();

        try {
            $plan_cohort = ActionPlanCohort::findOrFail(request('cohort_id'));
            $plan_cohort_count = ActionPlanCohort::where('action_plan_id', $plan_cohort->action_plan_id)->count();
            if ($plan_cohort_count == 1) return errorHandler('Cannot delete initial cohort!');
            
            ActionPlanRegion::where('cohort_id', $plan_cohort->id)->delete();
            $plan_cohort->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Activity deleted successfully');
        } catch (\Throwable $th) {
            errorHandler('Error deleting Activity!');
        }
    }
}
