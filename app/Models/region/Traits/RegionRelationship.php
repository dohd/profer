<?php

namespace App\Models\region\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\action_plan\ActionPlanRegion;

trait RegionRelationship
{
    public function plan_regions()
    {
        return $this->hasMany(ActionPlanRegion::class);
    }

    public function action_plans()
    {
        return $this->hasManyThrough(ActionPlan::class, ActionPlanRegion::class, 'region_id', 'id', 'id', 'action_plan_id');
    }
}
