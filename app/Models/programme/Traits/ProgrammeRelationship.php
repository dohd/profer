<?php

namespace App\Models\programme\Traits;

use App\Models\participant_list\ParticipantList;

trait ProgrammeRelationship
{
    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }
}
