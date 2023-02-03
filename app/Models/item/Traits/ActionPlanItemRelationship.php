<?php

namespace App\Models\item\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\cohort\Cohort;
use App\Models\item\ProposalItem;

trait ActionPlanItemRelationship
{
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function proposal_item()
    {
        return $this->belongsTo(ProposalItem::class, 'proposal_item_id');
    }

    public function action_plan()
    {
        return $this->belongsTo(ActionPlan::class);
    }
}
