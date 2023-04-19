<?php

namespace App\Models\cohort\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\action_plan\ActionPlanCohort;

trait CohortRelationship
{
    public function plan_cohorts()
    {
        return $this->hasMany(ActionPlanCohort::class);
    }

    public function action_plans()
    {
        return $this->hasManyThrough(ActionPlan::class, ActionPlanCohort::class, 'cohort_id', 'id', 'id', 'action_plan_id');
    }
}
