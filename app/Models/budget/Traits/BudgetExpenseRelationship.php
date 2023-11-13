<?php

namespace App\Models\budget\Traits;

use App\Models\item\BudgetItem;

trait BudgetExpenseRelationship
{   
    public function cost_item_category()
    {
        return $this->belongsTo(BudgetItem::class, 'item_category_id');
    }

    public function cost_item()
    {
        return $this->belongsTo(BudgetItem::class, 'cost_item_id');
    }
}
