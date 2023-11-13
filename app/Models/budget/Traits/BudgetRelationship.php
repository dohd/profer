<?php

namespace App\Models\budget\Traits;

use App\Models\budget\BudgetExpense;
use App\Models\item\BudgetItem;
use App\Models\proposal\Proposal;

trait BudgetRelationship
{   
    public function expenses()
    {
        return $this->hasMany(BudgetExpense::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function items()
    {
        return $this->hasMany(BudgetItem::class);
    }
}
