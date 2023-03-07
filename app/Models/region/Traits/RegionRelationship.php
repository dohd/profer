<?php

namespace App\Models\region\Traits;

use App\Models\action_plan\ActionPlanRegion;
use App\Models\participant_list\ParticipantList;

trait RegionRelationship
{
    public function plan_regions()
    {
        return $this->hasMany(ActionPlanRegion::class);
    }

    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }
}
