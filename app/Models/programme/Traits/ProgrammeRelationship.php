<?php

namespace App\Models\programme\Traits;

use App\Models\action_plan\ActionPlan;

trait ProgrammeRelationship
{
    public function action_plans()
    {
        return $this->hasMany(ActionPlan::class);
    }
}
