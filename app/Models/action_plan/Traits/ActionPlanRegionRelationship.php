<?php

namespace App\Models\action_plan\Traits;

use App\Models\action_plan\ActionPlan;

trait ActionPlanRegionRelationship
{
    public function action_plan()
    {
        return $this->belongsTo(ActionPlan::class);
    }
}
