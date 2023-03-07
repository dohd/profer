<?php

namespace App\Models\cohort\Traits;

use App\Models\action_plan\ActionPlanCohort;
use App\Models\participant_list\ParticipantList;

trait CohortRelationship
{
    public function plan_cohorts()
    {
        return $this->hasMany(ActionPlanCohort::class);
    }

    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }
}
