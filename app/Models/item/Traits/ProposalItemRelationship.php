<?php

namespace App\Models\item\Traits;

use App\Models\proposal\Proposal;
use App\Models\region\ProposalItemRegion;
use App\Models\region\Region;

trait ProposalItemRelationship
{
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function regions()
    {
        return $this->hasManyThrough(Region::class, ProposalItemRegion::class, 'proposal_item_id', 'id', 'id', 'region_id');
    }
}
