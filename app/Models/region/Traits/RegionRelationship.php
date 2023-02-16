<?php

namespace App\Models\region\Traits;

use App\Models\participant_list\ParticipantList;

trait RegionRelationship
{
    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }
}
