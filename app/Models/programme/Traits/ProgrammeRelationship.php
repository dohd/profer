<?php

namespace App\Models\programme\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\participant_list\ParticipantList;

trait ProgrammeRelationship
{
    public function action_plans()
    {
        return $this->hasMany(ActionPlan::class);
    }

    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }
}
