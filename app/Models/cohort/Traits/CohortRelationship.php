<?php

namespace App\Models\cohort\Traits;

use App\Models\participant_list\ParticipantList;

trait CohortRelationship
{
    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }
}
