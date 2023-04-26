<?php

namespace App\Models\agenda\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\item\AgendaItem;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;

trait AgendaRelationship
{
    public function items()
    {
        return $this->hasMany(AgendaItem::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function proposal_item()
    {
        return $this->belongsTo(ProposalItem::class);
    }

    public function action_plan()
    {
        return $this->belongsTo(ActionPlan::class);
    }
}
