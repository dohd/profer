<?php

namespace App\Models\budget\Traits;

use App\Models\item\BudgetItem;
use App\Models\proposal\Proposal;

trait BudgetRelationship
{   
    public function items()
    {
        return $this->hasMany(BudgetItem::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
