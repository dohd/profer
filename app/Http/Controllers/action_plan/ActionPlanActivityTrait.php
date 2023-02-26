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
    public function edit_activity()
    {
        $plan_activity = ActionPlanActivity::find(request('activity_id'))
            ->with(['regions' => fn($q) => $q->select('regions.id') ])
            ->first();

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
        // dd(compact('data', 'data_regions'));
        DB::beginTransaction();

        try {
            $data = inputClean($data);
            $plan_activity = ActionPlanActivity::create($data);

            $data_regions = databaseArray($data_regions);
            $data_regions = fillArrayRecurse($data_regions, [
                'activity_id' => $plan_activity->id, 
                'action_plan_id' => $plan_activity->action_plan_id,
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

        $data = $request->only(['item_id', 'activity_id', 'start_date', 'end_date', 'assigned_to', 'resources']);
        $data_regions = $request->only(['region_id']);

        DB::beginTransaction();

        try {
            $data = inputClean($data);
            $plan_activity = ActionPlanActivity::findOrFail($data['item_id']);
            unset($data['item_id']);
            $plan_activity->update($data);

            ActionPlanRegion::where('activity_id', $plan_activity->id)->delete();
            $data_regions = databaseArray($data_regions);
            $data_regions = fillArrayRecurse($data_regions, [
                'activity_id' => $plan_activity->id, 
                'action_plan_id' => $plan_activity->action_plan_id,
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
    public function destroy_activity()
    {
        DB::beginTransaction();

        try {
            $plan_activity = ActionPlanActivity::findOrFail(request('activity_id'));
            ActionPlanRegion::where('activity_id', $plan_activity->id)->delete();
            $plan_activity->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Activity deleted successfully');
        } catch (\Throwable $th) {
            errorHandler('Error deleting Activity!');
        }
    }
}
