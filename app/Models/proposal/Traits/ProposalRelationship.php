<?php

namespace App\Models\proposal\Traits;

use App\Models\item\ProposalItem;

trait ProposalRelationship
{
    public function items()
    {
        return $this->hasMany(ProposalItem::class)->orderBy('row_index', 'asc');
    }
}
