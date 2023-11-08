<?php

namespace App\Models\item\Traits;

use App\Models\budget\Budget;

trait BudgetItemRelationship
{
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
