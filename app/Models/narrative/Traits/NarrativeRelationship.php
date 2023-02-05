<?php

namespace App\Models\narrative\Traits;

use App\Models\item\NarrativeItem;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;

trait NarrativeRelationship
{   
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function proposal_item()
    {
        return $this->belongsTo(ProposalItem::class);
    }

    public function items()
    {
        return $this->hasMany(NarrativeItem::class);
    }
}
