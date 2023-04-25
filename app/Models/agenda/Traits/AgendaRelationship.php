<?php

namespace App\Models\agenda\Traits;

use App\Models\item\AgendaItem;

trait AgendaRelationship
{
    public function items()
    {
        return $this->hasMany(AgendaItem::class);
    }
}
