<?php

namespace App\Models\action_plan\Traits;

use App\Models\action_plan\ActionPlanActivity;
use App\Models\action_plan\ActionPlanCohort;
use App\Models\item\ActionPlanItem;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;

trait ActionPlanRelationship
{
    public function plan_activities()
    {
        return $this->hasMany(ActionPlanActivity::class);
    }

    public function plan_cohorts()
    {
        return $this->hasMany(ActionPlanCohort::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
