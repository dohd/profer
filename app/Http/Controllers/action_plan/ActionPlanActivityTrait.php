<?php

namespace App\Http\Controllers\action_plan;

use App\Models\action_plan\ActionPlanActivity;
use App\Models\action_plan\ActionPlanRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ActionPlanActivityTrait
{
    /**
     * Edit Activity
     */
    public function edit_activity(Request $request)
    {
        $plan_activity = ActionPlanActivity::where('id', request('plan_activity_id'))->with([
            'activity' => fn($q) => $q->select('id', 'name'),
            'regions' => fn($q) => $q->select('regions.id', 'regions.name')
        ])->first();
                
        return response()->json($plan_activity);
    }

    /**
     * Store Activity
     */
    public function store_activity(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'activity_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'assigned_to' => 'required',
            'region_id' => 'required',
            'resources' => 'required',
        ]); 

        $data = $request->only(['action_plan_id', 'activity_id', 'start_date', 'end_date', 'assigned_to', 'resources']);
        $data_regions = $request->only(['region_id']); 

        DB::beginTransaction();

        try {
            $data = inputClean($data);

            $is_activity = ActionPlanActivity::where([
                'action_plan_id' => $data['action_plan_id'], 
                'activity_id' => $data['activity_id']
            ])->exists();
            if ($is_activity) return errorHandler('Activity already exists!');

            // create activity
            $plan_activity = ActionPlanActivity::create($data);

            // create regions
            $data_regions = databaseArray($data_regions);
            $data_regions = fillArrayRecurse($data_regions, [
                'plan_activity_id' => $plan_activity->id, 
                'action_plan_id' => $plan_activity->action_plan_id,
                'activity_id' => $plan_activity->activity_id,
            ]);
            ActionPlanRegion::insert($data_regions);

            DB::commit();
            return redirect()->back()->with('success', 'Activity created successfully');
        } catch (\Throwable $th) {
            errorHandler('Error creating Activity!');
        }
    }

    /**
     * Update Activity
     */
    public function update_activity(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'activity_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'assigned_to' => 'required',
            'region_id' => 'required',
            'resources' => 'required',
        ]); 

        $data = $request->only(['item_id', 'action_plan_id', 'activity_id', 'start_date', 'end_date', 'assigned_to', 'resources']);
        $data_regions = $request->only(['region_id']);

        DB::beginTransaction();

        try {
            $data = inputClean($data);

            $is_plan_activity = ActionPlanActivity::where('id', '!=', $data['item_id'])
                ->where('action_plan_id', $data['action_plan_id'])
                ->where('activity_id', $data['activity_id'])->exists();
            if ($is_plan_activity) return errorHandler('Activity already exists!');
            
            // update plan activity
            $plan_activity = ActionPlanActivity::findOrFail($data['item_id']);
            unset($data['item_id']);
            $plan_activity->update($data);

            // update regions
            ActionPlanRegion::where('plan_activity_id', $plan_activity->id)->delete();
            $data_regions = databaseArray($data_regions);
            $data_regions = fillArrayRecurse($data_regions, [
                'action_plan_id' => $plan_activity->action_plan_id,
                'plan_activity_id' => $plan_activity->id, 
                'activity_id' => $plan_activity->activity_id,
            ]);
            ActionPlanRegion::insert($data_regions);

            DB::commit();
            return redirect()->back()->with('success', 'Activity updated successfully');
        } catch (\Throwable $th) {
            dd($th);
            errorHandler('Error updating Activity!');
        }
    }

    /**
     * Destroy Activity
     */
    public function destroy_activity()
    {
        DB::beginTransaction();

        try {
            $plan_activity = ActionPlanActivity::findOrFail(request('activity_id'));
            $activity_count = ActionPlanActivity::where('action_plan_id', $plan_activity->action_plan_id)->count();
            if ($activity_count == 1) return errorHandler('Cannot delete initial activity!');
            
            ActionPlanRegion::where('plan_activity_id', $plan_activity->id)->delete();
            $plan_activity->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Activity deleted successfully');
        } catch (\Throwable $th) {
            errorHandler('Error deleting Activity!');
        }
    }
}
