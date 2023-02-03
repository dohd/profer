<?php

namespace App\Models\item\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\item\ProposalItem;
use Illuminate\Support\Facades\DB;

trait ActionPlanItemRelationship
{
    
    public function target_group()
    {
        return DB::table('target_groups')->find($this->target_group_id);
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
