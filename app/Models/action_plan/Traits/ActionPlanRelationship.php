<?php

namespace App\Models\action_plan\Traits;

use App\Models\item\ActionPlanItem;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;

trait ActionPlanRelationship
{
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function items()
    {
        return $this->hasMany(ActionPlanItem::class);
    }
}
