<?php

namespace App\Models\donor\Traits;

use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;

trait DonorRelationship
{
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function proposal_items()
    {
        return $this->hasManyThrough(ProposalItem::class, Proposal::class, 'donor_id', 'proposal_id', 'id', 'id');
    }
}
