<?php

namespace App\Models\item\Traits;

use App\Models\action_plan\ActionPlanActivity;
use App\Models\cohort\Cohort;
use App\Models\item\ParticipantListItem;
use App\Models\participant_list\ParticipantList;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\ActionPlanItemRegion;
use App\Models\region\Region;

trait ProposalItemRelationship
{
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function plan_activities()
    {
        return $this->hasMany(ActionPlanActivity::class, 'activity_id');
    }

    public function plan_regions()
    {
        return $this->hasManyThrough(Region::class, ActionPlanItemRegion::class, 'proposal_item_id', 'id', 'id', 'region_id');
    }

    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }

    public function participants()
    {
        return $this->hasManyThrough(ParticipantListItem::class, ParticipantList::class, 'proposal_item_id', 'participant_list_id', 'id', 'id');
    }

    public function participant_regions()
    {
        return $this->hasManyThrough(Region::class, ParticipantList::class, 'proposal_item_id', 'id', 'id', 'region_id');
    }

    public function participant_programmes()
    {
        return $this->hasManyThrough(Region::class, Programme::class, 'proposal_item_id', 'id', 'id', 'programme_id');
    }

    public function participant_cohorts()
    {
        return $this->hasManyThrough(Region::class, Cohort::class, 'proposal_item_id', 'id', 'id', 'cohort_id');
    }
}
