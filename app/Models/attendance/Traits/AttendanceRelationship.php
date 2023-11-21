<?php

namespace App\Models\attendance\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\item\AttendanceItem;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;

trait AttendanceRelationship
{
    public function items()
    {
        return $this->hasMany(AttendanceItem::class);
    }

    public function action_plan()
    {
        return $this->belongsTo(ActionPlan::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function activity()
    {
        return $this->belongsTo(ProposalItem::class, 'proposal_item_id');
    }
}
