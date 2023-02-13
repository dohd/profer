<?php

namespace App\Models\item\Traits;

use App\Models\age_group\AgeGroup;
use App\Models\disability\Disability;
use App\Models\participant_list\ParticipantList;

trait ParticipantListItemRelationship
{
    public function disability()
    {
        return $this->belongsTo(Disability::class);
    }

    public function age_group()
    {
        return $this->belongsTo(AgeGroup::class);
    }

    public function participant_list()
    {
        return $this->belongsTo(ParticipantList::class);
    }
}
