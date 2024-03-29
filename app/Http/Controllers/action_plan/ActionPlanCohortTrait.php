<?php

namespace App\Http\Controllers\action_plan;

use App\Models\action_plan\ActionPlanActivity;
use App\Models\action_plan\ActionPlanCohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ActionPlanCohortTrait
{
    /**
     * Edit Cohort
     */
    public function edit_cohort()
    {
        $plan_cohort = ActionPlanCohort::findOrFail(request('cohort_id'));
        $plan_cohort['plan_activity_id'] = $plan_cohort->plan_activity? $plan_cohort->plan_activity->id : '';
            
        return response()->json($plan_cohort);
    }

    /**
     * Store Cohort
     */
    public function store_cohort(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'activity_id' => 'required',
            'cohort_id' => 'required',
            'target_no' => 'required',
        ]); 

        $data = $request->only(['action_plan_id', 'activity_id']);
        $data_cohort = $request->only(['cohort_id', 'target_no']); 

        DB::beginTransaction();

        try {
            $plan_activity = ActionPlanActivity::where($data)->firstOrFail();
            $data['plan_activity_id'] = $plan_activity->id;
            $data_cohort = fillArrayRecurse(databaseArray($data_cohort), $data);
            ActionPlanCohort::insert($data_cohort);

            DB::commit();
            return redirect()->back()->with('success', 'Cohort created successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            errorHandler('Error creating Cohort!');
        }
    }

    /**
     * Update Cohort
     */
    public function update_cohort(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'activity_id' => 'required',
            'cohort_id' => 'required',
            'target_no' => 'required',
        ]); 

        $data = $request->only(['item_id', 'action_plan_id', 'activity_id']);
        $data_cohort = $request->only(['cohort_id', 'target_no']); 

        DB::beginTransaction();

        try {
            $plan_cohort = ActionPlanCohort::findOrFail($data['item_id']);
            unset($data['item_id']);
            $data = fillArrayRecurse(databaseArray($data_cohort), $data);
            $plan_cohort->fill($data[0]);
            $plan_cohort->save();

            DB::commit();
            return redirect()->back()->with('success', 'Cohort updated successfully');
        } catch (\Throwable $th) {
            errorHandler('Error updating Cohort!');
        }
    }

    /**
     * Destroy Cohort
     */ 
    public function destroy_cohort()
    {
        DB::beginTransaction();

        try {
            $plan_cohort = ActionPlanCohort::findOrFail(request('cohort_id'));
            $cohort_count = ActionPlanCohort::whereHas('plan_activity')
                ->where('action_plan_id', $plan_cohort->action_plan_id)->count();
            if ($cohort_count == 1) return errorHandler('Cannot delete initial cohort!');
            
            $plan_cohort->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Cohort deleted successfully');
        } catch (\Throwable $th) {
            errorHandler('Error deleting Cohort!');
        }
    }
}
