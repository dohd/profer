<?php

namespace App\Models\participant_list\Traits;

use App\Models\cohort\Cohort;
use App\Models\item\ParticipantListItem;
use App\Models\item\ProposalItem;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\Region;

trait ParticipantListRelationship
{
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function proposal_item()
    {
        return $this->belongsTo(ProposalItem::class)->where('is_obj', 0);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function items()
    {
        return $this->hasMany(ParticipantListItem::class);
    }
}
