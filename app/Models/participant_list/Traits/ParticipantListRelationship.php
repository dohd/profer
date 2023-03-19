<?php

namespace App\Models\participant_list\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\cohort\Cohort;
use App\Models\item\ParticipantListItem;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;
use App\Models\region\Region;

trait ParticipantListRelationship
{
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function action_plan()
    {
        return $this->belongsTo(ActionPlan::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function proposal_item()
    {
        return $this->belongsTo(ProposalItem::class);
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
